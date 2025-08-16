<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Video;
use App\Http\Resources\Api\VideoResource;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Helpers\VideoHelper;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('store');
    }

    public function index(Request $request)
    {
        $query = Video::with('user')->where('is_approved', true);

        if ($request->has('sort')) {
            if ($request->sort === 'popular') {
                $query->orderBy('view', 'desc');
            } elseif ($request->sort === 'trending') {
                $query->withCount('favourite_to_user')
                      ->withCount('comments')
                      ->orderBy('favourite_to_user_count','desc')
                      ->orderBy('view','desc')
                      ->orderBy('comments_count','desc');
            } else {
                // Default to latest
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $videos = $query->paginate(20);

        return VideoResource::collection($videos);
    }

    public function show($slug)
    {
        $video = Video::with('user')->where('slug', $slug)->where('is_approved', true)->firstOrFail();

        // Increment view count - simple version for API
        $video->increment('view');

        return new VideoResource($video);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_type' => ['required', Rule::in(['url', 'upload'])],
            'url' => 'nullable|url|required_if:video_type,url',
            'video_file' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:30720|required_if:video_type,upload',
            'cta_label' => 'nullable|string|max:255',
            'cta_url' => 'nullable|url|required_with:cta_label',
        ]);

        $videoData = [
            'user_id' => $request->user()->id,
            'title' => $validatedData['title'],
            'description' => $validatedData['description'] ?? null,
            'slug' => Str::slug($validatedData['title'] . '-' . time()),
            'status' => 'pending', // Videos require admin approval
            'is_approved' => false,
            'cta_label' => $validatedData['cta_label'] ?? null,
            'cta_url' => $validatedData['cta_url'] ?? null,
            'video_type' => $validatedData['video_type'],
        ];

        if ($validatedData['video_type'] === 'url') {
            $videoData['url'] = $validatedData['url'];
            $videoData['thumbnail_url'] = VideoHelper::getYouTubeThumbnail($validatedData['url']) ?? VideoHelper::getVimeoThumbnail($validatedData['url']);
        } elseif ($validatedData['video_type'] === 'upload') {
            if ($request->hasFile('video_file')) {
                $file = $request->file('video_file');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $path = 'uploads/';
                $file->move($path, $fileName);
                $videoData['file_path'] = $path . $fileName;
                $videoData['url'] = null; // Set url to null for uploaded videos
            }
        }

        $video = Video::create($videoData);

        return new VideoResource($video);
    }
}
