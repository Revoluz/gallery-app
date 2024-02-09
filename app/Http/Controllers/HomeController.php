<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\returnArgument;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($user = auth()->user()) {
            if (!$user->profile) {
                Profile::create([
                    'user_id' => auth()->user()->id
                ]);
            }
        }

        $images = Gallery::where('status', 1)->latest()->paginate(15);
        // dd($images);
        if ($request->ajax()) {
            $view = view('User.gallery', compact('images'))->render();
            return response()->json(['html' => $view]);
        }

        return view('User.home', compact('images'));
    }
    public function popular(Request $request)
    {
        // descending adalah pengurutan data dari besar ke kecil
        // $images = Gallery::where('status', 1)->orderBY('like_post', 'desc')->paginate(15);
        $images = Gallery::where('status', 1)->paginate(15);

        foreach ($images as $image) {
            $image->like_count = DB::table('gallery_like')
                ->where('gallery_id', $image->id)
                ->count();
        }
        $images = $images->sortByDesc('like_count');
        // dd($images);

        // dd($images);
        // dd($images);
        // $images = Gallery::latest();
        // dd($images);
        if ($request->ajax()) {
            $view = view('User.gallery', compact('images'))->render();
            return response()->json(['html' => $view]);
        }

        return view('User.home', compact('images'));
    }
    public function random(Request $request)
    {
        $images = Gallery::where('status', 1)->inRandomOrder()->paginate(15);
        if ($request->ajax()) {
            $view = view('User.gallery', compact('images'))->render();
            return response()->json(['html' => $view]);
        }
        // dd($images);
        return view('User.home', compact('images'));
    }
    public function search(Request $request)
    {
        // 'keyword' sesuai dengan nama form
        $keyword = request()->input('keyword');
        $images = Gallery::where('status', 1)->where('name', 'like', '%' . $keyword . '%')->paginate(15);
        if ($request->ajax()) {
            $view = view('User.gallery', compact('images'))->render();
            return response()->json(['html' => $view]);
        }
        return view('User.home', compact('images'));
    }
}
