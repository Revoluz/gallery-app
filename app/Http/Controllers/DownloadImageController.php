<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadImageController extends Controller
{
    public function DownloadImage(Request $request, Gallery $id)
    {

        $file = Storage::path('public/' . $id->path);
        $newFileName = $id->name;

        return response()->download($file, $newFileName);
    }
}
