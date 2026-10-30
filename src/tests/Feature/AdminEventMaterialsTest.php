<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Event;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class AdminEventMaterialsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_add_and_remove_ebooks_from_an_event_edit_form(): void
    {
        $adminAccount = Account::create([
            'name' => 'Event Admin',
            'email' => 'event-admin@example.com',
            'role' => 'admin',
        ]);

        Admin::create([
            'account_id' => $adminAccount->id,
            'name' => $adminAccount->name,
            'email' => $adminAccount->email,
            'phone' => '081234567890',
            'role' => 'active',
        ]);

        $category = $this->createCategory('Event Category');
        $firstMaterial = $this->createMaterial($adminAccount->id, $category->id, 'First E-Book');
        $secondMaterial = $this->createMaterial($adminAccount->id, $category->id, 'Second E-Book');
        $event = Event::create([
            'categories' => $category->id,
            'title' => 'Prenatal Class',
            'slug' => 'prenatal-class',
            'description' => 'Event description',
            'event_date' => '2026-11-10',
            'open_registration_date' => '2026-10-01',
            'close_registration_date' => '2026-11-01',
            'location' => 'Jakarta',
            'slot' => 50,
            'fee' => 0,
            'speaker' => 'Speaker Name',
            'created_by' => $adminAccount->id,
        ]);

        $event->materials()->attach($firstMaterial->id);

        $this->actingAs($adminAccount)
            ->get(route('admin.event.edit', $event->slug))
            ->assertOk()
            ->assertSee('E-Book untuk Event')
            ->assertSee('alpinejs@3.x.x/dist/cdn.min.js')
            ->assertSee('First E-Book')
            ->assertSee('Second E-Book')
            ->assertSee('selectedIds')
            ->assertSee('Remove ')
            ->assertSee('Pilih e-book untuk ditambahkan')
            ->assertSee('name="materials[]"', false)
            ->assertDontSee('type="checkbox"', false);

        $this->actingAs($adminAccount)
            ->put(route('admin.event.update', $event->slug), [
                'title' => 'Prenatal Class Updated',
                'categories' => $category->id,
                'description' => 'Updated event description',
                'event_date' => '2026-11-10',
                'open_registration_date' => '2026-10-01',
                'close_registration_date' => '2026-11-01',
                'location' => 'Jakarta',
                'slot' => 50,
                'fee' => 0,
                'speaker' => 'Speaker Name',
                'materials' => [$secondMaterial->id],
            ])
            ->assertRedirect(route('admin.event'));

        $this->assertDatabaseMissing('event_material', [
            'event_id' => $event->id,
            'material_id' => $firstMaterial->id,
        ]);
        $this->assertDatabaseHas('event_material', [
            'event_id' => $event->id,
            'material_id' => $secondMaterial->id,
        ]);
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

    private function createMaterial(string $uploaderId, string $categoryId, string $title): Material
    {
        return Material::create([
            'categories' => $categoryId,
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $title.' description',
            'content' => 'ebooks/'.Str::slug($title).'.pdf',
            'uploaded_by' => $uploaderId,
        ]);
    }
}
