<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Exception;
use App\Models\Comment;
use App\Models\Good;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentUserResource;

class CommentController extends Controller
{
    public function fetchComments($request){
        try{
            $comment=Comment::with('user')->with('goods')->with('article')->orderBy('id', 'DESC')->where('article_id', $request)->where('parent_id', null)->get();

        }catch(Exception $e){
            throw $e;
        }
        return CommentResource::collection($comment);
    }



    public function fetchUserComments($request){
        try{
            $comment=Comment::with('user')->with('goods')->with('article')->orderBy('id', 'DESC')->where('user_id', $request)->take(200)->get();
        }catch(Exception $e){
            throw $e;
        }
        return CommentUserResource::collection($comment);
    }

    public function fetchMyComments($request){
        try{
            $comment=Comment::with('user')->with('goods')->with('article')->orderBy('id', 'DESC')->where('user_id', $request)->get();
        }catch(Exception $e){
            throw $e;
        }
        return CommentUserResource::collection($comment);
    }


    public function createComment(Request $request){
        $comment=new Comment();
        $model=$comment->create([
                'comment' => $request->comment,
                'day_time' => $request->day_time,
                'user_id'=> \Auth::id(),
                'article_id'=>$request->article_id,
            ]);
            return ($model->id);
    }

    public function replyComment(Request $request){
        $comment=new Comment();
        $model=$comment->create([
                'comment' => $request->comment,
                'day_time' => $request->day_time,
                'user_id'=> \Auth::id(),
                'article_id'=>$request->article_id,
                'parent_id'=> $request->parent_id,
            ]);
        $parent_comment=Comment::where('id', $request->parent_id)->first();
        $num=$parent_comment->child_number;
        $parent_comment->update([
            'child_number' => $num+1,
        ]);
    }

    public function fetchReplyComments($request){
        try{
            $comment=Comment::with('user')->with('goods')->with('article')->orderBy('id', 'DESC')->where('parent_id', $request)->get();
        }catch(Exception $e){
            throw $e;
        }
        return CommentResource::collection($comment);
    }

    public function deleteComment ($request){
        $comment=Comment::where('id', $request);
        $comment->delete();
        return back();
    }
}
