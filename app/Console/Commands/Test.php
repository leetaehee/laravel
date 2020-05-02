<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '라라벨 크론탭 테스트';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \DB::table('tests')->insert(
            ['content' => '라라벨 크론탭 테스트 중입니다~']
        );

        $this->info('크론탭이 돌았습니다...');

        return;
    }
}
