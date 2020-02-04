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

Route::get('/', function() {
	/*
	return view('welcome')->with('name', 'Foo');
	*/
	
	/*
	return view('welcome')->with([
		'name'=> 'Foo',
		'greeting'=> '안녕하세요?',
	]);
	*/

	return view('welcome', [
		'name'=> 'Foo',
		'greeting'=> '안녕하세요?',
	]);
});