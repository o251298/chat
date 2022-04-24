<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'fname',
        'lname',
        'number',
    ];
    public $friendId;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    public function getIconName()
//    {
//
//    }

    public function icon()
    {
        return $this->hasOne(Icon::class);
    }

    public function getIcon()
    {
        if ($this->icon()->first() === null){
            return '/storage/folder/defaultM.png';
        } else {
            $icon = $this->icon()->first()['url'];
            return $icon;
        }
    }

    public function post()
    {
        return $this->hasOne(Post::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function countPost()
    {
        return $this->posts()->count();
    }

    public function subscribe($user)
    {
        $key1 = "user:{$this->id}:subscribers";
        $key2 = "user:{$user->id}:followers";
        Redis::sadd($key1, $user->id);
        Redis::sadd($key2, $this->id);
    }

    public function describe($user)
    {
        $key1 = "user:{$this->id}:subscribers";
        $key2 = "user:{$user->id}:followers";
        Redis::srem($key1, $user->id);
        Redis::srem($key2, $this->id);
    }

    public function getSubscribers()
    {
        $key = "user:{$this->id}:subscribers";
        $subscribers = Redis::smembers($key);
        $subscribers = self::find($subscribers);
        return $subscribers;
    }

    public function getFollowers()
    {
        $key = "user:{$this->id}:followers";
        $followers = Redis::smembers($key);
        $followers = self::find($followers);
        return $followers;
    }

    public function checkSubscribers()
    {
        $currentUser = Auth::id();
        $key = "user:{$currentUser}:subscribers";
        if (Redis::sismember($key, $this->id)){
            return true;
        } else {
            return false;
        }
    }
    public function checkSubscriber()
    {
        $currentUser = Auth::id();
        $key = "user:{$currentUser}:subscribers";
        if (Redis::sismember($key, $this->friendId)){
            return true;
        } else {
            return false;
        }
    }

    public function countSubscribers()
    {
        $key = "user:{$this->id}:subscribers";
        $subscribers = Redis::smembers($key);
        return count($subscribers);
    }

    public function countFollowers()
    {
        $key = "user:{$this->id}:followers";
        $followers = Redis::smembers($key);
        return count($followers);
    }

    public function editProfile(Request $request)
    {
        $file = $request->file('icon');
        $data = $request->all();
        array_shift($data);
        if ($file)
        {
            $data = array_reverse($data);
            array_shift($data);
        }
        foreach ($data as $key => $val)
        {
            if ($val){
                $this->{$key} = $val;
                $this->save();
            }
        }
        return true;
    }

    public static function isFriend($id)
    {
        /*
         * Есть два списка
         * 1) Подписки текущего пользователя
         * 2) Подписки искомого друга
         *
         * Если в обеих списках есть елемент друга - то они друзья
         */
        $currentUserId = Auth::id();
        $guestId = $id;
        $subscribersForCurrentUser = "user:{$currentUserId}:subscribers";
        $subscribersForGuest = "user:{$guestId}:subscribers";
        if (Redis::sismember($subscribersForCurrentUser, $guestId) && Redis::sismember($subscribersForGuest, $currentUserId))
        {
            return true;
        } else {
            return false;
        }
    }


}
