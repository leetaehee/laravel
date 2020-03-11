<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>라라벨 입문</title>

    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

    @yield('style')

</head>
<body>

	@if(session()->has('flash_message'))
		<div>
			{{ session('flash_message') }}
		</div>
	@endif

	@yield('content')

    <script src="/bootstrap/js/jquery-3.4.1.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(function(){
           console.log("master - ");
        });
    </script>

	@yield('script')

</body>
</html>
