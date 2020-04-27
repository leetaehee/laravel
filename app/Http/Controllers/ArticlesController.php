<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = null)
    {
        //$articles = \App\Article::with('user')->latest()->paginate(3);
		//dd(view('articles.index', compact('articles'))->render());
        //return view('articles.index', compact('articles'));

        $query = $slug ? \App\Tag::whereSlug($slug)->firstOrFail()->articles()
            : new \App\Article;

        $articles = $query->latest()->paginate(3);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article = new \App\Article;

        //return view('articles.create');
        return view('articles.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\ArticlesRequest $request)
    {
        //$article = \App\User::find(1)->articles()->create($request->all());
        $article = $request->user()->articles()->create($request->all());

        if (! $article) {
            return back()->with('flash_message', '글이 저장되지 않았습니다.')
                ->withInput();
        }

        $article->tags()->sync($request->input('tags'));

        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach ($files as $file) {
                $filename = Str::random() . filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);

                $article->attachments()->create([
                    'filename' => $filename,
                    'bytes' => $file->getSize(),
                    'mome' => $file->getClientMimeType()
                ]);

                $file->move(attachments_path(), $filename);

            }
        }

        event(new \App\Events\ArticlesEvent($article));

        return redirect(route('articles.index'))->with('flash_message', '작성하신 글이 저장되었습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Article $article)
    {
        //$article = \App\Article::findOrFail($id);
        //dd($article);
        //return $article->toArray();

        $comments = $article->comments()->with('replies')->latest()->get();

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Article $article)
    {
        $this->authorize('update', $article);

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\ArticlesRequest $request, \App\Article $article)
    {
        $article->update($request->all());
        $article->tags()->sync($request->input('tags'));

        flash()->success('수정 하신 내용을 저장 했습니다.');

        return redirect(route('articles.show', $article->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();

        return response()->json([], 204);
    }
}
