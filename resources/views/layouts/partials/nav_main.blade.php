
	<div class="header-button-block float-sm-right hide-in-mobile">
		<a class="btn btn-primary" href="{{URL::to('register')}}">register</a>
	</div>

<div class="header-navigation float-sm-right">
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
					<li class="nav-item {{(Request::segment(1)=="contact-us")?'active':''}}">
						<a class="nav-link text-capitalize" href="{{URL::to('contact-us')}}">Contact</a>
					</li>
					<li class="nav-item {{(Request::segment(1)=="login")?'active':''}}">
						<a class="nav-link text-capitalize" href="{{URL::to('login')}}">Login</a>
					</li>
<!--
					<li class="nav-item hide-in-desktop {{(Request::segment(1)=="register")?'active':''}}">
						<a class="nav-link text-capitalize" href="{{URL::to('register')}}">register</a>
					</li>
-->
				</ul>
			</div>
		</nav>
	</div>

