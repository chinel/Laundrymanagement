<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <title>Laundry Management</title>


    <link href="{{asset('../assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('../assets/css/core.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('../assets/css/components.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('../assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('../assets/css/pages.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('../assets/css/menu.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('../assets/css/responsive.css')}}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="{{asset('../assets/js/modernizr.min.js')}}"></script>


</head>


<body>

<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="#" class="logo"><span>Laundry<span>Management</span></span></a>
            </div>
            <!-- End Logo container-->


            <div class="menu-extras">

                <ul class="nav navbar-nav navbar-right pull-right">



                    <li class="dropdown user-box">
                        <a href="" class="dropdown-toggle waves-effect waves-light profile " data-toggle="dropdown" aria-expanded="true">
                            <img src="{{asset('../assets/images/users/avatar-1.jpg')}}" alt="user-img" class="img-circle user-img">
                            <div class="user-status away"><i class="zmdi zmdi-dot-circle"></i></div>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="{{url('auth/logout')}}"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

        </div>
    </div>

    <div class="navbar-custom">
        <div class="container">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li>
                        <a href="{{url('/Admin')}}"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a>
                    </li>
                    <li class="has-submenu">
                        <a href="{{url('/Admin/viewCustomer')}}"><i class="zmdi zmdi-invert-colors"></i> <span> Customers </span> </a>

                    </li>

                    <li class="has-submenu">
                        <a href="{{url('/Admin/viewEmployee')}}"><i class="zmdi zmdi-collection-text"></i><span> Employees </span> </a>

                    </li>

                    <li class="has-submenu">
                        <a href="#"><i class="zmdi zmdi-view-list"></i> <span> Laundry </span> </a>
                        <ul class="submenu">
                            <li><a href="{{url('/Admin/viewCloth')}}">Cloth types</a></li>
                            <li><a href="{{url('/Admin/viewLaundry')}}">Laundry services</a></li>
                            <li><a href="{{url('/Admin/viewPrice')}}">Price List</a></li>
                            <li><a href="{{url('/Admin/launderers')}}">Launderers</a></li>
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="#"><i class="zmdi zmdi-chart"></i><span> Finances </span> </a>
                        <ul class="submenu">
                            <li><a href="{{url('/Admin/viewExpenses')}}">Expenses</a></li>
                            <li><a href="{{url('/Admin/viewSales')}}">Sales</a></li>
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="{{url('/Admin/viewOrders')}}"><i class="zmdi zmdi-collection-item"></i><span> Job orders </span> </a>

                    </li>

                    <li class="has-submenu">
                        <a href="{{url('/Admin/report')}}"><i class="zmdi zmdi-layers"></i><span>Reports </span> </a>

                    </li>

                </ul>
                <!-- End navigation menu  -->
            </div>
        </div>
    </div>
</header>
<!-- End Navigation Bar-->


<div class="wrapper">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-15">
                    <a class="btn btn-custom waves-effect waves-light" href="{{url('Admin/addPrice')}}"><span class="m-l-5"><i class="fa fa-plus"></i></span> New Price entry </a>

                </div>
                <h4 class="page-title">Price List</h4>
            </div>
        </div>
        @if(Session::has('message'))

            <div class="alert alert-success">
                <p>{{Session::get('message')}}!</p>
            </div>
        @endif


        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">





                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Service</th>
                            <th>Cloth type</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pricelists as $pricelist)
                            <tr>
                                <th scope="row">{{$pricelist->id}}</th>
                                <td>{{$pricelist->name}}</td>
                                <td>{{$pricelist->title}}</td>
                                <td>₦{{$pricelist->price}}</td>
                                <td>
                                    <a class="btn btn-icon waves-effect waves-light btn-warning m-b-5" title="Edit" href="{{url('Admin/'.$pricelist->id.'/editPrice')}}"> <i class="fa fa-pencil"></i> </a>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div><!-- end col -->


        </div>
        <!-- End row -->



        <!-- Footer -->
        <footer class="footer text-right">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6">
                        2017 © Laundry management system.
                    </div>

                </div>
            </div>
        </footer>
        <!-- End Footer -->

    </div>
    <!-- end container -->





</div>



<!-- jQuery  -->
<script src="{{asset('../assets/js/jquery.min.js')}}"></script>
<script src="{{asset('../assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('../assets/js/detect.js')}}"></script>
<script src="{{asset('../assets/js/fastclick.js')}}"></script>
<script src="{{asset('../assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('../assets/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('../assets/js/waves.js')}}"></script>
<script src="{{asset('../assets/js/wow.min.js')}}"></script>
<script src="{{asset('../assets/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('../assets/js/jquery.scrollTo.min.js')}}"></script>


<!-- App js -->
<script src="{{asset('../assets/js/jquery.core.js')}}"></script>
<script src="{{asset('../assets/js/jquery.app.js')}}"></script>

</body>
</html>