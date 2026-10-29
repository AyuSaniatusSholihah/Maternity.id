<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class AdminMaterialEditTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_edit_material_metadata_without_changing_the_pdf(): void
    {
        Storage::fake('public');

        $adminAccount = Account::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        Admin::create([
            'account_id' => $adminAccount->id,
            'name' => $adminAccount->name,
            'email' => $adminAccount->email,
            'phone' => '081234567890',
            'role' => 'active',
        ]);

        $otherAdminAccount = Account::create([
            'name' => 'Other Admin',
            'email' => 'other-admin@example.com',
            'role' => 'admin',
        ]);

        Admin::create([
            'account_id' => $otherAdminAccount->id,
            'name' => $otherAdminAccount->name,
            'email' => $otherAdminAccount->email,
            'phone' => '081111111111',
            'role' => 'active',
        ]);

        $originalCategory = $this->createCategory('Original Category');
        $updatedCategory = $this->createCategory('Updated Category');
        $pdfPath = UploadedFile::fake()->create('guide.pdf', 20, 'application/pdf')
            ->store('ebooks', 'public');

        $material = Material::create([
            'categories' => $originalCategory->id,
            'title' => 'Original Guide',
            'slug' => 'original-guide',
            'description' => 'Original description',
            'content' => $pdfPath,
            'image_url' => null,
            'uploaded_by' => $adminAccount->id,
        ]);

        $this->actingAs($adminAccount)
            ->get(route('admin.ebook.edit', $material->id))
            ->assertOk()
            ->assertSee('Edit E-Book')
            ->assertSee('original-guide')
            ->assertDontSee('name="pdf_file"')
            ->assertDontSee('name="uploaded_by"');

        $this->actingAs($adminAccount)
            ->put(route('admin.ebook.update', $material->id), [
                'categories' => $updatedCategory->id,
                'title' => 'Updated Guide',
                'slug' => 'updated-guide',
                'description' => 'Updated description',
                'image_url' => 'https://example.com/cover.jpg',
                'uploaded_by' => $otherAdminAccount->id,
                'content' => 'forged/path.pdf',
            ])
            ->assertRedirect(route('admin.ebook'));

        $material->refresh();
        $this->assertSame($updatedCategory->id, $material->categories);
        $this->assertSame('Updated Guide', $material->title);
        $this->assertSame('updated-guide', $material->slug);
        $this->assertSame('Updated description', $material->description);
        $this->assertSame('https://example.com/cover.jpg', $material->image_url);
        $this->assertSame($adminAccount->id, $material->uploaded_by);
        $this->assertSame($pdfPath, $material->content);
        Storage::disk('public')->assertExists($pdfPath);
    }

    public function test_admin_can_permanently_delete_a_material_and_its_pdf(): void
    {
        Storage::fake('public');

        $adminAccount = Account::create([
            'name' => 'Admin User',
            'email' => 'delete-admin@example.com',
            'role' => 'admin',
        ]);

        Admin::create([
            'account_id' => $adminAccount->id,
            'name' => $adminAccount->name,
            'email' => $adminAccount->email,
            'phone' => '081234567890',
            'role' => 'active',
        ]);

        $category = $this->createCategory('Delete Category');
        $pdfPath = 'ebooks/delete-guide.pdf';
        Storage::disk('public')->put($pdfPath, 'PDF contents');

        $material = Material::create([
            'categories' => $category->id,
            'title' => 'Delete Guide',
            'slug' => 'delete-guide',
            'description' => 'Description',
            'content' => $pdfPath,
            'uploaded_by' => $adminAccount->id,
        ]);

        $this->actingAs($adminAccount)
            ->delete(route('admin.ebook.destroy', $material->id))
            ->assertRedirect(route('admin.ebook'));

        $this->assertDatabaseMissing('materials', ['id' => $material->id]);
        Storage::disk('public')->assertMissing($pdfPath);
    }

    private function createCategory(string $name): Category
    {
        return Category::create([
            'id' => (string) Str::uuid(),
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $name,
        ]);
    }
}
