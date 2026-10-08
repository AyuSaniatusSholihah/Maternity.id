<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['categories', 'title', 'slug', 'description', 'content', 'image_url', 'uploaded_by'])]
class Material extends Model
{
    use HasUuids;

    protected $table = 'materials';

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class, 'categories', 'id');
    }

    public function uploader(): BelongsTo {
        return $this->belongsTo(Admin::class, 'uploaded_by', 'account_id');
    }
}
