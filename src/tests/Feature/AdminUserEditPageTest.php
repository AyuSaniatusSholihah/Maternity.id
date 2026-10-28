<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserEditPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_role_specific_user_edit_form(): void
    {
        $adminAccount = Account::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        $memberAccount = Account::create([
            'name' => 'Member User',
            'email' => 'member@example.com',
            'role' => 'member',
        ]);

        Admin::create([
            'account_id' => $adminAccount->id,
            'name' => $adminAccount->name,
            'email' => $adminAccount->email,
            'phone' => '081234567890',
            'profile_img' => null,
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

        Member::create([
            'account_id' => $memberAccount->id,
            'name' => $memberAccount->name,
            'email' => $memberAccount->email,
            'phone' => '081122334455',
            'date_of_birth' => '2000-01-01',
            'gender' => 'W',
            'address' => 'Jl. Mawar No. 1',
            'city' => 'Jakarta',
            'province' => 'DKI Jakarta',
            'image_url' => null,
            'provisioned_by' => $adminAccount->id,
        ]);

        $this->actingAs($adminAccount)
            ->get(route('admin.users.edit', $memberAccount->id))
            ->assertOk()
            ->assertSee('Edit User')
            ->assertSee('date_of_birth')
            ->assertSee('member_phone')
            ->assertDontSee('name="provisioned_by"');

        $this->actingAs($adminAccount)
            ->put(route('admin.users.update', $memberAccount->id), [
                'name' => $memberAccount->name,
                'email' => $memberAccount->email,
                'role' => 'member',
                'provisioned_by' => $otherAdminAccount->id,
            ])
            ->assertRedirect(route('admin.users'));

        $this->assertDatabaseHas('members', [
            'account_id' => $memberAccount->id,
            'provisioned_by' => $adminAccount->id,
        ]);
    }
}
