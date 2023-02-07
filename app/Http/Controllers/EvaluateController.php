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
    public function good($request){
        Good::create([
            'comment_id' => $request,
            'user_id' =>\Auth::id(),
        ]);
        return back();
    }

    public function ungood ($request){
        $good=Good::where('comment_id', $request)->where('user_id', \Auth::id())->first();
        $good->delete();
        return back();
    }



    // truth settings
    public function truth($request){
        Truth::create([
            'article_id' => $request,
            'user_id' =>\Auth::id(),
        ]);
        return back();
    }

    public function untruth ($request){
        $good=Truth::where('article_id', $request)->where('user_id', \Auth::id())->first();
        $good->delete();
        return back();
    }


    // fake settings
    public function fake($request){
        Fake::create([
            'article_id' => $request,
            'user_id' =>\Auth::id(),
        ]);
        return redirect('/');
    }

    public function unfake ($request){
        $good=Fake::where('article_id', $request)->where('user_id', \Auth::id())->first();
        $good->delete();
        return back();
    }




}
