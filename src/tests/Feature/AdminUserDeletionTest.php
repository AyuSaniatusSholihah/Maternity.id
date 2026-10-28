<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserDeletionTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_soft_delete_and_restore_an_account(): void
    {
        $admin = Account::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        Admin::create([
            'account_id' => $admin->id,
            'name' => $admin->name,
            'email' => $admin->email,
            'phone' => '081234567890',
            'role' => 'active',
        ]);

        $member = Account::create([
            'name' => 'Member User',
            'email' => 'member@example.com',
            'role' => 'member',
        ]);
        $originalUpdatedAt = $member->getRawOriginal('updated_at');

        $this->actingAs($admin)
            ->delete(route('admin.users.destroy', $member->id))
            ->assertRedirect(route('admin.users'));

        $this->assertSoftDeleted('accounts', ['id' => $member->id]);
        $this->assertDatabaseHas('accounts', [
            'id' => $member->id,
            'email' => 'member@example.com',
            'updated_at' => $originalUpdatedAt,
        ]);
        $this->assertNull(Account::query()->find($member->id));
        $this->assertNotNull(Account::withTrashed()->find($member->id));

        $this->actingAs($admin)
            ->get(route('admin.users.deleted'))
            ->assertOk()
            ->assertSee('member@example.com')
            ->assertSee('Restore');

        $this->actingAs($admin)
            ->post(route('admin.users.restore', $member->id))
            ->assertRedirect(route('admin.users.deleted'));

        $this->assertDatabaseHas('accounts', [
            'id' => $member->id,
            'email' => 'member@example.com',
            'deleted_at' => null,
            'updated_at' => $originalUpdatedAt,
        ]);
    }
}
