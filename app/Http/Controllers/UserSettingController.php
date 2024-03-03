<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
// use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserSettingController extends Controller
{
    // remove thsi index
    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
        // dd($setting);
        // Gate::authorize
        $this->authorize('auth.guard', $user);
        return view(
            'User.settings-show-profile',
            ['user' => $user]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('auth.guard', $user);
        return view('User.settings-edit-profile', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('auth.guard', $user);
        $rules = [
            'name' => 'required|min:3|max:100',
            'username' => 'required|min:3|max:100',
            'email' => 'required|email',
            'password' => 'nullable|min:8',
        ];

        if ($request->username != $user->username) {
            $rules['username'] = 'required|min:3|max:100|unique:users,username';
        }
        if ($request->email != $user->email) {
            $rules['email'] = 'required|email|unique:users,email';
        }
        $validated = $request->validate($rules);
        if ($request->password !== null) {
            $user->password = Hash::make($validated['password']);
        }
        if ($request->username != $user->username) {
            $user->username = $validated['username'];
            $user->slug = Str::slug($validated['username']);
        }
        if ($request->email != $user->name) {
            $user->email = $validated['email'];
        }
        $user->name = $validated['name'];
        // dd($validated);
        $user->save();
        // dd();
        return redirect()->route('user.edit', $user->slug)->with('success', 'succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('auth.guard', $user);

        // $this->authorize('auth.guard', $user);
        if ($user->galleries) {
            // Hapus galeri terkait
            // dd($user);
            // $user->galleries->each(function ($image) {
            //     // Storage::disk('public')->delete('public/gallery/' . $gallery->name);
            //     // if (Storage::disk('public')->exists('gallery/' . $gallery->name)) {
            //     //     Storage::disk('public')->delete('gallery/' . $gallery->name);
            //     // }
            //     if (Storage::disk('public')->exists($image->path)) {
            //         Storage::disk('public')->delete($image->path);
            //     }
            // });
            foreach ($user->galleries as $gallery) {
                if (Storage::disk('public')->exists($gallery->path)) {
                    Storage::disk('public')->delete($gallery->path);
                }
            }
        }
        // Hapus foto profil jika ada test
        if ($user->profile->photo ?? false) {
            if (Storage::disk('public')->exists($user->profile->photo)) {
                Storage::disk('public')->delete($user->profile->photo);
            }
        }
        $user->delete();
        return redirect()->route('login');
    }
}
