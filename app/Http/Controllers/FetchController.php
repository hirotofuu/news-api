<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Foll;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\IndexArticleResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;


class FetchController extends Controller
{
    // 最初の記事取得
    public function fetchIndex(){
        try{
            $article=Article::with('user')->orderBy('id', 'DESC')->take(200)->get();
        }catch(Exception $e){
            throw $e;
        }
        return IndexArticleResource::collection($article);
    }


    // カテゴリーごと記事取得
    public function fetchCategory($request){
        try{
            $article=Article::with('user')->orderBy('id', 'DESC')->where('category', $request)->take(200)->get();
        }catch(Exception $e){
            throw $e;
        }
        return IndexArticleResource::collection($article);
    }


    // ユーザーごとの記事取得
    public function fetchUserArticle($request){
        try{
            $article=Article::with('user')->orderBy('id', 'DESC')->where('user_id', $request)->take(200)->get();
        }catch(Exception $e){
            throw $e;
        }
        return IndexArticleResource::collection($article);
    }

    // mypageの記事
    public function fetchMyArticle($request){
        try{
            $article=Article::with('user')->orderBy('id', 'DESC')->where('user_id', $request)->get();
        }catch(Exception $e){
            throw $e;
        }
        return IndexArticleResource::collection($article);
    }


    // 検索記事取得
    public function fetchSerch($request){
        try{
            $query = Article::query();
            if (isset($request)) {
                $array_words = preg_split('/\s+/ui', $request, -1, PREG_SPLIT_NO_EMPTY);
                foreach ($array_words as $w) {
                    $escape_word = addcslashes($w, '\\_%');
                    $query = $query->where(DB::raw("CONCAT(title, ' ', content)"), 'like', '%' . $escape_word . '%');//like検索
                }
            }
            $articles = $query->get();
        }catch(Exception $e){
            throw $e;
        }
        return IndexArticleResource::collection($articles);
    }


    // ユーザー検索取得
    public function fetchUserSerch($request){
        try{
            $user=User::where('name', 'LIKE',"%{$request}%")->orderBy('id', 'DESC')->take(200)->get();
        }catch(Exception $e){
            throw $e;
        }
        return UserResource::collection($user);
    }


    // timeline
    public function timeline($request) {
        try{
            $article=Article::with('user')->whereIn('user_id', Foll::where('followed_id', $request)->pluck('following_id'))->get();
        }catch(Exception $e){
            throw $e;
        }
        return IndexArticleResource::collection($article);
    }




    // 詳細取得
    public function showArticle($article){
        $syosai=Article::with('truths')->with('fakes')->find($article);
        return new IndexArticleResource($syosai);
    }




    // ユーザー情報取得
    public function fetchUserInfo($request) {
        $user=User::with('followings')->with('truths')->with('fakes')->find($request);
        return  new UserResource($user);
    }

    public function fetchMypageInfo($request) {
        $user=User::with('followings')->with('truths')->with('fakes')->find($request);
        return  new UserResource($user);
    }




}
