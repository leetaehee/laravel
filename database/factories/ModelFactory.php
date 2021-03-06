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

$factory->define(App\Comment::class, function (Faker $faker) {
   $articleIds = App\Article::pluck('id')->toArray();
   $userIds = App\User::pluck('id')->toArray();

   return [
       'content' => $faker->paragraph,
       'commentable_type' => App\Article::class,
       'commentable_id' => function () use ($faker, $articleIds) {
            return $faker->randomElement($articleIds);
       },
       'user_id' => function () use ($faker, $userIds) {
            return $faker->randomElement($userIds);
       }
   ];
});

$factory->define(App\Vote::class, function(Faker $faker) {
    $up = $faker->randomElement([true, false]);
    $down = !$up;
    $userIds = App\User::pluck('id')->toArray();

    return [
        'up' => $up ? 1 : null,
        'down' => $down ? 1 : null,
        'user_id' => function () use ($faker, $userIds) {
            return $faker->randomElement($userIds);
        },
    ];
});
