<?php

use App\Article;
use App\User;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Article::class, function (Faker $faker) {
    $date = $faker->dateTimeThisMonth;
	$userId = App\User::pluck('id')->toArray();

	return [
        'title'=> $faker->sentence(),
		'content'=> $faker->paragraph(),
		'user_id'=>  $faker->randomElement($userId),
		'created_at'=> $date,
		'updated_at'=> $date
    ];
});

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
        'remember_token' => Str::random(10),
    ];
});