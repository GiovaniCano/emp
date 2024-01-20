<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    @if (isset($vue) && $vue === true)
        @vite(['resources/scss/app.scss', 'resources/vue/app.js'])
        @auth
            @routes
        @endauth
    @else
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @endif
</head>
<body>
    <div id="app">
        @yield('app')
    </div>
</body>
</html>