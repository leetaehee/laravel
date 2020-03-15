<?php

/* 메인 */
Route::get('/', 'WelcomeController@index');

/* 사용자가입*/
Route::get('auth/register', [
    'as' => 'users.create',
    'users' => 'UsersController@create'
]);

Route::post('auth/register', [
    'as' => 'users.store',
    'users' => 'UsersController@store'
]);

Route::get('auth/confirm/{code}', [
    'as' => 'users.confirm',
    'users' => 'UsersController@confirm'
]);

/* 사용자 인증 */
Route::get('auth/login', [
    'as' => 'sessions.create',
    'users' => 'SessionsController@create'
]);

Route::post('auth/login', [
    'as' => 'sessions.store',
    'users' => 'SessionsController@store'
]);

Route::get('auth/logout', [
   'as' => 'sessions.destory',
   'users' => 'SessionsController@destory'
]);

/* 비밀번호 초기화 */
Route::get('auth/remind', [
    'as' => 'remind.create',
    'users' => 'PasswordsController@getRemind'
]);

Route::post('auth/remind', [
    'as' => 'remind.store',
    'users' => 'PasswordsController@postRemind'
]);

Route::get('auth/reset/{token}', [
    'as' => 'reset.create',
    'users' => 'PasswordsController@getReset'
]);

Route::post('auth/reset', [
    'as' => 'reset.store',
    'users' => 'PasswordsController@postReset'
]);