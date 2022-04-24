<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    /*
     * $date = substr($str, 0, strpos($str, 'T'));
        $time = substr($str, strpos($str, 'T') + 1, 5);
     */
    public function toArray($request)
    {
        return [

            'post' => [
                'id' => $this->id,
                'text' => $this->text,
                'created_at' =>  substr($this->created_at, 0),
                'likes' => $this->countLike(),
                'file' => new PictureResource($this->picture),
            ],
            'created_by' => new UserResource($this->user),
            'comments' => new CommentResource($this->comments),
        ];
    }
}
