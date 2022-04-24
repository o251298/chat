<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::id());
        return view('home', ['users' => $users->get()]);
    }

    public function searchUser($search)
    {
        $search = (string) trim($search);
        $users = User::where('name', 'LIKE', '%' . $search . '%')->get();
        return UserResource::collection($users);
    }

    public function getFriends()
    {
        $current_user = Auth::user();
        $subs = $current_user->getSubscribers();
        $i = 0;
        $arr[$i] = $current_user->id;
        $i++;
        foreach ($subs as $item)
        {
            if (User::isFriend($item->id))
            {
                $arr[$i] = $item->id;
                $i++;
            }
        }
        $users = User::find($arr);
        return UserResource::collection($users);
    }

}
