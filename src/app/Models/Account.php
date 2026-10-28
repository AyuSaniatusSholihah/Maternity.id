<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'role', 'email_verified_at', 'password', 'remember_token'])]
class Account extends Authenticatable
{
    use HasUuids, Notifiable, SoftDeletes;

    protected $table = 'accounts';

    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class, 'account_id', 'id');
    }

    public function member(): HasOne
    {
        return $this->hasOne(Member::class, 'account_id', 'id');
    }
}
