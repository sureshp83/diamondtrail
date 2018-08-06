<!--

	USER NAV

-->

<div class="col-lg-6 col-md-6 col-xs-12 menu-right">
	<div class="header-navigation">
		<nav class="navbar navbar-expand-lg">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<!-- <i class="fas fa-bars fa-lg"></i> -->
				<img src="{{asset('images/icon_menu.svg')}}" alt="Menu" title="Menu">
                <img src="{{asset('images/icon_close.svg')}}" alt="Close" title="Close">
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
                <?php $activeClass="";
                if(Request::segment(2)=="post-diamond" || Request::segment(2)=="request-diamond" || Request::segment(2)=="pdiamond-step1" ||  Request::segment(2)=="pdiamond-step2" || Request::segment(2)=="editpost")
                    $activeClass="active";
                ?>

                <?php if(Auth::user()->roles[0]->name=="Buyer" || Request::Segment(1) == "buyer"){ ?>
				<ul class="navbar-nav">
					<li class="nav-item {{(Request::segment(2)=="dashboard")?"active":""}}">
						<a class="nav-link text-capitalize" href="{{URL::to('buyer/dashboard')}}">Dashboard</a>
					</li>
					<li class="nav-item {{(Request::segment(2) == "search-diamond") ? "active":""}}">
						<a class="nav-link text-capitalize" href="{{URL::to('buyer/search-diamond')}}">Search Diamonds</a>
					</li>
					<li class="nav-item {{(Request::segment(2) == "all-request" || Request::segment(2) == "archived-request")?"active":""}}">
						<a class="nav-link text-capitalize" href="javascript:void(0);">My Requests</a>
						<ul class="sub-menu">
							<li><a href="{{URL::to('buyer/all-request')}}" class="text-capitalize">All Requests</a></li>
							{{--<li><a href="{{URL::to('buyer/published-request')}}" class="text-capitalize">Published Request</a></li>
							<li><a href="{{URL::to('buyer/pending-request')}}" class="text-capitalize">Pending Request</a></li>--}}
							<li><a href="{{URL::to('buyer/archived-request')}}" class="text-capitalize">Archived Requests</a></li>
						</ul>
					</li>
					<li class="nav-item hide-in-desktop <?php echo $activeClass;?>">
						<a class="nav-link" href="{{URL::to('buyer/pdiamond-step1')}}">Request a Diamond</a>
					</li>
				</ul>
			<?php } else if(Auth::user()->roles[0]->name=="Seller" || Request::Segment(1) == "seller") { ?>
				<ul class="navbar-nav">
					<li class="nav-item {{(Request::segment(2)=="dashboard")?"active":""}}">
						<a class="nav-link text-capitalize" href="{{URL::to('seller/dashboard')}}">Dashboard</a>
					</li>
					<li class="nav-item {{(Request::segment(2)=="search-request")?"active":""}}">
						<a class="nav-link text-capitalize" href="{{URL::to('seller/search-request')}}">Search Requests</a>
					</li>
					<li class="nav-item {{(Request::segment(2)=="all-post" || Request::segment(2)=="published-post" || Request::segment(2)=="pending-post" || Request::segment(2)=="archived-post")?"active":""}}">
						<a class="nav-link text-capitalize" href="javascript:void(0);">My Posts</a>
						<ul class="sub-menu">
							<li><a href="{{URL::to('seller/all-post')}}" class="text-capitalize">All Posts</a></li>
							<li><a href="{{URL::to('seller/published-post')}}" class="text-capitalize">Published Posts</a></li>
							<li><a href="{{URL::to('seller/pending-post')}}" class="text-capitalize">Pending Posts</a></li>
							<li><a href="{{URL::to('seller/archived-post')}}" class="text-capitalize">Archived Posts</a></li>
						</ul>
					</li>

					<li class="nav-item hide-in-desktop <?php echo $activeClass;?>">
						<a class="nav-link text-capitalize" href="{{URL::to('seller/post-diamond')}}">Post a Diamond</a>
					</li>
				</ul>
			<?php } ?>
			</div>
		</nav>
	</div>
    <?php
    $activeClass="";
    if(Request::segment(2)=="post-diamond" || Request::segment(2)=="request-diamond" || Request::segment(2)=="pdiamond-step1" ||  Request::segment(2)=="pdiamond-step2" || Request::segment(2)=="editpost")
        $activeClass="active";

	if(Auth::user()->roles[0]->name=="Buyer" || Request::Segment(1) == "buyer"){ ?>
	<div class="hide-in-mobile header-button-block <?php echo $activeClass;?>">
		<a class="btn btn-primary" href="{{URL::to('buyer/pdiamond-step1')}}">Request a diamond</a>
	</div>
    <?php } else if(Auth::user()->roles[0]->name=="Seller" || Request::Segment(1) == "seller") {
        ?>
	<div class="hide-in-mobile header-button-block <?php echo $activeClass;?>">
		<a class="btn btn-primary" href="{{URL::to('seller/post-diamond')}}">Post a diamond</a>
	</div>
	<?php }?>
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