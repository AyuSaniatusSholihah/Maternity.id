<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'slug'])]
class Category extends Model
{
    use HasUuids;

    protected $table = 'categories';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function articles(): BelongsToMany {
        return $this->belongsToMany(Article::class, 'article_categories', 'category_id', 'article_id');
    }
}
