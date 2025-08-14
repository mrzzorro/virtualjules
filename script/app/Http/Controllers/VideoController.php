<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use Auth;
use Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Helpers\VideoHelper;

class VideoController extends Controller
{
    public function show(Request $request,$slug)
    {
    	$video = Video::where('slug',$slug)->first();
    	if($video)
    	{
    		$video_key = 'video_'.$video->id;
	    	if(!Session::has($video_key))
	    	{
	    		$video->increment('view');
	    		Session::put($video_key,1);
	    	}
    		return view('singlevideo',compact('video'));
    	}else{
    		return abort(404);
    	}
    }

    public function latest(Request $request)
    {

		if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
	                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
	    }else{  
	            $ip = $_SERVER['REMOTE_ADDR'];  
	     }  

    	$address = geoip()->getLocation($ip);

		$videos = Video::with('user')->where([
						    ['status','public'],
						    ['country',$address->country],
						])->latest()->paginate(20);

		if($videos->count() < 15)
		{
			$videos = Video::with('user')->where([
						    ['status','public'],
						])->latest()->paginate(20);
		}

		if($request->data)
		{
            if($videos->isEmpty())
            {
                return "no";
            }
            abort_if($videos->isEmpty(),204);
			return view('layouts.frontend.section.video',compact('videos'));
		}
		$type = "latest";
		return view('video',compact('videos','type'));
    	
    }

    public function popular(Request $request)
    {
		if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
	                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
	    }else{  
	            $ip = $_SERVER['REMOTE_ADDR'];  
	     }  

    	$address = geoip()->getLocation($ip);

		$videos = Video::with('user')->where([
						    ['status','public'],
						    ['country',$address->country],
						])->orderBy('view','desc')
						->paginate(20);

		if($videos->count() < 15)
		{
			$videos = Video::with('user')->where([
						    ['status','public'],
						])->orderBy('view','desc')
						->paginate(20);
		}

		if($request->data)
		{
            if($videos->isEmpty())
            {
                return "no";
            }
            abort_if($videos->isEmpty(),204);
			return view('layouts.frontend.section.video',compact('videos'));
		}
		$type = "popular";
		return view('video',compact('videos','type'));
    	
    }

    public function trending(Request $request)
    {
		if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
	                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
	    }else{  
	            $ip = $_SERVER['REMOTE_ADDR'];  
	     }  

    	$address = geoip()->getLocation($ip);

		$videos = Video::with('user')->where([
						    ['status','public'],
						])->withCount('favourite_to_user')
						->withCount('comments')
						->orderBy('favourite_to_user_count','desc')
						->orderBy('view','desc')
						->orderBy('comments_count','desc')
						->paginate(20);

		if($videos->count() < 15)
		{
			$videos = Video::with('user')->where([
						    ['status','public'],
						])->withCount('favourite_to_user')
						->withCount('comments')
						->orderBy('favourite_to_user_count','desc')
						->orderBy('view','desc')
						->orderBy('comments_count','desc')
						->paginate(10);
		}

		if($request->data)
		{
            if($videos->isEmpty())
            {
                return "no";
            }
            abort_if($videos->isEmpty(),204);
			return view('layouts.frontend.section.video',compact('videos'));
		}

		$type = "trending";
		return view('video',compact('videos','type'));
    }

    // User-facing methods
    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_type' => ['required', Rule::in(['url', 'upload'])],
            'url' => 'nullable|url|required_if:video_type,url',
            'video_file' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:30720|required_if:video_type,upload',
            'cta_label' => 'nullable|string|max:255',
            'cta_url' => 'nullable|url|required_with:cta_label',
        ]);

        $videoData = [
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title . '-' . time()),
            'status' => 'pending', // Videos require admin approval
            'is_approved' => false,
            'cta_label' => $request->cta_label,
            'cta_url' => $request->cta_url,
            'video_type' => $request->video_type,
        ];

        if ($request->video_type === 'url') {
            $videoData['url'] = $request->url;
            $videoData['thumbnail_url'] = VideoHelper::getYouTubeThumbnail($request->url) ?? VideoHelper::getVimeoThumbnail($request->url);
        } elseif ($request->video_type === 'upload') {
            if ($request->hasFile('video_file')) {
                $file = $request->file('video_file');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $fileName);
                $videoData['file_path'] = 'uploads/' . $fileName;
                $videoData['url'] = null; // Set url to null for uploaded videos
            }
        }

        Video::create($videoData);

        return redirect()->route('upload')->with('success', 'Video submitted for approval!');
    }

    // Admin-facing methods
    public function manage(Request $request)
    {
        $videos = Video::with('user')
                        ->when($request->has('type'), function ($query) use ($request) {
                            return $query->where('video_type', $request->type);
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

        return view('admin.videos.manage', compact('videos'));
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_type' => ['required', Rule::in(['url', 'upload'])],
            'url' => 'nullable|url|required_if:video_type,url',
            'video_file' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:30720|required_if:video_type,upload',
            'cta_label' => 'nullable|string|max:255',
            'cta_url' => 'nullable|url|required_with:cta_label',
        ]);

        $videoData = [
            'title' => $request->title,
            'description' => $request->description,
            'cta_label' => $request->cta_label,
            'cta_url' => $request->cta_url,
            'video_type' => $request->video_type,
        ];

        if ($request->video_type === 'url') {
            $videoData['url'] = $request->url;
            $videoData['file_path'] = null; // Clear file_path if changing to URL type
            $videoData['thumbnail_url'] = VideoHelper::getYouTubeThumbnail($request->url) ?? VideoHelper::getVimeoThumbnail($request->url);
        } elseif ($request->video_type === 'upload') {
            if ($request->hasFile('video_file')) {
                // Delete old file if exists
                if ($video->file_path && file_exists(public_path($video->file_path))) {
                    unlink(public_path($video->file_path));
                }
                $file = $request->file('video_file');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $fileName);
                $videoData['file_path'] = 'uploads/' . $fileName;
                $videoData['url'] = null; // Clear URL if changing to upload type
            }
        }

        $video->update($videoData);

        return redirect()->route('admin.videos.manage')->with('success', 'Video updated successfully!');
    }

    public function toggleApproval($id)
    {
        $video = Video::findOrFail($id);
        $video->is_approved = !$video->is_approved;
        $video->status = $video->is_approved ? 'public' : 'pending';
        $video->save();

        return back()->with('success', 'Video approval status updated.');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        if ($video->file_path && file_exists(public_path($video->file_path))) {
            unlink(public_path($video->file_path));
        }
        $video->delete();

        return back()->with('success', 'Video deleted successfully.');
    }
}