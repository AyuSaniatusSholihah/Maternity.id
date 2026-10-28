<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\View\View;

class AdminMaterialController extends Controller
{
    public function index(): View
    {
        $materials = Material::query()
            ->with(['category', 'uploader.account', 'events'])
            ->latest()
            ->get()
            ->map(fn (Material $material): array => [
                'id' => $material->id,
                'title' => $material->title,
                'slug' => $material->slug,
                'description' => $material->description,
                'content' => $material->content,
                'uploadedBy' => $material->uploaded_by,
                'imageUrl' => $material->image_url ?: asset('images/placeholder.jpg'),
                'category' => $material->category?->name ?? 'Tanpa kategori',
                'uploader' => $material->uploader?->account?->name ?? 'Tidak diketahui',
                'uploaderEmail' => $material->uploader?->account?->email ?? '-',
                'events' => $material->events->pluck('title')->values()->all(),
                'createdAt' => $material->created_at?->format('d M Y H:i') ?? '-',
                'updatedAt' => $material->updated_at?->format('d M Y H:i') ?? '-',
            ])
            ->values();

        return view('admin.dashboard', [
            'adminMaterials' => $materials,
        ]);
    }
}