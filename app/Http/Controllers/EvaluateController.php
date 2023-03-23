<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Good;
use App\Models\Truth;
use App\Models\Fake;

class EvaluateController extends Controller
{
    // good setting
    public function good(Request $request){
        Good::create([
            'comment_id' => $request->id,
            'user_id' =>$request->user_id,
        ]);

    }

    public function ungood (Request $request){
        $good=Good::where('comment_id', $request->id)->where('user_id', $request->user_id)->first();
        $good->delete();

    }



    // truth settings
    public function truth(Request $request){
        Truth::create([
            'article_id' => $request->id,
            'user_id' =>$request->user_id,
        ]);

    }

    public function untruth (Request $request){
        $good=Truth::where('article_id', $request->id)->where('user_id', $request->user_id)->first();
        $good->delete();

    }


    // fake settings
    public function fake(Request $request){
        Fake::create([
            'article_id' => $request->id,
            'user_id' =>$request->user_id,
        ]);

    }

    public function unfake (Request $request){
        $good=Fake::where('article_id', $request->id)->where('user_id', $request->user_id)->first();
        $good->delete();

    }




}
