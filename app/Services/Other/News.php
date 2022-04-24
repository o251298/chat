<?php


namespace App\Services\Other;


use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class News
{
    public $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function getNewsUsers(User $user)
    {
        $posts = Post::query();
        $subscribers = $user->getSubscribers();
        $friends = $subscribers->toArray();
        $idFriends = null;
        foreach ($friends as $item)
        {
            $idFriends[] = $item['id'];
        }
        $idFriends[] = Auth::id();
        $posts = $posts->whereIn('user_id', $idFriends);
        $posts->orderBy('created_at', 'DESC');
        return $posts;
    }
}
