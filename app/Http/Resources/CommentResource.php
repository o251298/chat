<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public $i = 0;
    public function toArray($request)
    {
        $data = $this->resource;
        $comment = [];

        foreach ($data as $item)
        {
            $user = $item->user()->first();
            $user['icon'] = 'http://localhost' .  $item->user()->first()->getIcon();
            $comment[$item->id] = [
              'id' => $item->id,
              'text' => $item->text,
              'user_create' => $user,
            ];
        }
        return $comment;
    }
}
//'icon' => 'http://localhost' . $this->getIcon()
