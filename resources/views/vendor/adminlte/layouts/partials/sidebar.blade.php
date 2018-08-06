<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        {{--<div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>--}}
        <!-- search form -->
        {{--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>--}}
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            
            <li class="{{(\Request::Segment(2)=='dashboard')?'active':''}}">
                <a href="{{URL::to('/admin/dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            <li class="{{(\Request::Segment(2)=='vendors' || \Request::Segment(2)=='view-diamonds' || \Request::Segment(2)=='edit-diamond')?'active':''}}"><a href="{{URL::to('admin/vendors')}}"><i class="fa fa-th"></i> <span>Vendors</span></a></li>
            <li class="treeview {{(\Request::Segment(2)=='seller-users' || \Request::Segment(2)=='buyer-users' || \Request::Segment(2)=='users')?'active':''}}">
                <a href="#"><i class="fa fa-user"></i> <span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{(\Request::Segment(2)=='seller-users')?'active':''}}"><a href="{{URL::to('admin/seller-users')}}"><i class="fa fa-circle-o"></i> Sellers</a></li>
                    <li class="{{(\Request::Segment(2)=='buyer-users')?'active':''}}"><a href="{{URL::to('admin/buyer-users')}}"><i class="fa fa-circle-o"></i> Buyers</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-files-o"></i> <span>Landing Pages</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!-- <li class="treeview">
                    	<a href="#">
                    		<i class="fa fa-circle-o"></i> Home
                    	</a>
                    	<ul class="treeview-menu">
                    	 <li><a href="{{URL::to('admin/content/public-home')}}"><i class="fa fa-circle-o"></i> Public Home</a></li>
                    	 <li><a href="{{URL::to('admin/content/trading-home')}}"><i class="fa fa-circle-o"></i> Trading Home</a></li>		
                    	</ul>
                    </li> -->
                    <li><a href="{{URL::to('admin/content/producer')}}"><i class="fa fa-circle-o"></i> Producer</a></li>
                    <li><a href="{{URL::to('admin/content/about-us')}}"><i class="fa fa-circle-o"></i> About-us</a></li>
                    <li><a href="{{URL::to('admin/content/traceability')}}"><i class="fa fa-circle-o"></i> Traceability-program</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
