<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@index');
Route::resource('articles', 'ArticlesController');

Route::get('auth/login', function(){
	$credentials = [
		'email'=> 'john@example.com',
		'password'=> 'pass1word'
	];

	if (! auth()->attempt($credentials) ) {
		return '로그인 정보가 정확하지 않습니다.';
	}

	return redirect('protected');
})->name('auth_login');

Route::get('protected', ['middleware' => 'auth', function () { 
	dump(session()->all());

	return '어서오세요' . auth()->user()->name;
}]);

Route::get('auth/logout', function(){
	auth()->logout();

	return '또 봐요~';
});

Route::get('mail', function(){
   $article = \App\Article::with('user')->find(1);

	return Mail::send(
       'emails.articles.created',
       compact('article'),
       function ($message) use ($article) {
           $message->from('lastride25@kevinlab.com', '케빈랩_이태희주임');
		   $message->to(['lastride25@naver.com','ceman08071039@gmail.com']);
		   $message->subject('[New] 새 글이 등록되었습니다-', $article->title);
		   $message->cc('lastride25@icloud.com');
       }
   );

});