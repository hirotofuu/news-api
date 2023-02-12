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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/user', function() {
    $user = Auth::user();
    return $user ? new UserResource($user) : null;
});




Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/create', [ArticleController::class, 'createArticle']);
    Route::post('/editArticleText', [ArticleController::class, 'editArticle']);
    Route::post('/editArticlePic', [ArticleController::class, 'editArticlePic']);
    Route::delete('/deleteArticle/{id}', [ArticleController::class, 'deleteArticle']);
});


Route::get('/indexFetch', [FetchController::class, 'fetchIndex']);
Route::get('/showFetch/{article}', [FetchController::class, 'showArticle']);
Route::get('/categoryFetch/{category}', [FetchController::class, 'fetchCategory']);
Route::get('/searchFetch/{search}', [FetchController::class, 'fetchSerch']);
Route::get('/fetchUserArticle/{user_id}', [FetchController::class, 'fetchUserArticle']);
Route::get('/fetchUserSearch/{name}', [FetchController::class, 'fetchUserSerch']);
Route::get('/fetchUserInfo/{user_id}', [FetchController::class, 'fetchUserInfo']);
Route::get('/fetchMypageInfo/{id}', [FetchController::class, 'fetchMypageInfo']);
Route::get('/fetchMyArticle/{user_id}', [FetchController::class, 'fetchMyArticle']);
Route::get('/fetchTimeline/{user_id}', [FetchController::class, 'timeline']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/createComment', [CommentController::class, 'createComment']);
    Route::delete('/deleteComment/{id}', [CommentController::class, 'deleteComment']);
});
Route::get('/fetchComments/{id}', [CommentController::class, 'fetchComments']);
Route::get('/fetchUserComments/{id}', [CommentController::class, 'fetchUserComments']);
Route::get('/fetchMyComments', [CommentController::class, 'fetchMyComments']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/goodSend/{id}', [EvaluateController::class, 'good']);
    Route::delete('/unGoodSend/{id}', [EvaluateController::class, 'ungood']);
    Route::get('/truthSend/{id}', [EvaluateController::class, 'truth']);
    Route::delete('/unTruthSend/{id}', [EvaluateController::class, 'untruth']);
    Route::get('/fakeSend/{id}', [EvaluateController::class, 'fake']);
    Route::delete('/unFakeSend/{id}', [EvaluateController::class, 'unfake']);


    Route::get('/followSend/{id}', [FollowController::class, 'follow']);
    Route::delete('/unFollowSend/{id}', [FollowController::class, 'unfollow']);
});

    Route::get('/following/{id}', [FollowController::class, 'followingFetch']);
    Route::get('/follower/{id}', [FollowController::class, 'followerFetch']);
