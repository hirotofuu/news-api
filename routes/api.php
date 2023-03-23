<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FetchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EvaluateController;
use App\Http\Controllers\FollowController;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/














        Route::post('/register', [RegisterController::class, 'register']);
        Route::post('/user', [LoginController::class, 'user']);
        Route::post('/login', [LoginController::class, 'login']);
        Route::get('/userdayo/{password}', [LoginController::class, 'login_return']);
        Route::post('/logout', [LoginController::class, 'logout']);
        Route::group(['middleware' => ["auth:api"]], function () {
            Route::post('/editProfile', [LoginController::class, 'updateProfile']);
            Route::post('/editTextProfile', [LoginController::class, 'updateTextProfile']);
        });

        Route::group(['middleware' => ['auth:api']], function () {
            Route::post('/create', [ArticleController::class, 'createArticle']);
            Route::post('/editArticleText', [ArticleController::class, 'editArticle']);
            Route::post('/editArticlePic', [ArticleController::class, 'editArticlePic']);
            Route::delete('/deleteArticle/{id}', [ArticleController::class, 'deleteArticle']);
        });


        Route::get('/fetchMypageInfo/{id}', [FetchController::class, 'fetchMypageInfo']);
        Route::get('/titleFetch/{article}', [FetchController::class, 'titleArticle']);
        Route::get('/editTextFetch/{article}', [FetchController::class, 'editTextArticle']);
        Route::get('/editPicFetch/{article}', [FetchController::class, 'editPicArticle']);
        Route::get('/recommendFetch/{category}', [FetchController::class, 'fetchRecommend']);
        Route::get('/indexFetch', [FetchController::class, 'fetchIndex']);
        Route::get('/showFetch/{article}', [FetchController::class, 'showArticle']);
        Route::get('/categoryFetch/{category}', [FetchController::class, 'fetchCategory']);
        Route::get('/searchFetch/{search}', [FetchController::class, 'fetchSerch']);
        Route::get('/fetchUserArticle/{user_id}', [FetchController::class, 'fetchUserArticle']);
        Route::get('/fetchUserSearch/{name}', [FetchController::class, 'fetchUserSerch']);
        Route::get('/fetchUserInfo/{user_id}', [FetchController::class, 'fetchUserInfo']);
        Route::group(['middleware' => ['auth:api']], function () {
            Route::get('/fetchMyArticle/{user_id}', [FetchController::class, 'fetchMyArticle']);
        });
        Route::get('/fetchTimeline/{user_id}', [FetchController::class, 'timeline']);

        Route::group(['middleware' => ['auth:api']], function () {
            Route::post('/createComment', [CommentController::class, 'createComment']);
            Route::post('/replyComment', [CommentController::class, 'replyComment']);
            Route::delete('/deleteComment/{id}', [CommentController::class, 'deleteComment']);
        });
        Route::get('/fetchComments/{id}', [CommentController::class, 'fetchComments']);
        Route::get('/fetchReplyCommens/{parent_id}', [CommentController::class, 'fetchReplyComments']);
        Route::get('/fetchUserComments/{id}', [CommentController::class, 'fetchUserComments']);
        Route::group(['middleware' => ['auth:api']], function () {
            Route::get('/fetchMyComments/{user_id}', [CommentController::class, 'fetchMyComments']);
        });
        Route::group(['middleware' => ['auth:api']], function () {
            Route::post('/goodSend/{id}/{user_id}', [EvaluateController::class, 'good']);
            Route::delete('/unGoodSend/{id}/{user_id}', [EvaluateController::class, 'ungood']);
            Route::get('/truthSend/{id}/{user_id}', [EvaluateController::class, 'truth']);
            Route::delete('/unTruthSend/{id}/{user_id}', [EvaluateController::class, 'untruth']);
            Route::get('/fakeSend/{id}/{user_id}', [EvaluateController::class, 'fake']);
            Route::delete('/unFakeSend/{id}/{user_id}', [EvaluateController::class, 'unfake']);
            Route::get('/followSend/{id}/{followed_id}', [FollowController::class, 'follow']);
            Route::delete('/unFollowSend/{id}/{followed_id}', [FollowController::class, 'unfollow']);
        });

            Route::get('/following/{id}', [FollowController::class, 'followingFetch']);
            Route::get('/follower/{id}', [FollowController::class, 'followerFetch']);

