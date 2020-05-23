<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['domain' => config('project.api_domain'), 'namespace' => 'Api', 'as' => 'api.'
], function(){
    // 인증 관련 라우트
    Route::group(['prefix' => 'v1', 'namespace' => 'v1', 'as' => 'v1.'], function() {
       // 리스스 관련 라우트

        /** 환영 메세지 */
        Route::get('/', [
           'as' => 'index',
           'uses' => 'WelcomeController@index',
        ]);

        /** 포럼 API */
        Route::resource('articles', 'ArticlesController');
        Route::get('tags/{slug}/articles', [
            'as' => 'tags.articles.index',
            'uses' => 'ArticlesController@index'
        ]);
        Route::get('tags', [
            'as' => 'tags.index',
            'uses' => 'ArticlesController@tags',
        ]);
        Route::resource('attachments', 'AttachmentsController', [
            'only' => ['store', 'destroy']
        ]);
        Route::resource('articles.attachments', 'AttachmentsController', [
            'only' => ['index']
        ]);
        Route::resource('comments', 'CommentsController', [
            'only' => ['show', 'update', 'destroy']
        ]);
        Route::resource('articles.comments', 'CommentsContrller', [
            'only' => ['index', 'store']
        ]);
        Route::post('comments/{comment}/vote', [
           'as' => 'comments.vote',
           'uses' => 'CommentController@vote'
        ]);
    });
});