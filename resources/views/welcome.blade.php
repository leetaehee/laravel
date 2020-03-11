@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
	<p>저는 자식 뷰의 'content' 섹션입니다.</p>

	@include('partials.footer')

@endsection

@section('script')
    <script>
        $(function(){
            console.log('blade - ');
        });
    </script>
@endsection
