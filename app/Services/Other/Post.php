<?php


namespace App\Services\Other;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Post as PostModel;

class Post
{
    public $post;
    public $request;
    public $picture;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public static function createPost (Request $request, User $user)
    {
        $file = $request->file('image');
        Log::info($file);
        //dd(1);

        // if message->text empty -> null
        // if image type -> img: img, video: video, audio: audio
        $text = $request->message;
        $post = PostModel::create([
            'user_id' => $user->id,
            'text' => ($text) ? $text : 'text message'
        ]);
        if ($file){
            $type = $file->extension();

            if (self::validate($type) == 'image')
            {
                $photo = new Image($request, $user);
                $photo->folder = 'public/folder/img';
                //$photo->folder = 'public/folder';
                $photo->post = $post;
                //$photo->folderInDatabase = '/storage/folder/';
                $photo->folderInDatabase = '/storage/folder/img/';
                $picture = $photo->uploadPostImage();
            } elseif (self::validate($type) == 'video')
            {
                $photo = new Image($request, $user);
                $photo->folder = 'public/folder/video';
                //$photo->folder = 'public/folder';
                $photo->post = $post;
                //$photo->folderInDatabase = '/storage/folder/';
                $photo->folderInDatabase = '/storage/folder/video/';
                $picture = $photo->uploadPostImage();
            } elseif (self::validate($type) == 'audio')
            {
                $photo = new Image($request, $user);
                $photo->folder = 'public/folder/audio';
                //$photo->folder = 'public/folder';
                $photo->post = $post;
                //$photo->folderInDatabase = '/storage/folder/';
                $photo->folderInDatabase = '/storage/folder/audio/';
                $picture = $photo->uploadPostImage();
            } else{
                return false;
            }

        }
        Log::info($request);
        $post['user']['name'] = $user->name;
        $post['user']['icon'] = $user->getIcon();
        if ($file){
            $post['picture'] = $picture->url;
            $post['file_type'] = $picture->type;
        }
        return $post;
    }

    public static function validate($format)
    {
        $video = [
            'mp4',
            'avi',
            '3gp'
        ];
        $audio = [
            'mp3'
        ];
        $img = [
            'png',
            'jpeg',
            'jpg'
        ];
        switch ($format){
            case (in_array($format, $video)):
                return 'video';
                break;
            case (in_array($format, $audio)):
                return 'audio';
                break;
            case (in_array($format, $img)):
                return 'image';
                break;
            default:
                return 'error';
        }
    }
}
