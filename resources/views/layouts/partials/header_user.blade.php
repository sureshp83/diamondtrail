<!--

	HEADER LAYOUT

-->
<header class="header" id="dashboard-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-xs-12 logo-left">

                @include("layouts.partials.svg_logo")
            </div>

                @if(\Auth::check())
                    @if(Request::segment(1)=="buyer" || Request::segment(1)=="seller")
                    @include("layouts.partials.nav_tradediamond")
                    @else
                    @include("layouts.partials.nav_user")
                    @endif

                @else
                    @include("layouts.partials.nav_main")
                @endif


        </div>
    </div>

</header>


