<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Photo;
use App\Http\Resources\Api\PhotoResource;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('store');
    }

    public function index(Request $request)
    {
        $query = Photo::with(['user', 'photoItems'])->where('is_approved', true);

        if ($request->has('sort')) {
            if ($request->sort === 'trending') {
                $query->withCount('likes')->orderBy('likes_count', 'desc');
            } else {
                // Default to latest
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $photos = $query->paginate(20);

        return PhotoResource::collection($photos);
    }

    public function show($slug)
    {
        $photo = Photo::with(['user', 'photoItems'])->where('id', $slug)->where('is_approved', true)->firstOrFail();
        return new PhotoResource($photo);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo_type' => ['required', Rule::in(['single', 'carousel'])],
            'single_photo' => 'nullable|image|max:2048|required_if:photo_type,single',
            'carousel_photos' => 'nullable|array|required_if:photo_type,carousel',
            'carousel_photos.*' => 'image|max:2048',
            'cta_label' => 'nullable|string|max:255',
            'cta_url' => 'nullable|url|required_with:cta_label',
        ]);

        $photoData = [
            'user_id' => $request->user()->id,
            'title' => $validatedData['title'],
            'slug' => Str::slug($validatedData['title'] . '-' . time()),
            'description' => $validatedData['description'] ?? null,
            'photo_type' => $validatedData['photo_type'],
            'cta_label' => $validatedData['cta_label'] ?? null,
            'cta_url' => $validatedData['cta_url'] ?? null,
            'is_approved' => false, // Photos require admin approval
        ];

        if ($validatedData['photo_type'] === 'single') {
            if ($request->hasFile('single_photo')) {
                $file = $request->file('single_photo');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $path = 'uploads/';
                $file->move($path, $fileName);
                $photoData['file_path'] = $path . $fileName;
            }
        }

        $photo = Photo::create($photoData);

        if ($validatedData['photo_type'] === 'carousel') {
            if ($request->hasFile('carousel_photos')) {
                foreach ($request->file('carousel_photos') as $index => $file) {
                    $fileName = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                    $path = 'uploads/';
                    $file->move($path, $fileName);
                    $photo->photoItems()->create([
                        'file_path' => $path . $fileName,
                        'order' => $index,
                    ]);
                }
            }
        }

        // Eager load the relationships for the response
        $photo->load(['user', 'photoItems']);

        return new PhotoResource($photo);
    }
}
