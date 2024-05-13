<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-200">
    @include('dashboard.setting.sidebar')
    @yield('setting')
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const sidebarButton = document.querySelector('[data-drawer-toggle="default-sidebar"]');
    const sidebar = document.getElementById('default-sidebar');

    sidebarButton.addEventListener('click', function () {
        sidebar.classList.toggle('-translate-x-full');
        });
    });
</script>
</html>