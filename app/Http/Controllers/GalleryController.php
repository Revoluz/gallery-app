<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'name' => 'required|min:3|max:40',
            'description' => 'required|min:3|max:300',
            'image' => 'required|min:3|max:20480',
        ]);
        $image = $request->file('image');
        $imageName = time() . "-" . Str::slug($validated['name']) . "." . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('gallery', $imageName, 'public');
        Gallery::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'path' => $imagePath,
            'user_id' => Auth::id()
        ]);
        return redirect()->back()->with('success', 'Image succesfully upload');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Gallery $image)
    {
        if (!$image->status) {
            if (auth()->user()->level !== 'admin' && auth()->user() != $image->user) {
                abort(404);
            }
        }
        $comments = $image->comments;
        return view('User.detail-image-home', [
            'image' => $image, 'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $image)
    {
        $this->authorize('auth.guard', $image->user);
        // dd($image);
        $validated = $request->validate([
            'name' => 'required|min:3|max:40',
            'description' => 'required|min:3|max:300',
        ]);
        $image->update($validated);
        return redirect()->back()->with('success', 'Successfully update image');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $image)
    {
        // dd($image);
        $this->authorize('auth.guard', $image->user);

        if (Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }
        $image->delete();
        return redirect()->route('profile.index', auth()->user())->with('success', 'Succesfully delete image ' . $image->name);
    }
}
