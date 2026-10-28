<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(): View
    {
        $users = Account::query()
            ->with(['admin', 'member'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function (Account $account): array {
                $avatar = $account->admin?->profile_img
                    ?? $account->member?->image_url
                    ?? 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop';

                return [
                    'id' => $account->id,
                    'name' => $account->name ?? 'Unknown User',
                    'email' => $account->email,
                    'role' => $account->role ?? 'member',
                    'profile_img' => $avatar,
                    'created_at' => optional($account->created_at)->format('d M Y'),
                    'status' => 'Active',
                ];
            })
            ->values();

        return view('admin.dashboard', [
            'adminUsers' => $users,
        ]);
    }

    public function deleted(): View
    {
        $users = Account::onlyTrashed()
            ->with(['admin', 'member'])
            ->orderByDesc('deleted_at')
            ->get();

        return view('admin.users.deleted', [
            'users' => $users,
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:accounts,email'],
            'role' => ['required', 'in:member,admin'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'member_phone' => ['nullable', 'string', 'max:20'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:L,P,W', 'max:1'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:100'],
            'province' => ['nullable', 'string', 'max:100'],
            'member_image_url' => ['nullable', 'url', 'max:255'],
            'admin_phone' => ['required_if:role,admin', 'nullable', 'string', 'max:20'],
            'admin_profile_img' => ['nullable', 'url', 'max:255'],
            'admin_role' => ['nullable', 'string', 'max:50'],
        ]);

        $provisionerId = $request->user()->getAuthIdentifier();

        DB::transaction(function () use ($validated, $provisionerId): void {
            $account = Account::query()->create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role'],
                'password' => filled($validated['password'] ?? null)
                    ? Hash::make($validated['password'])
                    : null,
            ]);

            if ($validated['role'] === 'member') {
                Member::query()->create([
                    'account_id' => $account->id,
                    'name' => $account->name,
                    'email' => $account->email,
                    'phone' => $validated['member_phone'] ?? null,
                    'date_of_birth' => $validated['date_of_birth'] ?? null,
                    'gender' => $validated['gender'] ?? null,
                    'address' => $validated['address'] ?? null,
                    'city' => $validated['city'] ?? null,
                    'province' => $validated['province'] ?? null,
                    'image_url' => $validated['member_image_url'] ?? null,
                    'provisioned_by' => $provisionerId,
                ]);
            } else {
                Admin::query()->create([
                    'account_id' => $account->id,
                    'name' => $account->name,
                    'email' => $account->email,
                    'phone' => $validated['admin_phone'],
                    'profile_img' => $validated['admin_profile_img'] ?? null,
                    'role' => $validated['admin_role'] ?? 'active',
                ]);
            }
        });

        return redirect()->route('admin.users')->with('status', 'User created successfully.');
    }

    public function edit(string $userId): View
    {
        $user = Account::query()->with(['member', 'admin'])->findOrFail($userId);

        return view('admin.users.edit', [
            'user' => $user,
            'member' => $user->member,
            'admin' => $user->admin,
        ]);
    }

    public function update(Request $request, string $userId): RedirectResponse
    {
        $user = Account::query()->findOrFail($userId);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:accounts,email,'.$user->id],
            'role' => ['required', 'in:member,admin'],
            'member_phone' => ['nullable', 'string', 'max:20'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:L,P,W', 'max:1'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:100'],
            'province' => ['nullable', 'string', 'max:100'],
            'member_image_url' => ['nullable', 'url', 'max:255'],
            'admin_phone' => ['nullable', 'string', 'max:20'],
            'admin_profile_img' => ['nullable', 'url', 'max:255'],
            'admin_role' => ['nullable', 'string', 'max:50'],
        ]);

        $previousRole = $user->role;
        $existingProvisionerId = $previousRole === 'member'
            ? $user->member()->value('provisioned_by')
            : null;

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ]);

        if ($previousRole === 'member') {
            Member::query()->where('account_id', $user->id)->delete();
        }

        if ($previousRole === 'admin') {
            Admin::query()->where('account_id', $user->id)->delete();
        }

        if ($validated['role'] === 'member') {
            $memberData = [
                'account_id' => $user->id,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['member_phone'] ?? null,
                'date_of_birth' => $validated['date_of_birth'] ?? null,
                'gender' => $validated['gender'] ?? null,
                'address' => $validated['address'] ?? null,
                'city' => $validated['city'] ?? null,
                'province' => $validated['province'] ?? null,
                'image_url' => $validated['member_image_url'] ?? null,
                'provisioned_by' => $existingProvisionerId ?? $request->user()->getAuthIdentifier(),
            ];

            Member::query()->updateOrCreate(['account_id' => $user->id], $memberData);
        }

        if ($validated['role'] === 'admin') {
            $adminData = [
                'account_id' => $user->id,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['admin_phone'] ?? null,
                'profile_img' => $validated['admin_profile_img'] ?? null,
                'role' => $validated['admin_role'] ?? 'active',
            ];

            Admin::query()->updateOrCreate(['account_id' => $user->id], $adminData);
        }

        return redirect()->route('admin.users')->with('status', 'User updated successfully.');
    }

    public function destroy(string $userId): RedirectResponse
    {
        Account::query()->findOrFail($userId);
        DB::table('accounts')
            ->where('id', $userId)
            ->whereNull('deleted_at')
            ->update(['deleted_at' => now()]);

        return redirect()->route('admin.users')->with('status', 'User moved to deleted users.');
    }

    public function restore(string $userId): RedirectResponse
    {
        $user = Account::onlyTrashed()->findOrFail($userId);

        DB::transaction(function () use ($user): void {
            DB::table('accounts')
                ->where('id', $user->id)
                ->whereNotNull('deleted_at')
                ->update(['deleted_at' => null]);

            if ($user->role === 'admin' && ! $user->admin()->exists()) {
                Admin::query()->create([
                    'account_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => '',
                    'role' => 'active',
                ]);
            }

            if ($user->role === 'member' && ! $user->member()->exists()) {
                Member::query()->create([
                    'account_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ]);
            }
        });

        return redirect()->route('admin.users.deleted')->with('status', 'User recovered successfully.');
    }
}
