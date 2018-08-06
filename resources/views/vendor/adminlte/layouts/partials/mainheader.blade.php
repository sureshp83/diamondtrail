<!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="{{URL::to('/admin/dashboard')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>D</b>T</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Diamond</b>Trail</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">{{count($uncompleteuser)}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have {{count($uncompleteuser)}} enquiries</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                            
                            @foreach($uncompleteuser as $ucuser)
                            <li><!-- start message -->
                                    <a href="{{URL::to('admin/users/edit/')}}/{{$ucuser['id']}}">
                                        <div class="pull-left">
                                            <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
                                        </div>
                                        <h4>
                                            {{$ucuser['first_name']}}&nbsp;{{$ucuser['last_name']}}
                                            <!-- <small><i class="fa fa-clock-o"></i> 5 mins</small> -->
                                        </h4>
                                        <p>New User Enquiries.</p>
                                    </a>
                                </li>
                                <!-- end message -->
                            @endforeach
                            </ul>
                        </li>
                        <li class="footer"><a href="#">See All Messages</a></li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('images')}}/{{\Auth::guard('admin')->user()->profile_pic}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{\Auth::guard('admin')->user()->first_name}} {{\Auth::guard('admin')->user()->last_name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset('images/')}}/{{\Auth::guard('admin')->user()->profile_pic}}" class="img-circle" alt="User Image">

                            <p>
                                {{\Auth::guard('admin')->user()->first_name}} {{\Auth::guard('admin')->user()->last_name}}
                                <small></small>
                            </p>
                        </li>
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{URL::to('admin/profile')}}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{URL::to('admin/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                {{--<li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>--}}
            </ul>
        </div>
    </nav>
</header>
