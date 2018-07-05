<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>管理後台</title>
    @include('layouts.script')

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">

</head>
<body>
    @section('heard')
        @include('layouts.heard')
    @show
    <div class="ch-container">
        <div class="row">
            @section('sidebar')
                @include('layouts.sidebar')
            @show
            @yield('content')
        </div>
    </div>
    <hr>

    @section('footer')
        @include('layouts.footer')
    @show
</body>
</html>