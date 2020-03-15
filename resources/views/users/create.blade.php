@extends('layouts.app')

@section('content')
    <form action="{{ route('users.store') }}" method="POST" class="form__auth">
        {!! csrf_field() !!}

        <div class="form-group {{ $error->has('name') }} ? 'has-error' : '' }}">
            <input type="text" name="name" class="form-control" placeholder="이름" value="{{ old('name') }}" autofocus>
        </div>
    </form>
@stop