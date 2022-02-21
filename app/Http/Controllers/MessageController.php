<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Services\DB\dbConnect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(User $user)
    {
        $friend = $user;
        $currentUser = User::find(Auth::id());

        $db = dbConnect::getConnection();
        $sql = "SELECT * FROM messages
WHERE sender_id = {$currentUser->id} AND receiver_id = {$friend->id}
UNION
SELECT * FROM messages
WHERE sender_id =  {$friend->id} AND receiver_id = {$currentUser->id}
ORDER BY created_at ASC";

        $query = $db->query($sql);
        $res = array();
        $i = 0;
        while ($row = $query->fetch()){
            $res[$i]['id'] = $row['id'];
            $res[$i]['text'] = $row['text'];
            $res[$i]['sender_id'] = $row['sender_id'];
            $res[$i]['receiver_id'] = $row['receiver_id'];
            $res[$i]['created_at'] = $row['created_at'];
            $i++;
        }

        $messages = $res;
        return view('room', ['friend' => $friend, 'currentUser' => $currentUser, 'messages' => $messages]);
    }
}
