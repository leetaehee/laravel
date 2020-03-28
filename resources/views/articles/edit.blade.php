@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h4>포럼 <small> / 글 수정 / {{ $article->title }}</small></h4>
    </div>

    <form action="{{ route('articles.update', $article->id) }}" method="POST">
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}

        @include('articles.partial.form')

        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="수정하기">
        </div>
    </form>
@stop