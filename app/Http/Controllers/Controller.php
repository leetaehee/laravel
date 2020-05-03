<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $cache;

    public function __construct()
    {
        $this->cache = app('cache');

        if ((new \ReflectionClass($this))->implementsInterface(Cacheable::class) and taggable()) {
            $this->cache = app('cache')->tags($this->cacheTags());
        }
    }

    protected function cache($key, $minutes, $query, $method, ...$args)
    {
        $args = (! empty($args)) ? implode(',', $args) : null;

        if (config('project.cache') === false) {
            return $query->{$method}($args);
        }

        // file cache
        return \Cache::remember($key, $minutes, function () use($query, $method, $args) {
            return  $query->{$method}($args);
        });

        // memcached
        /*
        $cache = taggable() ? app('cache')->tags('???') : app('cache');

        return $cache->remember($key, $minutes, function () use($query, $method, $args) {
            return  $query->{$method}($args);
        });
        */

        // 캐시태그
        /*
        return $this->cache->remember($key, $minutes, function () use($query, $method, $args) {
            return  $query->{$method}($args);
        });
        */
    }
}
