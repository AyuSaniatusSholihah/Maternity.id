<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['event_id', 'title', 'slug', 'description', 'thumbnail_image', 'content_link', 'viewer_count', 'uploaded_by'])]
class Material extends Model
{
    use HasUuids;

    protected $table = 'materials';
    public $incrementing = false;
    protected $keyType = 'string';

    public function event(): BelongsTo {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
    public function uploadedBy(): BelongsTo {
        return $this->belongsTo(Admin::class, 'uploaded_by', 'account_id');
    }
}
