@extends('layouts.master')

@section('content')
    <div>
        <h1>새 포럼 글쓰기</h1>

        <hr/>

        <form action="{{ route('articles.store')  }}" method="post">
            {!! csrf_field() !!}

            <div>
                <label for="title">제목</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"/>
                {!! $errors->first('title', '<span>:message</span>') !!}
            </div>

            <div>
                <label for="content">본문</label>
                <textarea name="content" id="content" row="10">{{ old('content') }}</textarea>
                {!! $errors->first('content', '<span>:message</span>') !!}
            </div>

            <div>
                <button type="submit">저장하기</button>
            </div>
        </form>
    </div>
@stop