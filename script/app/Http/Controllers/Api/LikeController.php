<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Video;
use App\Photo;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function storeVideo(Request $request, Video $video)
    {
        $request->user()->favourite_videos()->syncWithoutDetaching([$video->id]);

        return response()->json(['message' => 'Video liked successfully']);
    }

    public function destroyVideo(Request $request, Video $video)
    {
        $request->user()->favourite_videos()->detach($video->id);

        return response()->json(['message' => 'Video unliked successfully']);
    }

    public function storePhoto(Request $request, Photo $photo)
    {
        $request->user()->favourite_photos()->syncWithoutDetaching([$photo->id]);

        return response()->json(['message' => 'Photo liked successfully']);
    }

    public function destroyPhoto(Request $request, Photo $photo)
    {
        $request->user()->favourite_photos()->detach($photo->id);

        return response()->json(['message' => 'Photo unliked successfully']);
    }
}
