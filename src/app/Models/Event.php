<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasUuids;

    protected $table = 'events';

    protected $fillable = ['categories', 'title', 'slug', 'description', 'event_date', 'open_registration_date', 'close_registration_date', 'location', 'image_url', 'slot', 'is_available', 'fee', 'speaker', 'created_by'];

    protected $casts = [
        'event_date' => 'datetime:Y-m-d',
        'open_registration_date' => 'datetime:Y-m-d',
        'close_registration_date' => 'datetime:Y-m-d',
        'is_available' => 'boolean',
    ];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class, 'categories', 'id');
    }

    public function creator(): BelongsTo {
        return $this->belongsTo(Admin::class, 'created_by', 'account_id');
    }

    public function materials(): BelongsToMany {
        return $this->belongsToMany(Material::class, 'event_material', 'event_id', 'material_id');
    }
}

