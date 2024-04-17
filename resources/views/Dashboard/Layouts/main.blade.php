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
    @include('dashboard.layouts.header')
    @yield('container')
</body>
<script src="./node_modules/preline/dist/preline.js"></script>
<script>
    //Nvabar Fixed
    window.onscroll = function(){
        const header = document.querySelector('header');
        const fixedNav = header.offsetTop;
    
        if(window.pageYOffset > fixedNav){
            header.classList.add('navbar-fixed');
        }else{
            header.classList.remove('navbar-fixed');
        }
    }
    
    //Menuline
    const menuline = document.querySelector('#menuline');
    const navMenu = document.querySelector('#nav-menu');
    
    menuline.addEventListener('click', function(){
        menuline.classList.toggle('menuline-active');
        navMenu.classList.toggle('hidden');
    });
</script>
<script>
    //Nvabar Fixed
    window.onscroll = function(){
        const header = document.querySelector('header');
        const fixedNav = header.offsetTop;
    
        if(window.pageYOffset > fixedNav){
            header.classList.add('navbar-fixed');
        }else{
            header.classList.remove('navbar-fixed');
        }
    }
    
    //Dropdown
    const dropdown = document.querySelector('#dropdown');
    const dropdownMenu = document.querySelector('#dropdown-menu');
    
    dropdown.addEventListener('click', function(){
        dropdown.classList.toggle('dropdown-active');
        dropdownMenu.classList.toggle('hidden');
    });
</script>
<script>
    //Nvabar Fixed
    window.onscroll = function(){
        const header = document.querySelector('header');
        const fixedNav = header.offsetTop;
    
        if(window.pageYOffset > fixedNav){
            header.classList.add('navbar-fixed');
        }else{
            header.classList.remove('navbar-fixed');
        }
    }
    
    //Dropdown
    const dropdown2 = document.querySelector('#dropdown2');
    const dropdownMenu2 = document.querySelector('#dropdown-menu2');
    
    dropdown2.addEventListener('click', function(){
        dropdown2.classList.toggle('dropdown-active2');
        dropdownMenu2.classList.toggle('hidden');
    });
</script>
<script>
    //Nvabar Fixed
    window.onscroll = function(){
        const header = document.querySelector('header');
        const fixedNav = header.offsetTop;
    
        if(window.pageYOffset > fixedNav){
            header.classList.add('navbar-fixed');
        }else{
            header.classList.remove('navbar-fixed');
        }
    }
    
    //Dropdown
    const dropdown3 = document.querySelector('#dropdown3');
    const dropdownMenu3 = document.querySelector('#dropdown-menu3');
    
    dropdown3.addEventListener('click', function(){
        dropdown3.classList.toggle('dropdown-active3');
        dropdownMenu3.classList.toggle('hidden');
    });
</script>
<script>
    function incrementMasaRetensi() {
        var value = parseInt(document.getElementById('masaRetensi').value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('masaRetensi').value = value;
    }

    function decrementMasaRetensi() {
        var value = parseInt(document.getElementById('masaRetensi').value, 10);
        value = isNaN(value) ? 0 : value;
        value--;
        if (value < 1) value = 1;
        document.getElementById('masaRetensi').value = value;
    }

    function incrementJumlah() {
        var value = parseInt(document.getElementById('jumlah').value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('jumlah').value = value;
    }

    function decrementJumlah() {
        var value = parseInt(document.getElementById('jumlah').value, 10);
        value = isNaN(value) ? 0 : value;
        value--;
        if (value < 1) value = 1;
        document.getElementById('jumlah').value = value;
    }
</script>
<script>
    function incrementNilaiRisiko() {
        var value = parseInt(document.getElementById('nilaiRisiko').value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('nilaiRisiko').value = value;
    }

    function decrementNilaiRisiko() {
        var value = parseInt(document.getElementById('nilaiRisiko').value, 10);
        value = isNaN(value) ? 0 : value;
        value--;
        if (value < 1) value = 1;
        document.getElementById('nilaiRisiko').value = value;
    }

    function incrementMasaRetensi() {
        var value = parseInt(document.getElementById('masaRetensi').value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('masaRetensi').value = value;
    }

    function decrementMasaRetensi() {
        var value = parseInt(document.getElementById('masaRetensi').value, 10);
        value = isNaN(value) ? 0 : value;
        value--;
        if (value < 1) value = 1;
        document.getElementById('masaRetensi').value = value;
    }
</script>
</html>