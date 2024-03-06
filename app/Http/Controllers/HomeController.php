<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\returnArgument;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $images = Gallery::where('status', 1)->inRandomOrder('id')->paginate(15);
        // dd($images);
        if ($images->isEmpty()) {
            $conImages = false;
        } else {
            $conImages = true;
        }
        abort_if($images->isEmpty(),204);
        return view('User.home', compact('images','conImages'));
    }
    public function search(Request $request)
    {
        // 'keyword' sesuai dengan nama form
        $keyword = request()->input('keyword');
        // dd($keyword);
        $slackLogger = Log::channel('search');
        $slackLogger->info('User searched for {keyword}',['keyword'=> $keyword]);
        $images = Gallery::where('status', 1)->where('name', 'like', '%' . $keyword . '%')->paginate(15);
        $image = Gallery::where('status', 1)->where('name', 'like', '%' . $keyword . '%')->count();
        // abort_if($images->isEmpty(), 204);
        if($image>15){
            $conImages = true;
        }else{
            $conImages = false;
        }

        // if ($request->ajax()) {
        //     $view = view('User.gallery', compact('images'))->render();
        //     return response()->json(['html' => $view]);
        // }
        return view('User.home', compact('images', 'conImages'));
    }
}
