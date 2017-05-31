<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Dashboard</title>
	<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
	
	<script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/summernote.min.js') }}"></script>
</head>
<body>
<div class="app app-default">
	@include('dashboard.includes.sidebar')
	@include('dashboard.includes.floating_btn')
	<div class="app-container">
		@include('dashboard.includes.navbar')
		<div class="dashboard-body">
			@yield('body')
		</div>
	</div>
</div>
	<script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
