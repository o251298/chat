<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsApiController extends Controller
{
    public function vue()
    {
        $posts = Post::query();
        $posts = $posts->orderBy('created_at', 'DESC');
        return PostResource::collection($posts->paginate(10))->response();
    }

    public function userFeed($id)
    {
        $current_user = User::find($id);
        $posts = Post::query();
        $posts = $posts->where('user_id', $current_user->id)->orderBy('created_at', 'DESC');
        return PostResource::collection($posts->paginate(10))->response();
    }

    public function more()
    {
        $posts = Post::query();
        return PostResource::collection($posts->get())->response();
    }

    public function index()
    {
        $current_user = Auth::user();
        $current_user['icon'] = 'http://localhost' . $current_user->getIcon();
        return view('v2.news', ['current_user' => json_encode($current_user)]);
    }


}
