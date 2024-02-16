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
        $images = Gallery::where('status', 1)->inRandomOrder('id')->paginate(15);
        // dd($images);
        abort_if($images->isEmpty(),204);
        return view('User.home', compact('images'));
    }
    public function search(Request $request)
    {
        // 'keyword' sesuai dengan nama form
        $keyword = request()->input('keyword');
        $images = Gallery::where('status', 1)->where('name', 'like', '%' . $keyword . '%')->paginate(15);
        // abort_if($images->isEmpty(), 204);

        // if ($request->ajax()) {
        //     $view = view('User.gallery', compact('images'))->render();
        //     return response()->json(['html' => $view]);
        // }
        return view('User.home', compact('images'));
    }
}
