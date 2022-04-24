<?php

namespace App\Http\Controllers\v1;

use App\Events\NewComment;
use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Services\Other\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function save(Request $request)
    {
        $file = $request->file('image');
        $user = Auth::user();
        $post = Post::createPost($request, $user);
        Log::info($post);
        return response()->json($post);
    }

    public function comment(Request $request)
    {
        Log::info($request->all());
        NewComment::dispatch($request->all());
        $user = Auth::user();
        $comment = Comment::create([
            'user_id' => $user->id,
            'post_id' => $request->post_id,
            'text' => $request->text
        ]);
        return response()->json($comment);
    }

    public function mark($id)
    {
        $currentUser = Auth::user();
        $post = \App\Models\Post::find($id);
        if (!$post->checkMark($currentUser))
        {
            $post->like($currentUser);
        } else {
            $post->dislike($currentUser);
        }
        $count = $post->countLike();
        return response()->json($count);
    }
}
