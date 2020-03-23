<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Single Page Forum</title>
</head>
<body>
    <div id="app">        
            <app-component />                 
    </div>

    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>