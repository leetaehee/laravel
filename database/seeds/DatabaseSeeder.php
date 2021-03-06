<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (config('database.default') !== 'sqlite') {
			DB::statement('SET FOREIGN_KEY_CHECKS=0');
		}

        /* 유저 */
		App\User::truncate();
		$this->call(UsersTableSeeder::class);

		/* 아티클 */
		App\Article::truncate();
		$this->call(ArticlesTableSeeder::class);

		/* 태그 */
		App\Tag::truncate();
		DB::table('article_tag')->truncate();
		$tags = config('project.tags');

		/* 댓글 */
        App\Comment::truncate();

        /* 투표 */
        App\Vote::truncate();

		foreach ($tags as $slug => $name) {
		    App\Tag::create([
		       'name' => $name,
               'slug' => Str::slug($slug)
            ]);
        }

		$this->command->info('Seeded: tags table');

		/* 변수 선언 */
        $faker = app(Faker\Generator::class);
        $user = App\User::all();
        $articles = App\Article::all();
        $tags = App\Tag::all();

        /* 아티클과 태그 연결 */
        foreach ($articles as $article) {
            $article->tags()->sync(
                $faker->randomElements(
                    $tags->pluck('id')->toArray(), rand(1, 3)
                )
            );
        }

        $this->command->info('Seeded: article_tag table');

        // 최상위 댓글
        $articles->each(function ($article) {
            $article->comments()->save(factory(App\Comment::class)->make());
            $article->comments()->save(factory(App\Comment::class)->make());
        });

        // 자식댓글
        $articles->each(function ($article) use ($faker){
            $commentIds = App\Comment::pluck('id')->toArray();

            $count = collect($commentIds)->count();
            if ($count > 0) {
                foreach (range(1, 5) as $index) {

                    $parentData = $faker->randomElements($commentIds);

                    $article->comments()->save(
                        factory(App\Comment::class)->make([
                            'parent_id' => $parentData[0],
                        ])
                    );
                }
            }
        });

        $this->command->info('Seeded: comments table');

        // 투표하기
        $comments = App\Comment::all();

        $comments->each(function ($comment) {
            $comment->votes()->save(factory(App\Vote::class)->make());
            $comment->votes()->save(factory(App\Vote::class)->make());
            $comment->votes()->save(factory(App\Vote::class)->make());
        });

        $this->command->info('Seeded : votes table');

		if (config('database.default') !== 'sqlite') {
			DB::statement('SET FOREIGN_KEY_CHECKS=1');
		}
    }
}
