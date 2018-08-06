<!--

	HEADER LAYOUT

-->
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12 logo-left">

                @include("layouts.partials.svg_logo")
            </div>
            <div class="col-lg-8 col-md-8 col-xs-12 menu-right">
                @if(\Auth::check())
                    @include("layouts.partials.nav_user")
                @else
                    @include("layouts.partials.nav_main")
                @endif


            </div>
        </div>
    </div>
</header>


