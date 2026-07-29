<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'profile_img'])]
class Account extends Authenticatable
{
    use HasUuids, Notifiable;

    protected $table = 'accounts';
    public $incrementing = false;
    protected $keyType = 'string';

    public function admin(): HasOne {
        return $this->hasOne(Admin::class, 'account_id', 'account_id');
    }
    public function member(): HasOne {
        return $this->hasOne(Member::class, 'account_id', 'account_id');
    }
}
