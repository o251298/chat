<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Redis;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function picture()
    {
        return $this->hasOne(Picture::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function like(User $user)
    {
        $key1 = "post:{$this->id}:likes";
        $key2 = "user:{$user->id}:likes";
        Redis::sadd($key1, $user->id);
        Redis::sadd($key2, $this->id);
    }

    public function dislike(User $user)
    {
        $key1 = "post:{$this->id}:likes";
        $key2 = "user:{$user->id}:likes";
        Redis::srem($key1, $user->id);
        Redis::srem($key2, $this->id);
    }

    public function checkMark(User $user)
    {
        $id = $user->id;
        $key = "post:{$this->id}:likes";
        if (Redis::sismember($key, $id)){
            return true;
        } else {
            return false;
        }
    }

    public function countLike()
    {
        $key = "post:{$this->id}:likes";
        $count = Redis::scard($key);
        return $count;
    }

}
