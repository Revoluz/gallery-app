<?php

namespace App\Http\Controllers;

use App\Models\Comment_Log;
use App\Models\Gallery;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Gallery $image)
    {
        $validated = $request->validate([
            'comment' => 'required'
        ]);
        $user = auth()->user();
        $validated['user_id'] =  $user->id;
        $validated['gallery_id'] =  $image->id;
        Comment_Log::create($validated);

        return redirect()->back();
    }
    public function destroy(Comment_Log $comment)
    {
        $this->authorize('auth.guard', $comment->user);

        $comment->delete();
        return redirect()->back();
    }
}
