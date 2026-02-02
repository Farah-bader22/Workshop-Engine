<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class WorkshopController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'workshops' => Workshop::with('user')->latest()->get(),
            'workshopsCount' => Workshop::where('type', 'workshop')->count(),
            'postsCount' => Workshop::where('type', 'post')->count(),
            'comments' => Comment::with('workshop')->latest()->get(),
        ]);
    }

    public function showcase()
    {
        return Inertia::render('Showcase', [
            'workshops' => Workshop::with('user')->latest()->get()
        ]);
    }

    public function show($id)
    {
        $item = Workshop::with(['comments', 'user'])->findOrFail($id);
        return Inertia::render('Detail', [
            'item' => $item,
            'comments' => $item->comments
        ]);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'required|string',
            'type'         => 'required|string|in:workshop,post',
            'content'      => 'nullable|string',
            'date'         => 'nullable|string',
            'code_snippet' => 'nullable|string',
            'image'        => 'nullable|image|max:5120',
            'video'        => 'nullable|max:51200', // 50MB Max
        ]);

        try {
            $imageUrl = null;
            $videoUrl = null;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                $path = public_path('uploads/images');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                $image->move($path, $imageName);
                $imageUrl = '/uploads/images/' . $imageName;
            }


            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoName = time() . '_' . uniqid() . '.' . $video->getClientOriginalExtension();

                $path = public_path('uploads/videos');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                $video->move($path, $videoName);
                $videoUrl = '/uploads/videos/' . $videoName;
            }


            Workshop::create([
                'user_id'      => auth()->id(),
                'title'        => strtoupper($validated['title']),
                'category'     => $validated['category'],
                'content'      => $validated['content'] ?? '',
                'type'         => $validated['type'],
                'date'         => $validated['date'] ?? now()->format('Y-m-d'),
                'code_snippet' => $validated['code_snippet'] ?? null,
                'image_url'    => $imageUrl,
                'video_url'    => $videoUrl,
            ]);

            return Redirect::back()->with('success', 'PROCESS_COMPLETED_SUCCESSFULLY');

        } catch (\Exception $e) {
            return Redirect::back()->with('error', "حدث خطأ أثناء الرفع: " . $e->getMessage());
        }
    }

    public function destroy(Workshop $workshop)
    {
        if (auth()->id() === $workshop->user_id || auth()->user()->is_admin) {


            if ($workshop->image_url) {
                $imagePath = public_path(ltrim($workshop->image_url, '/'));
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }


            if ($workshop->video_url) {
                $videoPath = public_path(ltrim($workshop->video_url, '/'));
                if (File::exists($videoPath)) {
                    File::delete($videoPath);
                }
            }

            $workshop->delete();
            return Redirect::back()->with('success', 'MODULE_TERMINATED');
        }
        return Redirect::back()->with('error', 'UNAUTHORIZED');
    }
}


