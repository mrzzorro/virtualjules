<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\PhotoItem;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PhotoController extends Controller
{
    // User-facing methods
    public function create()
    {
        return view('photos.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo_type' => ['required', Rule::in(['single', 'carousel'])],
            'single_photo' => 'nullable|image|max:2048|required_if:photo_type,single',
            'carousel_photos.*' => 'nullable|image|max:2048|required_if:photo_type,carousel',
            'cta_label' => 'nullable|string|max:255',
            'cta_url' => 'nullable|url|required_with:cta_label',
        ]);

        $photoData = [
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title . '-' . time()),
            'description' => $request->description,
            'photo_type' => $request->photo_type,
            'cta_label' => $request->cta_label,
            'cta_url' => $request->cta_url,
            'is_approved' => false, // Photos require admin approval
        ];

        if ($request->photo_type === 'single') {
            if ($request->hasFile('single_photo')) {
                $file = $request->file('single_photo');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $fileName);
                $photoData['file_path'] = 'uploads/' . $fileName;
            }
        }

        $photo = Photo::create($photoData);

        if ($request->photo_type === 'carousel') {
            if ($request->hasFile('carousel_photos')) {
                foreach ($request->file('carousel_photos') as $index => $file) {
                    $fileName = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads'), $fileName);
                    $photo->photoItems()->create([
                        'file_path' => 'uploads/' . $fileName,
                        'order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('upload')->with('success', 'Photo submitted for approval!');
    }

    public function show($slug)
    {
        $photo = Photo::where('id', $slug)->where('is_approved', 1)->firstOrFail();
        return view('photos.show', compact('photo'));
    }

    public function latest(Request $request)
    {
        $photos = Photo::where('is_approved', true)->latest()->paginate(20);
        if($request->data)
        {
            if($photos->isEmpty())
            {
                return "no";
            }
            abort_if($photos->isEmpty(),204);
            return view('layouts.frontend.section.singlephoto',compact('photos'));
        }
        $type = "latest";
        return view('photos.index',compact('photos','type'));
    }

    public function trending(Request $request)
    {
        $photos = Photo::where('is_approved', true)
                        ->withCount('likes')
                        ->orderBy('likes_count', 'desc')
                        ->paginate(20);

        if($request->data)
        {
            if($photos->isEmpty())
            {
                return "no";
            }
            abort_if($photos->isEmpty(),204);
            return view('layouts.frontend.section.singlephoto',compact('photos'));
        }
        $type = "trending";
        return view('photos.index',compact('photos','type'));
    }

    // Admin-facing methods
    public function manage(Request $request)
    {
        $photos = Photo::with('user')
                        ->when($request->has('type'), function ($query) use ($request) {
                            return $query->where('photo_type', $request->type);
                        })
                        ->when($request->has('status'), function ($query) use ($request) {
                            if ($request->status === 'approved') {
                                return $query->where('is_approved', true);
                            } elseif ($request->status === 'pending') {
                                return $query->where('is_approved', false);
                            }
                        })
                        ->latest()
                        ->paginate(20);

        return view('admin.photos.manage', compact('photos'));
    }

    public function edit($id)
    {
        $photo = Photo::with('photoItems')->findOrFail($id);
        return view('admin.photos.edit', compact('photo'));
    }

    public function update(Request $request, $id)
    {
        $photo = Photo::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo_type' => ['required', Rule::in(['single', 'carousel'])],
            'single_photo' => 'nullable|image|max:2048',
            'carousel_photos.*' => 'nullable|image|max:2048l',
            'cta_label' => 'nullable|string|max:255',
            'cta_url' => 'nullable|url|required_with:cta_label',
        ]);

        $photoData = [
            'title' => $request->title,
            'description' => $request->description,
            'photo_type' => $request->photo_type,
            'cta_label' => $request->cta_label,
            'cta_url' => $request->cta_url,
        ];

        if ($request->photo_type === 'single') {
            if ($request->hasFile('single_photo')) {
                // Delete old file if exists
                if ($photo->file_path && file_exists(public_path($photo->file_path))) {
                    unlink(public_path($photo->file_path));
                }
                $file = $request->file('single_photo');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $fileName);
                $photoData['file_path'] = 'uploads/' . $fileName;
                $photo->photoItems()->delete(); // Clear carousel items if changing to single
            }
        } elseif ($request->photo_type === 'carousel') {
            $photoData['file_path'] = null; // Clear single photo path if changing to carousel
            if ($request->hasFile('carousel_photos')) {
                // Delete old carousel items
                foreach ($photo->photoItems as $item) {
                    if (file_exists(public_path($item->file_path))) {
                        unlink(public_path($item->file_path));
                    }
                }
                $photo->photoItems()->delete();

                foreach ($request->file('carousel_photos') as $index => $file) {
                    $fileName = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads'), $fileName);
                    $photo->photoItems()->create([
                        'file_path' => 'uploads/' . $fileName,
                        'order' => $index,
                    ]);
                }
            }
        }

        $photo->update($photoData);

        return redirect()->route('admin.photos.manage')->with('success', 'Photo updated successfully!');
    }

    public function toggleApproval($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->is_approved = !$photo->is_approved;
        $photo->save();

        return back()->with('success', 'Photo approval status updated.');
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        if ($photo->file_path && file_exists(public_path($photo->file_path))) {
            unlink(public_path($photo->file_path));
        }
        foreach ($photo->photoItems as $item) {
            if (file_exists(public_path($item->file_path))) {
                unlink(public_path($item->file_path));
            }
        }
        $photo->delete();

        return back()->with('success', 'Photo deleted successfully.');
    }
}