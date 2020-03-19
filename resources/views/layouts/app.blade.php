<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    @yield('style')

</head>
<body id="app-layout">

    @include('layouts.partial.navigation')

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>

    @include('layouts.partial.footer')

    <script src="https://kit.fontawesome.com/8f663341dd.js" crossorigin="anonymous"></script>
    <script src="/bootstrap/js/jquery-3.4.1.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>

    @yield('script')

</body>
</html>