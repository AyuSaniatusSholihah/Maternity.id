<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'slug', 'description'])]
class Category extends Model
{
    use HasUuids;

    public const MODULE_SLUGS = [
        'kehamilan',
        'persiapan-persalinan',
        'bayi-baru-lahir',
        'menyusui',
        'makanan-bayi',
        'pola-asuh',
    ];

    protected $table = 'categories';
}
