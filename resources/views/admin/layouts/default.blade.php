<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>管理後台</title>
    @include('admin.layouts.script')
</head>
<body>
    @section('heard')
        @include('admin.layouts.heard')
    @show
    <div class="ch-container">
        <div class="row">
            @section('sidebar')
                @include('admin.layouts.sidebar')
            @show
            @yield('content')
        </div>
    </div>
    <hr>

    @section('footer')
        @include('admin.layouts.footer')
    @show
</body>
</html>