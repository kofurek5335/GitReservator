<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<title>@if(isset($title)){{$title}}@endif</title>
</head>
<body>
<div class="container">
	<div class="row justify-content-center">
		@yield('body')
	</div>
</div>
</body>
</html>