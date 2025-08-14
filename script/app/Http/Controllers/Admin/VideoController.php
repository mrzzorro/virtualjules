<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Video;
use App\Report;
use Illuminate\Validation\Rule;
use App\Helpers\VideoHelper;

class VideoController extends Controller
{
    public function index()
    {
    	$videos = Video::latest()->paginate(20);
    	return view('admin.video.index',compact('videos'));
    }

    public function report()
    {
        $reports = Report::where('type','video')->latest()->paginate(20);
    	return view('admin.video.report',compact('reports'));
    }

    public function view(Request $request,$id)
    {
    	$video = Video::find($id);
    	$video->view = $video->view + $request->view;
    	$video->save();
    	toast('Your video fake view successfully generated','success');
    	return back();
    }

    public function delete($id)
    {
    	Video::find($id)->delete();
    	toast('Your video successfully deleted','success');
    	return back();
    }

    public function report_delete($id)
    {
        Report::find($id)->delete();
        toast('Your report successfully deleted','success');
        return back();
    }

    // New Admin Video Management Methods
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
            'video_file' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:30720',
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
