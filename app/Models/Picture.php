<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Picture extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function getType()
    {
        if ($this->type == 0){
            return 'image';
        } elseif ($this->type == 1){
            return 'video';
        } elseif ($this->type == 2){
            return 'audio';
        }
    }
}
