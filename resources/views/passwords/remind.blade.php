@extends('layouts.app')

@section('content')
    <form action="{{ route('remind.store') }}" method="POST" role="form" class="form__auth">
        {!! csrf_field() !!}

        <div class="form-group">
            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="EMAIL을 입력하세요."
                   value="{{ old('email') }}"
                   autofocus>
            {!! $errors->first('email', '<span class="form-error">:message</span>') !!}
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-lg btn-block" type="submit">
                비밀번호 찾기
            </button>
        </div>
    </form>
@stop