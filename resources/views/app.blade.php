<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Todo App</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
    @livewireStyles
    @stack('start')
</head>

<body>
<div class="min-h-screen antialiased">
    @livewire('todo')
</div>
@livewireScripts
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
@stack('scripts')
</body>
</html>
