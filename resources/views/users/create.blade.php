@extends('layouts.app')

@section('content')
    <form action="{{ route('users.store') }}" method="POST" class="form__auth">
        {!! csrf_field() !!}

        <div class="form-group" {{ $errors->has('name') ? 'has-error' : '' }}>
            <input type="text"
                   name="name"
                   class="form-control"
                   placeholder="이름"
                   value="{{ old('name') }}">
            {!! $errors->first('name', '<span class="form-error">:message</span>') !!}
        </div>

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
                가입하기
            </button>
        </div>
    </form>
@stop