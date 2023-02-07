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
    public function follow($request){
        Foll::create([
            'following_id' => $request,
            'followed_id' =>\Auth::id(),
        ]);
        return back();
    }

    public function unfollow ($request){
        $foll=Foll::where('following_id', $request)->where('followed_id', \Auth::id())->first();
        $foll->delete();
        return back();
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
