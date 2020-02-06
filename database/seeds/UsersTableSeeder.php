<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(App\User::class)->create([
			'name' => 'John Doe',
			'email' => 'john@example.com',
			'password' => bcrypt('password')
		]);

		factory(App\User::class)->create([
            'name' => 'Lee Tae Hee',
            'email' => 'lastride25@naver.com',
            'password' => bcrypt('password')
        ]);
		
		factory(App\User::class, 5)->create();
    }
}
