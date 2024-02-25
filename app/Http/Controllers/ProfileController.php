<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        // dd($user);
        $images = Gallery::where('user_id', $user->id)->latest()->paginate(15);
        // $images = $user->galleries;
        // dd($images);
        if ($images->isEmpty()) {
            $conImages = false;
        } else {
            $conImages = true;
        }


        return view('User.profile', [
            'user' => $user,
            'images' => $images,
            'year' => Carbon::now()->year,
            'conImages'=>$conImages,
        ]);
    }
    public function showImage(User $user, Gallery $id)
    {
        // dd($image);
        $this->authorize('auth.guard', $user);

        $comments = $id->comments;
        return view('User.detail-image-home', [
            'image' => $id, 'comments' => $comments
        ]);
    }
    // halaman account management
    public function create(User $user)
    {
        $this->authorize('auth.guard', $user);
        // dd($setting->id);
        // $data = Profile::where('user_id', $user->id)->first() ?? null;

        $data = $user->profile ?? null;
        // $profile = Profile::where('user_id', 1)->first();
        return view('User.account-management', [
            'user' => $user,
            'data' => $data
        ]);
    }
    public function store(Request $request, User $user)
    {
        $this->authorize('auth.guard', $user);
        $validated = $request->validate([
            'description' => 'nullable|max:300',
            'photo' => 'nullable|image',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'facebook' => 'nullable|url',
        ]);
        if ($request->has('photo')) {
            $image = $request->file('photo');
            $imageName = time() . "-" . $user->username . "." . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('profile', $imageName, 'public');
            $validated['photo'] = $imagePath;
        }
        $validated['user_id'] = $user->id;
        Profile::create($validated);

        return redirect()->back()->with('success', 'succesfully saved profile');
    }
    public function update(Request $request, User $user)
    {
        $this->authorize('auth.guard', $user);

        $validated = $request->validate([
            'description' => 'nullable|max:300',
            'photo' => 'nullable|image',
            'instagram' => 'nullable|active_url',
            'twitter' => 'nullable|active_url',
            'facebook' => 'nullable|active_url',
        ]);

        // Cek apakah profile sudah ada
        // $profile = Profile::where('user_id', $user->id)->first() ?? new Profile();
        $profile = $user->profile;

        // Handle photo upload (jika ada)
        if ($request->has('photo')) {
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }
            $image = $request->file('photo');
            $imageName = time() . "-" . $user->username . "." . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('profile', $imageName, 'public');
            $validated['photo'] = $imagePath;
        }
        $validated['user_id'] = $user->id;

        // Update atau buat profile baru
        $profile->update($validated);

        return redirect()->back()->with('success', 'Profile saved successfully');
    }
}
