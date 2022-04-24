<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Icon;
use App\Models\Message;
use App\Models\User;
use App\Services\DB\dbConnect;
use App\Services\Other\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageRed;

class MessageController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::id());
        $r = Auth::user();
        $users = $r->getSubscribers();
        return view('v1.main.chat', ['users' => $users, 'currentUser' => Auth::user()]);
    }

    public function room(User $user)
    {
        $users = User::where('id', '!=', Auth::id());
        $friend = $user;
        $currentUser = User::find(Auth::id());
        $r = Auth::user();
        $users = $r->getSubscribers();

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
            $format = explode('/', $row['file']);
            if (isset($format[3]))
            {
                $format = $format[3];
                if ($format == 'img')
                {
                    $format = 'image';
                }
            } else {
                $format = null;
            }
            if ($row['post_id'] !== null)
            {
                $post = \App\Models\Post::find($row['post_id']);
                $user = User::find($post->user_id);
                $imagePost = $post->picture()->first();
                $post = $post->toArray();
                if ($imagePost)
                {
                    $post["picture"] = $imagePost->url;
                    $post["icon"] = $user->getIcon();
                    $post["user"] = $user->name;
                    $post["type"] = $imagePost->type;
                }
            } else {
                $post = null;
            }
            $res[$i]['id'] = $row['id'];
            $res[$i]['text'] = json_decode($row['text']);
            $res[$i]['sender_id'] = $row['sender_id'];
            $res[$i]['receiver_id'] = $row['receiver_id'];
            $res[$i]['created_at'] = $row['created_at'];
            $res[$i]['file'] = $row['file'];
            $res[$i]['format'] = $format;
            $res[$i]['post'] = $post;
            $i++;
        }
        $messages = $res;
        return view('v1.main.room', ['friend' => $friend, 'currentUser' => $currentUser, 'messages' => $messages, 'users' => $users]);
    }

    public function read(Request $request)
    {
        $messages = Message::query();
        $messages = $messages->where('receiver_id', $request->sender_id)->where('sender_id', $request->receiver_id)->where('status', 0)->get();
        foreach ($messages as $item)
        {
            $item->status = 1;
            $item->save();
        }
        return response()->json($request->all());
    }

    public function countMessage()
    {
        $messages = \App\Models\Message::query();
        $messages = $messages->where('receiver_id', \Illuminate\Support\Facades\Auth::id())->where('status', 0);
        $messages = $messages->get();
        return response()->json(count($messages));
    }

    public function createImage(Request $request)
    {
        Log::info($request->file('image'));
        //Log::info($request->image);
        $res = [];
        if (!$request->file('image'))
        {
            $res["error"] = "Файл не найден или неправильный формат файла";
            return response()->json($res);
        }
        $file = $request->file('image');
        $type = $file->extension();



        $format = Post::validate($type);
        $filename = $file->getClientOriginalName(); // image.jpg

        $saveFolder = '';
        $pathFolder = '';

        switch ($format)
        {
            case 'image':
              $saveFolder = 'public/folder/img';
              $pathFolder = '/storage/folder/img/';
              break;
            case 'video':
             $saveFolder = 'public/folder/video';
             $pathFolder = '/storage/folder/video/';
             break;
            case 'audio':
            $saveFolder = 'public/folder/audio';
            $pathFolder = '/storage/folder/audio/';
            break;
            case 'error':
                $res["error"] = "Файл не найден или неправильный формат файла";
                return response()->json($res);
        }

        Storage::putFileAs($saveFolder, $file, $filename);
        $res["success"] = [
            'path' => $pathFolder . $filename,
            'format' => $format,
        ];
        return response()->json($res);
    }

    public function deleteChat(Request $request)
    {
        $res = [];
        // if select user isset in friends list
        $selectUser = User::find($request->friend);
        if (!$selectUser->checkSubscribers())
        {
            $res["error"] = "This is not your friend";
            return response()->json($res);
        }
        $currentUser = Auth::user();
        $db = dbConnect::getConnection();

        // delete files

//        $sql = "SELECT * FROM messages
//WHERE sender_id = {$currentUser->id} AND receiver_id = {$selectUser->id} AND file IS NOT NULL
//UNION
//SELECT * FROM messages
//WHERE sender_id =  {$selectUser->id} AND receiver_id = {$currentUser->id} AND file IS NOT NULL
//ORDER BY created_at ASC";
//
//        $statement = $db->query($sql);
//        //$res[] = ->fetchAll(\PDO::FETCH_ASSOC);
//        $files = [];
//        $i = 0;
//        while ($row = $statement->fetch())
//        {
//            $files[$i] = $row['file'];
//            $i++;
//        }
        // delete chat
        $sql = "DELETE FROM messages
 WHERE sender_id = {$currentUser->id} AND receiver_id = {$selectUser->id}";
        $statement = $db->query($sql);
        $sql = "DELETE FROM messages
 WHERE sender_id =  {$selectUser->id} AND receiver_id = {$currentUser->id}";
        $statement = $db->query($sql);
        $res["success"] = 'messages is deleted';
        return response()->json($res);
    }


}
