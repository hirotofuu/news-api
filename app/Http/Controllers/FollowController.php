<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foll;
use App\Models\User;
use App\Http\Resources\FollowerResource;
use App\Http\Resources\FollowingResource;
use App\Http\Resources\UserResource;

class FollowController extends Controller
{
    public function follow(Request $request){
        Foll::create([
            'following_id' => $request->id,
            'followed_id' => $request->followed_id,
        ]);
    }

    public function unfollow (Request $request){
        $foll=Foll::where('following_id', $request->id)->where('followed_id', $request->followed_id)->first();
        $foll->delete();
    }

    public function followingFetch($request){
        $following=User::with('followings')->find($request);
        return new FollowingResource($following);
    }

    public function followerFetch($request){
        $following=User::with('followers')->find($request);
        return new FollowerResource($following);
    }
}
