<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Other\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function index()
    {
        $test = new Business();
        $test->readNote();
        $users = User::where('id', '!=', Auth::id());
        return view('v1.main.people', ['users' => $users->simplePaginate(4)]);
    }

    public function friend()
    {
        $curr = Auth::user();
        $friends = $curr->getSubscribers();
        return view('v1.main.friend', ['users' => $friends]);
    }

    public function subscribe($id)
    {
        $currentUser = Auth::user();
        $friend = User::findOrFail($id);
        $currentUser->friendId = $friend->id;
        if (!$currentUser->checkSubscriber())
        {
            $currentUser->subscribe($friend);
        } else {
            return response()->json(['error' => 'already following']);
        }
        return response()->json(['success' => 'subscribe']);
    }

    public function unsubscribe($id)
    {
        $currentUser = Auth::user();
        $friend = User::findOrFail($id);
        $currentUser->friendId = $friend->id;

        if ($currentUser->checkSubscriber())
        {
            $currentUser->describe($friend);
        } else {
            return response()->json(['error' => 'already describe']);
        }
        return response()->json(['success' => 'describe']);
    }

}
