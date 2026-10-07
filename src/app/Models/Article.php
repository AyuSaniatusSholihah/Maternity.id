<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['categories', 'title', 'slug', 'description', 'content', 'image_url', 'author'])]
class Article extends Model
{
    use HasUuids;

    protected $table = 'articles';

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class, 'categories', 'id');
    }
}
