<?php

/* 메인 */
Route::get('/', [
    'as' => 'home',
    'uses' => 'WelcomeController@index'
]);

/* 사용자가입*/
Route::get('auth/register', [
    'as' => 'users.create',
    'uses' => 'UsersController@create'
]);

Route::post('auth/register', [
    'as' => 'users.store',
    'uses' => 'UsersController@store'
]);

Route::get('auth/confirm/{code}', [
    'as' => 'users.confirm',
    'uses' => 'UsersController@confirm'
]);

/* 사용자 인증 */
Route::get('auth/login', [
    'as' => 'sessions.create',
    'uses' => 'SessionsController@create'
]);

Route::post('auth/login', [
    'as' => 'sessions.store',
    'uses' => 'SessionsController@store'
]);

Route::get('auth/logout', [
   'as' => 'sessions.destory',
   'uses' => 'SessionsController@destory'
]);

/* 비밀번호 초기화 */
Route::get('auth/remind', [
    'as' => 'remind.create',
    'uses' => 'PasswordsController@getRemind'
]);

Route::post('auth/remind', [
    'as' => 'remind.store',
    'uses' => 'PasswordsController@postRemind'
]);

Route::get('auth/reset/{token}', [
    'as' => 'reset.create',
    'uses' => 'PasswordsController@getReset'
]);

Route::post('auth/rest', [
   'as' => 'reset.store',
   'uses' => 'PasswordsController@postReset'
]);