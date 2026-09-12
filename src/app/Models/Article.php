<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['title', 'keywords', 'slug', 'short_description', 'content', 'thumbnail_image', 'author_id', 'status'])]
class Article extends Model
{
    use HasUuids;

    protected $table = 'articles';
    public $incrementing = false;
    protected $keyType = 'string';

    public function author(): BelongsTo {
        return $this->belongsTo(Admin::class, 'author_id', 'account_id');
    }
}
