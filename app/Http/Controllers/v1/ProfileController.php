<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Services\Other\Image;
use App\Models\User;
use App\Services\Other\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ProfileController extends Controller
{
    public function profile($id)
    {
        $current_user = Auth::user();
        $current_user['icon'] = 'http://localhost' . $current_user->getIcon();
        $user = User::findOrFail($id);
        $posts = $user->posts();
        return view('v1.main.profile', ['user' => $user, 'posts' => $posts->simplePaginate(10), 'current_user' => json_encode($current_user), 'url_request' => json_encode(['url' => "/news/user"])]);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('v1.main.edit', ['user' => $user]);
    }

    public function change(Request $request)
    {
        $user = Auth::user();
        $file = $request->file('icon');
        if ($file !== null){
            $photo = new Image($request, $user);
            $photo->folder = 'storage/folder/';
            if (!$photo->uploadUserImage())
            {
                Log::alert('error upload photo');
                return redirect()->back()->with('error', 'error upload photo');
            }
        }
        $user->editProfile($request);
        return redirect()->back();
    }

    public function news()
    {
//
//        $currentUser = Auth::user();
//        $posts = News::getNewsUsers($currentUser);
//        return view('v1.main.news', ['currentUser' => $currentUser, 'posts' => $posts->simplePaginate(15)]);
        $current_user = Auth::user();
        $current_user['icon'] = 'http://localhost' . $current_user->getIcon();
        return view('v2.news', ['current_user' => json_encode($current_user), 'user' => json_encode($current_user), 'url_request' => json_encode(['url' => "/news/vue"])]);
    }

}
