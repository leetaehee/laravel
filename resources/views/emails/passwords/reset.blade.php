@extends('layouts.app')

@section('content')
    <form action="{{ route('reset.store') }}" method="POST" class="form__auth">
        {!! csrf_field() !!}

        <input type="hidden"
               name="token"
               value="{{ $token }}">

        <div class="form-group">
            <input type="text"
                   name="email"
                   class="form-control"
                   placeholder="이메일"
                   value="{{ old('email') }}">
            {!! $errors->first('email', '<span class="form-error">:message</span>') !!}
        </div>

        <div class="form-group">
            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="패스워드"
                   value="{{ old('password') }}">
            {!! $errors->first('password', '<span class="form-error">:message</span>') !!}
        </div>

        <div class="form-group">
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   placeholder="패스워드확인"
                   value="{{ old('password_confirmation') }}">
            {!! $errors->first('password_confirmation', '<span class="form-error">:message</span>') !!}
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-lg btn-block" type="submit">
                비밀번호 변경하기
            </button>
        </div>
    </form>
@stop