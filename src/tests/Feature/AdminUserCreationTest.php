<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_member_and_admin_accounts_with_role_profiles(): void
    {
        $creator = Account::create([
            'name' => 'Creator Admin',
            'email' => 'creator@example.com',
            'role' => 'admin',
        ]);

        Admin::create([
            'account_id' => $creator->id,
            'name' => $creator->name,
            'email' => $creator->email,
            'phone' => '081234567890',
            'role' => 'active',
        ]);

        $otherAdmin = Account::create([
            'name' => 'Other Admin',
            'email' => 'other@example.com',
            'role' => 'admin',
        ]);

        Admin::create([
            'account_id' => $otherAdmin->id,
            'name' => $otherAdmin->name,
            'email' => $otherAdmin->email,
            'phone' => '081111111111',
            'role' => 'active',
        ]);

        $this->actingAs($creator)
            ->get('/admin/user/add')
            ->assertOk()
            ->assertSee('Add User')
            ->assertSee('member_phone')
            ->assertSee('admin_phone')
            ->assertDontSee('name="provisioned_by"');

        $this->post('/admin/users', [
            'name' => 'New Member',
            'email' => 'new.member@example.com',
            'role' => 'member',
            'member_phone' => '081122334455',
            'date_of_birth' => '1995-03-21',
            'gender' => 'W',
            'address' => 'Jl. Mawar No. 1',
            'city' => 'Jakarta',
            'province' => 'DKI Jakarta',
            'member_image_url' => 'https://example.com/member.jpg',
            'provisioned_by' => $otherAdmin->id,
        ])->assertRedirect(route('admin.users'));

        $member = Account::query()->where('email', 'new.member@example.com')->firstOrFail();
        $this->assertSame('member', $member->role);
        $this->assertDatabaseHas('members', [
            'account_id' => $member->id,
            'phone' => '081122334455',
            'date_of_birth' => '1995-03-21',
            'gender' => 'W',
            'provisioned_by' => $creator->id,
        ]);

        $this->post('/admin/users', [
            'name' => 'New Admin',
            'email' => 'new.admin@example.com',
            'role' => 'admin',
            'admin_phone' => '089876543210',
            'admin_profile_img' => 'https://example.com/admin.jpg',
            'admin_role' => 'active',
        ])->assertRedirect(route('admin.users'));

        $newAdmin = Account::query()->where('email', 'new.admin@example.com')->firstOrFail();
        $this->assertSame('admin', $newAdmin->role);
        $this->assertDatabaseHas('admins', [
            'account_id' => $newAdmin->id,
            'phone' => '089876543210',
            'profile_img' => 'https://example.com/admin.jpg',
            'role' => 'active',
        ]);
    }
}
