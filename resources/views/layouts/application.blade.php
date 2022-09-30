@php($v = '1.0.1')
<!doctype html>
<html lang="{{ helper()->language() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css?v=' . $v) }}">
    @stack('inlineCss')
</head>
<body>

<x-common.header/>

<x-common.navbar/>

<main class="min-h-[100%]">
    @yield('content')
</main>

<x-common.footer/>

<script src="{{ asset('assets/js/script.js?v=' . $v) }}" async></script>
@stack('inlineJs')
</body>
</html>
