<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 순서주의
        // app()->setLocale(...); 호출이 먼저 나오고 뷰 컴포저를 선언해야 한다.

        //app()->setLocale('ko');

        if ($locale = request()->cookie('locale__myapp')) {
            //app()->setLocale(\Crypt::decrypt($locale));
        }

        \Carbon\Carbon::setLocale(app()->getLocale());

        view()->composer('*', function ($view) {
           $allTags = \Cache::rememberForever('tags.partial.list', function() {
              return \App\Tag::all();
           });

           $currentLocale = app()->getLocale();

           //$currentUrl = request()->fullUrl();
           $currentUrl = currentUrl();

            $view->with(compact('allTags', 'currentLocale', 'currentUrl'));
        });
    }
}
