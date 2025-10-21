<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'About Us')</title>
</head>
<body>
    @include('components.header')
    @yield('content')
    <div style="flex:1">
        
    </div>
    @include('components.footer')
</body>
</html>