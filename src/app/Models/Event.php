<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasUuids;

    protected $table = 'events';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'date' => 'datetime:Y-m-d',
        'is_available' => 'boolean',
    ];

    public function createdBy(): BelongsTo {
        return $this->belongsTo(Admin::class, 'created_by', 'account_id');
    }
    public function material(): HasMany {
        return $this->hasMany(Material::class, 'event_id', 'id');
    }
}

