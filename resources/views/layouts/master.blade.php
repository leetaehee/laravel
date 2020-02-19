<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>라라벨 입문</title>

	@yield('style')
	
</head>
<body>

	@if(session()->has('flash_message'))
		<div>
			{{ session('flash_message') }}
		</div>
	@endif
	
	@yield('content')

	@yield('script')

</body>
</html>