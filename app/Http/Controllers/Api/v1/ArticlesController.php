<?php
/**
 * Created by PhpStorm.
 * User: developerleetaehee
 * Date: 2020-05-19
 * Time: 22:11
 */

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ArticlesController as ParentController;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticlesController extends ParentController
{
    public function __construct()
    {
    }

    protected function respondCreated(\App\Article $article)
    {
        return response()->json(
            ['success' => 'created'],
            201,
            ['Location' => '생성한_리소스의_상세보기_API_엔드포인트'],
            JSON_PRETTY_PRINT
        );
    }

    protected function respondCollection(LengthAwarePaginator $articles)
    {
        return $articles->toJson(JSON_PRETTY_PRINT);
    }

    public function tags()
    {
        return \App\Tag::all();
    }
}