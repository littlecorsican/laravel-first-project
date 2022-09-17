
 
<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
    </head>
    <body>
        this is layout
        @include('include/header')
        <!-- @section('sidebar')
            This is the master sidebar.
        @show -->
 
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>