<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['account_id', 'name', 'email', 'phone', 'profile_img', 'role'])]
class Admin extends Model
{
    use HasUuids;

    protected $table = 'admins';
    protected $primaryKey = 'account_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function account(): BelongsTo {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function eventCreated(): HasMany {
        return $this->hasMany(Event::class, 'created_by', 'account_id');
    }

    public function articleWritten(): HasMany {
        return $this->hasMany(Article::class, 'author_id', 'account_id');
    }

    public function materialsUploaded(): HasMany {
        return $this->hasMany(Material::class, 'uploaded_by', 'account_id');
    }
}
