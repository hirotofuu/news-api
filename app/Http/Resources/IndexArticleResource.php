<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\GoodResource;

class IndexArticleResource extends JsonResource
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
            'content'=>$this->content,
            'day_time'=>$this->day_time,
            'view_number'=>$this->view_number,
            'image_file'=>$this->image_file,
            'user_id'=>$this->user_id,
            'user_name'=>$this->user->name,
            'category'=>$this->category,
            'is_truth'=>GoodResource::collection($this->truths),
            'is_fake'=>GoodResource::collection($this->fakes),
            'truth_number'=>$this->truths->count(),
            'fake_number'=>$this->fakes->count(),
        ];
    }
}
