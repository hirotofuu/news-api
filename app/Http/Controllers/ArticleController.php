<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function createArticle(CreateRequest $request){
        if($request->file('file')!==null){
            $file= $request->file('file');
            $file_name=$file->getClientOriginalName();
            Article::create([
                'title' => $request->title,
                'content' => $request->content,
                'category' => $request->category,
                'comments_open' => $request->comments_open,
                'day_time' => $request->day_time,
                'image_file'=>$file_name,
                'user_id'=> \Auth::id(),
                'secret_id'=>\Auth::user()->secret_id,
            ]);
        }else{
            Article::create([
                'title' => $request->title,
                'content' => $request->content,
                'category' => $request->category,
                'comments_open' => $request->comments_open,
                'day_time' => $request->day_time,
                'user_id'=> \Auth::id(),
                'secret_id'=>\Auth::user()->secret_id,
            ]);
        }
    }

    public function deleteArticle ($request){
        $comment=Article::where('id', $request);
        $comment->delete();
        return back();
    }

    public function editArticlePict ($request){
        if($request->file('file')!==null){
            $file= $request->file('file');
            $file_name=$file->getClientOriginalName();

            Article::where('id', $request)
            ->update([
                'image_file' => $file_name,
            ]);
        }else{
            Article::where('id', $request)
            ->update([
                'image_file' => null,
            ]);
        }

    }


    public function editArticle (Request $request){

        Article::where('id', $request->id)
        ->update([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'comments_open' => $request->comments_open,
        ]);

    }

    public function editArticlePic (Request $request){
        if($request->file('file')!==null){
            $file= $request->file('file');
            $file_name=$file->getClientOriginalName();
            Article::where('id', $request->id)
            ->update([
                'image_file'=>$file_name,
            ]);
        }else{
            Article::where('id', $request->id)
            ->update([
                'image_file'=>null,
            ]);
        }
    }
}
