<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\FolloweIdResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'secret_id'=>$this->secret_id,
            'name'=>$this->name,
            'api_token'=>$this->api_token,
            'avatar_image'=>$this->avatar_image,
            'profile'=>$this->profile,
            'truth_number'=>$this->truths->count(),
            'fake_number'=>$this->fakes->count(),
            'following'=>FolloweIdResource::collection($this->followers),
            'following_number'=>$this->followings->count(),
            'follower_number'=>$this->followers->count(),
        ];
    }
}
