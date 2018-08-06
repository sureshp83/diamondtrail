<head>

    {{-- Site meta --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Site title --}}
    <link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}" />
    <title> @yield('title')</title>

    {{-- This allows us to talk between BE and FE --}}
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    {{-- Styles for theme --}}
    @include("layouts.partials.include_styles")
    @include("layouts.partials.include_scripts")
</head>
