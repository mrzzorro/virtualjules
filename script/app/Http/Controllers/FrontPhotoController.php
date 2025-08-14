<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Video;
use App\Option;
use DB;
use App\Photo;
use App\PhotoComment;
use App\PhotoCommentUser;
use Session;
use App\Notification;
use App\Report;

class FrontPhotoController extends Controller
{
    public function index()
	{
		 try {
        DB::connection()->getPdo();
        if(DB::connection()->getDatabaseName()){
            	if(!Auth::check()) {
					$ads_show_per_second = Option::where('key','ads_show_per_second')->first();
			        session_start();
			        if(!isset($_SESSION['last_activity']))
			        {
			            $_SESSION['last_activity'] = time();
					}
				}

				if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
					$ip = $_SERVER['HTTP_CLIENT_IP'];  
				}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
				}else{  
					$ip = $_SERVER['REMOTE_ADDR'];  
				}  

				$address = geoip()->getLocation($ip);

				// $videos = Video::with('user')->where([
				// 	['status','public'],
				// 	['country',$address->country],
				// ])->withCount('favourite_to_user')
				// ->withCount('comments')
				// ->orderBy('favourite_to_user_count','desc')
				// ->orderBy('view','desc')
				// ->orderBy('comments_count','desc')
				// ->latest()->paginate(20);

				$photos = Photo::with('user')->where([
					['is_approved',1]
				])
				->latest()->paginate(20);

				if($photos->count() < 15)
				{
					$photos = Photo::with('user')->where('is_approved',1)->latest()->paginate(20);
				}

				abort_if($photos->isEmpty(),204);

				$option = Option::where('key','site_value')->first();
				$site_value = json_decode($option->value);

				return view('frontphotos.welcomephoto',compact('photos','site_value'));
	        }else{
	            return redirect()->route('install');
	        }
	    } catch (\Exception $e) {
	        return redirect()->route('install');
	    }
	}

	public function popup(Request $request)
    {
    	$photo = Photo::with('user')->where('id',$request->id)->first();
    	$photo_key = 'photo'.$photo->id;
    	if(!Session::has($photo_key))
    	{
    		// $video->increment('view');
    		Session::put($photo_key,1);
    	}
    	return view('frontphotos.modelphoto',compact('photo'));
    }

	 public function photoCommentStore(Request $request)
    {
    	
    	$photo = $photo = Photo::with('user')->where('id',$request->photo_id)->first();
    	$comment = new PhotoComment();
    	$comment->user_id = Auth::User()->id;
    	$comment->photo_id = $request->photo_id;
    	if($request->parent_id != null)
    	{
    		$comment->parent_id = $request->parent_id;
    	}
        if($request->mention_id != null)
        {
            $comment->mention_id = $request->mention_id;
        }
    	$comment->message = $request->comment;
    	$comment->save();
    	return view('frontphotos.photocomment',compact('photo'));
    }

	public function like(Request $request)
    {
    	$photo = Photo::find($request->id);
    	$user = Auth::User();
    	$isFavourite = $user->favourite_photos()->where('photo_id',$request->id)->count();

    	if($isFavourite == 0)
    	{
    		$user->favourite_photos()->attach($photo);
            $notification = new Notification();
            $notification->user_id = Auth::User()->id;
            $notification->parent_id = $photo->user_id;
            $notification->body = 'Liked Your Photo';
            $notification->link = 'photo/'.$photo->id;
            $notification->save();
    		return "like";
    	}else{
    		$user->favourite_photos()->detach($photo);
    		return "dislike";
    	}
    }

	    public function comment_like(Request $request)
    {
        $comment = PhotoComment::find($request->id);
        $user = Auth::User();
        $isFavourite = $user->favourite_photo_comments()->where('photo_comment_id',$request->id)->count();

        if($isFavourite == 0)
        {
            $user->favourite_photo_comments()->attach($comment);
            return $comment->favourite_to_user->count();
        }else{
            $user->favourite_photo_comments()->detach($comment);
            return $comment->favourite_to_user->count();
        }
    }

	public function ellipsis(Request $request)
    {
    	$photo = Photo::where('id',$request->id)->first();
    	return view('frontphotos.ellipishphoto',compact('photo'));
    }

	public function report(Request $request)
    {
    	$validator = \Validator::make($request->all(), [
            'body' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()[0]]);
        }

    	$photo = Photo::where('id',$request->photo_id)->first();
    	$report = new Report();
    	$report->user_id = Auth::User()->id;
    	$report->body = $request->body;
    	$report->type = "photo";
    	$report->parent_id = $photo->user_id;
    	$report->video_id = $request->photo_id;
    	$report->save();

    	return response()->json('ok');
    }

    public function show(Request $request)
    {
    	$photo = Photo::where('id',$request->id)->first();
    	return view('frontphotos.report',compact('photo'));
    }
}
