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

    protected $casts = [
        'event_date' => 'datetime:Y-m-d',
        'open_registration_date' => 'datetime:Y-m-d',
        'close_registration_date' => 'datetime:Y-m-d',
        'is_available' => 'boolean',
    ];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class, 'categories', 'id');
    }

    public function materials(): HasMany {
        return $this->hasMany(Material::class, 'materials', 'id');
    }
}

