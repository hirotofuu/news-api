<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\ImageSizeRequest;
use App\Http\Requests\EditTextRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function createArticle(CreateRequest $request){
        if($request->file('file')!==null){
            $file= $request->file('file');
            $file_name = Storage::disk('s3')->putFile('article', $file, 'public');
            Article::create([
                'title' => $request->title,
                'content' => $request->content,
                'source' => $request->source,
                'category' => $request->category,
                'comments_open' => $request->comments_open,
                'day_time' => $request->day_time,
                'image_file'=>$file_name,
                'user_id'=> $request->user_id,
            ]);
        }else{
            Article::create([
                'title' => $request->title,
                'content' => $request->content,
                'source' => $request->source,
                'category' => $request->category,
                'comments_open' => $request->comments_open,
                'day_time' => $request->day_time,
                'user_id'=> $request->user_id,
            ]);
        }
    }

    public function deleteArticle ($request){
        $article=Article::where('id', $request)->first();
        if($article->image_file!==null){
            Storage::disk('s3')->delete($article->image_file);
        }
        $article->delete();
        return back();
    }



    public function editArticle (EditTextRequest $request){

        Article::where('id', $request->id)
        ->update([
            'title' => $request->title,
            'content' => $request->content,
            'source' => $request->source,
            'category' => $request->category,
            'comments_open' => $request->comments_open,
        ]);

    }

    public function editArticlePic (ImageSizeRequest $request){
        $article=Article::where('id', $request->id)->first();
        if($article->iamge_file===$request->file('file')){
            return;
        }
        if($article->iamge_file===null){
            if($request->file('file')===null){
                $article->update([
                    'image_file'=>null,
                ]);
                return;
            }
            $file= $request->file('file');
            $file_name = Storage::disk('s3')->putFile('article', $file, 'public');
            $article->update([
                'image_file'=>$file_name,
            ]);
            return;
        }
        if($request->file('file')!==null){
            Storage::disk('s3')->delete($article->image_file);
            $file= $request->file('file');
            $file_name = Storage::disk('s3')->putFile('article', $file, 'public');
            $article->update([
                'image_file'=>$file_name,
            ]);
        }else if($request->file('file')===null){
            Storage::disk('s3')->delete($article->image_file);
            $article->update([
                'image_file'=>null,
            ]);
        }
    }
}
