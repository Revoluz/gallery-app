<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'name' => 'required|min:3|max:100',
            'username' => 'required|min:3|max:100|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);
        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'slug' => Str::slug($validated['username']),
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'level' => 'user',
        ]);
        return redirect()->route('login')->with('success', 'succesfully created account');
    }
    public function registerAdmin()
    {
        return view('auth.register');
    }
    public function storeAdmin(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'name' => 'required|min:3|max:100',
            'username' => 'required|min:3|max:100|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);
        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'slug' => Str::slug($validated['username']),
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'level' => 'admin',
        ]);
        return redirect()->route('login')->with('success', 'succesfully created account');
    }

    public function login()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $credential = $request->validate([
            'username' => 'required',
            'password' => 'required|min:8'
        ]);
        // dd(Auth::attempt($credential));
        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            return redirect()->route('home.index')->with('success', 'Logged in Successfully!');
        }
        return redirect()->route('login');
    }
    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login')->with('succes', 'logged out successfully');
    }
}
