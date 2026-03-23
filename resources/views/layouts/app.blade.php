<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Crud</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 text-gray-900 min-h-screen">
    @include('layouts.partials.header')
    @include('layouts.partials.navbar')
    @yield('content')
    @include('layouts.partials.footer')
    @vite('resources/js/app.js')
</body>

</html>
