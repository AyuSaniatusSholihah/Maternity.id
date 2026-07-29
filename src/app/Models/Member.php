<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['account_id', 'gender', 'phone_number', 'saluation', 'birth_date', 'job', 'address', 'zip_code', 'institution', 'provision_by'])]
class Member extends Model
{
    use HasUuids;

    protected $table = 'members';
    public $incrementing = false;
    protected $keyType = 'string';

    public function account(): BelongsTo {
        return $this->belongsTo(Account::class, 'account_id', 'account_id');
    }
}
