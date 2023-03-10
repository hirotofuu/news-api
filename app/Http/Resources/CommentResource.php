<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Good;
use App\Http\Resources\GoodResource;
class CommentResource extends JsonResource
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
            'parent_id'=>$this->parent_id,
            'comment'=>$this->comment,
            'user_id'=>$this->user_id,
            'day_time'=>$this->day_time,
            'user_name'=>$this->user->name,
            'child_number'=>$this->child_number,
            'avatar_image'=>$this->user->avatar_image,
            'article_id'=>$this->article_id,
            'is_good'=>GoodResource::collection($this->goods),
            'good_number'=>$this->goods->count(),
        ];
    }
}
