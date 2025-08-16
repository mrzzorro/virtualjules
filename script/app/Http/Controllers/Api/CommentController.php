<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Video;
use App\Photo;
use App\Comment;
use App\PhotoComment;
use App\Http\Resources\Api\CommentResource;
use App\Http\Resources\Api\PhotoCommentResource;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['storeVideo', 'storePhoto']);
    }

    public function indexVideo(Video $video)
    {
        $comments = $video->comments()->with('user')->latest()->paginate(20);
        return CommentResource::collection($comments);
    }

    public function storeVideo(Request $request, Video $video)
    {
        $request->validate(['message' => 'required|string']);

        $comment = new Comment();
        $comment->user_id = $request->user()->id;
        $comment->message = $request->message;
        $comment->parent_id = $request->parent_id; // For replies

        $video->comments()->save($comment);

        $comment->load('user'); // Eager load for the response

        return new CommentResource($comment);
    }

    public function indexPhoto(Photo $photo)
    {
        // Based on the database schema, the Photo model needs a 'comments' relationship
        // that points to the PhotoComment model. Assuming this relationship exists.
        $comments = $photo->comments()->with('user')->latest()->paginate(20);
        return PhotoCommentResource::collection($comments);
    }

    public function storePhoto(Request $request, Photo $photo)
    {
        $request->validate(['message' => 'required|string']);

        $comment = new PhotoComment();
        $comment->user_id = $request->user()->id;
        $comment->photo_id = $photo->id;
        $comment->message = $request->message;
        $comment->parent_id = $request->parent_id;

        $comment->save();

        $comment->load('user');

        return new PhotoCommentResource($comment);
    }
}
