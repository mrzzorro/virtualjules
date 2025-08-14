<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\Api\UserResource;
use App\Http\Resources\Api\VideoResource;
use App\Http\Resources\Api\PhotoResource;

class UserController extends Controller
{
    public function show($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();

        $videos = $user->videos()->with('user')->where('is_approved', true)->latest()->paginate(10);
        $photos = $user->photos()->with('user')->where('is_approved', true)->latest()->paginate(10);

        return response()->json([
            'user' => new UserResource($user),
            'videos' => VideoResource::collection($videos),
            'photos' => PhotoResource::collection($photos),
        ]);
    }
}
