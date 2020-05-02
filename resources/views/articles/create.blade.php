@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h4>포럼 <small> / 글 등록</small></h4>
    </div>

    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
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
            <label for="tags">태그</label>
            <select id="tags"
                    name="tags[]"
                    class="form-control"
                    multiple>
                @foreach ($allTags as $tag)
                    <option value="{{ $tag->id }}"
                            {{ $article->tags->contains($tag->id) ? 'selected="selected"' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('tags', '<span class="form-error">:message</span>') !!}
        </div>

        <div class="form-group">
            <label for="file">파일</label>
            <input type="file"
                   name="files[]"
                   id="files"
                   class="form-control"
                   multiple>
            {!! $errors->first('files.0', '<span class="form-error">:message</span>') !!}
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox"
                           name="notification"
                           value="{{ old('notification', 1) }}"
                           checked>
                    댓글이 작성되면 이메일 알람 받기
                </label>
            </div>
        </div>

        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="등록하기">
        </div>
    </form>
@stop