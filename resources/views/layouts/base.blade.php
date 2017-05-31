<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AimsEnrich</title>

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/summernote.min.js') }}"></script>

</head>
<body>
    @include('layouts.header')
    
    <div class="body-box">
        @yield('body')
    </div>
    
    @include('layouts.footer')
    
    <script src="{{ asset('js/main.js') }}"></script>


    
</body>
</html>
