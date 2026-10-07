<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['categories', 'name', 'slug', 'description', 'price', 'thumbnail_img', 'click_count', 'tiktok_url', 'tokopedia_url', 'shopee_url', 'whatsapp_url', 'created_by'])]
class Product extends Model
{
    use HasUuids;

    protected $table = 'products';

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class, 'categories', 'id');
    }

    public function creator(): BelongsTo {
        return $this->belongsTo(Admin::class, 'created_by', 'account_id');
    }
}

