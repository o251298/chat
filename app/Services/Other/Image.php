<?php


namespace App\Services\Other;


use App\Models\Icon;
use App\Models\Picture;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageRed;
use Illuminate\Http\Request;

class Image
{
    public $request;
    public $user;
    public $folder;
    public $folderInDatabase;
    public $post;

    public function __construct(Request $request, User $user)
    {
        $this->request = $request;
        $this->user = $user;
    }

    public function uploadUserImage()
    {
        $file = $this->request->file('icon');
        $filename = $file->getClientOriginalName(); // image.jpg
        $filename =  $this->user->id . '_' . $filename;
        $file_resize = ImageRed::make($file->getRealPath());
        $file_resize->resize(200, 200);
        $file_resize->save($this->folder . $filename);
        $this->user->icon()->delete();
        $icon = Icon::create([
            'user_id' => $this->user->id,
            'url' => '/' . $this->folder . $filename
        ]);
        if (!$icon)
        {
            return false;
        }
        return true;
        // log
    }

    public function uploadPostImage()
    {
        $file = $this->request->file('image');
        $filename = $file->getClientOriginalName(); // image.jpg
        Storage::putFileAs($this->folder, $file, $filename);
        $type = $file->extension();
        $picture = Picture::create([
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
            'url' => $this->folderInDatabase . $filename,
            'type' => self::getType(Post::validate($type))
        ]);

        return $picture;
    }

    public static function getType($type)
    {
        switch ($type){
            case ('image'):
                return 0;
                break;
            case ('audio'):
                return 2;
                break;
            case ('video'):
                return 1;
                break;
        }
    }

}
