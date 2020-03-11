@extends('layouts.master')

@section('content')
	<div>
		<h1>포럼글 목록</h1>
		<hr/>
		<ul>
			@forelse($articles as $article)
				<li>
					{{ $article->title }}
					<small>
						by {{ $article->user->name }}
					</small>
				</li>
			@empty
				<p>글이 없습니다.</p>
			@endforelse
		</ul>
	</div>

	@if($articles->count())
		<div>
			{!! $articles->render() !!}
		</div>
	@endif
@stop
