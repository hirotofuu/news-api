<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleCoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'day_time'=>$this->day_time,
            'view_number'=>$this->view_number,
            'image_file'=>$this->image_file,
            'user_name'=>$this->user->name,
            'avatar_image'=>$this->user->avatar_image,
        ];
    }
}
