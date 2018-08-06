<!DOCTYPE html>
<html lang="en" >

    {{-- The head and its inclusions --}}
    @include('layouts.partials.head')

    <body class="<?php echo (\Auth::check())? 'user-logged-in' : '';?> {{Request::segment(2)}}" id="{{Request::segment(1)}}_user">

        {{-- The main header --}}
        @if(\Auth::check())
            @include("layouts.partials.header_user")
        @else
            @include("layouts.partials.header_main")
        @endif


        {{-- Anything in here is vueable --}}

        <main class="main-content">
            @if (session('csrf_error'))
             {{ session('csrf_error') }} 
            @endif
            @if(Session::has('message'))
            <div class="alert-message">
                <div class="alert {{ Session::get('alert-class', 'alert-success') }}">
                        {{ Session::get('message') }}
                </div>
            </div>
            @endif

                {{-- Puke up the view's contents --}}
                @yield('content')

        </main>

        {{-- The main footer --}}
        @include("layouts.partials.footer")

        {{-- Scripts for theme --}}


        {{-- Scripts from view files specifically --}}
        @yield("scripts")

    </body>

</html>
