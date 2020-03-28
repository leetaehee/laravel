@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h4>포럼 <small> / 글 등록</small></h4>
    </div>

    <form action="{{ route('articles.store') }}" method="POST">
        {!! csrf_field() !!}

        <div class="form-group">
            <label for="title">제목</label>
            <input type="text"
                   name="title"
                   id="title"
                   class="form-control"
                   value="{{ old('title') }}"/>
            {!! $errors->first('title', '<span>:message</span>') !!}
        </div>

        <div class="form-group">
            <label for="content">본문</label>
            <textarea name="content"
                      id="content"
                      class="form-control"
                      row="10">{{ old('content') }}</textarea>
            {!! $errors->first('content', '<span>:message</span>') !!}
        </div>

        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="등록하기">
        </div>
    </form>
@stop