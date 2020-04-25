<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Munki') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@7.2.0/dist/js/autoComplete.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include('components.nav')
    <main>
        <section id="alertSection" class="hidden">
            <div class="alertWrapper flexCenterAllVert">
                <div onclick=closeAlert() class="closeIcon centerAll pointer fancyShadow">X</div>
                @include('components.logInAlert')
            </div>
        </section>
        @yield('content')
    </main>
</body>
<script>
    const alert=document.querySelector('#alertSection')
    function openAlert(){
        alert.classList.remove('hidden');
    }
    function closeAlert(){
        alert.classList.add('hidden');
    }
</script>
</html>

