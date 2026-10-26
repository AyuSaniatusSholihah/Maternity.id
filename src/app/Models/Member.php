<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['account_id', 'name', 'email', 'phone', 'date_of_birth', 'gender', 'address', 'city', 'province', 'image_url', 'provisioned_by'])]
class Member extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'account_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function account(): BelongsTo {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function provisioner(): BelongsTo {
        return $this->belongsTo(Admin::class, 'provisioned_by', 'account_id');
    }
}
