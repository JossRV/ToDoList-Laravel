<!DOCTYPE html>
<html lang="{{ str_replace('-', '_', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- icon --}}
    <title>
        @hasSection('title')
            @yield('title') - ToDoList
        @else
            ToDoList
        @endif
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head-end')
</head>

<body>
    @yield('content')
    @stack('body-end')
</body>

</html>
