

<div class="col-lg-6 col-md-6 col-xs-12 menu-right">
   <div class="header-navigation">
    <nav class="navbar navbar-expand-lg">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <!-- <i class="fas fa-bars fa-lg"></i> -->
            <img src="{{asset('images/icon_menu.svg')}}" alt="Menu" title="Menu">
                <img src="{{asset('images/icon_close.svg')}}" alt="Close" title="Close">
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item {{(Request::segment(1)=="about-us")?'active':''}}">
                    <a class="nav-link text-capitalize" href="{{URL::to('about-us')}}">About Us</a>
                </li>
                <li class="nav-item {{(Request::segment(1)=="traceability")?'active':''}}">
                    <a class="nav-link text-capitalize" href="{{URL::to('traceability')}}">Traceability Program</a>
                </li>
                <li class="nav-item {{(Request::segment(1)=='producers' || Request::segment(1)=='single-producer')?'active':''}}">
                    <a class="nav-link text-capitalize" href="{{URL::to('producers')}}/">Producers</a>
                </li>
                {{--<li class="nav-item hide-in-desktop {{(Request::segment(1)=="register")?'active':''}}">
                    <a class="nav-link text-capitalize" href="{{URL::to('')}}">Trade Diamonds</a>
                </li>--}}
            </ul>
        </div>
    </nav>
</div>
    <div class="header-button-block float-sm-right hide-in-mobile">
        <a class="btn btn-primary" href="{{URL::to((Auth::user()->roles[0]->name=='Buyer') ? 'buyer/dashboard':'seller/dashboard')}}">Trade Diamonds</a>
    </div>
</div>
<div class="col-lg-3 col-md-9 col-xs-12 profile-right">
    <div class="header-profile-block float-sm-right">
        <ul>
            <li class="image-block">
                <figure class="<?php echo  (Auth::user()->roles[0]->name=='Buyer')? 'buyer' :'seller'; ?>-login"> <!-- Use class seller-login for seller -->
                    <img src="{{URL::to('images/Icon_Account.svg')}}" alt="Profile" title="Profile" height="24px" width="24px">
                </figure>
            </li>
            <li class="profile-block">
                {{\Auth::user()->username}}
                <span>{{Auth::user()->roles[0]->name}} Mode</span>

                <ul class="login-menu">
                    <li class="text-capitalize"><a href="{{(Auth::user()->roles[0]->name=='Buyer') ? URL::to('buyer/myaccount') : ((Auth::user()->roles[0]->name == 'Buyer And Seller') ? ((\Request::Segment(1) == 'buyer') ? URL::to('buyer/myaccount') : URL::to('seller/myaccount')) : URL::to('seller/myaccount')) }}">My Account</a></li>
                    @if(Auth::user()->roles[0]->name=='Buyer And Seller')

                        <li class="text-capitalize mode-seller <?php echo  (\Request::Segment(1)=='buyer')? 'mode-disable' :'active'; ?> "><a href="{{URL::to('/seller/dashboard')}}">Seller Mode</a></li>
                        <li class="text-capitalize mode-buyer <?php echo  (\Request::Segment(1)=='seller')? 'mode-disable' :'active'; ?>"><a href="{{URL::to('/buyer/dashboard')}}">Buyer Mode</a></li>
                    @endif

                    <li class="text-capitalize">
                        <a href="{{(Auth::user()->roles[0]->name=='Buyer') ? URL::to('buyer/logout') : URL::to('seller/logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{(Auth::user()->roles[0]->name=='Buyer') ? URL::to('buyer/logout') : URL::to('seller/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                    </li>
                </ul>
            </li>
            <li class="search-block">
                <figure>
                    <img src="{{URL::to('images/search_icon.png')}}" alt="Search" title="Search" width="18px">
                </figure>
                <div class="search-box">
                    <form>
                        <div class="form-group">
                            <input type="search" class="form-control" placeholder="Search here...">
                        </div>
                    </form>
                </div>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>

