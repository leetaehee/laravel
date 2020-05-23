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
        parent::__construct();
        $this->middleware = [];
        $this->middleware('auth.basic.once', ['except' => ['index', 'show', 'tags']]);
    }

    protected function store(\App\Http\Requests\ArticlesRequest $request)
    {
        $payload = array_merge($request->all(), [
            'notification' => $request->has('notification'),
        ]);

        //$article = \App\User::find(1)->articles()->create($payload);
        $article = $request->user()->articles()->create($payload);

        return $this->respondCreated($article);

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
        //return $articles->toJson(JSON_PRETTY_PRINT);
        return (new \App\Transformers\ArticleTransformerBasic)->withPagination($articles);
    }

    protected  function respondInstance(\App\Article $article, $comments)
    {
        // return $article->toJson(JSON_PRETTY_PRINT);
        return (new \App\Transformers\ArticleTransformerBasic)->withItem($article);
    }

    public function tags()
    {
        return \App\Tag::all();
    }
}