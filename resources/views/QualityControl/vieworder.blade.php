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

    <link href="{{asset('../assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet')}}">
    <link href="{{asset('../assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />


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
                        <a href="{{url('/QualityControl')}}"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a>
                    </li>

                    <li class="has-submenu">
                        <a href="#"><i class="zmdi zmdi-view-list"></i> <span> Laundry </span> </a>
                        <ul class="submenu">

                            <li><a href="{{url('/QualityControl/launderers')}}">Launderers</a></li>
                        </ul>
                    </li>


                    <li class="has-submenu">
                        <a href="{{url('/QualityControl/viewOrders')}}"><i class="zmdi zmdi-collection-item"></i><span> Job orders </span> </a>

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
                <h4 class="page-title">job order from {{$order[0]->fname}} {{$order[0]->lname}}</h4>
            </div>
        </div>


        <div class="row">


            <div class="col-lg-12">
                <div class="card-box">



                    <form class="form-horizontal" role="form">



                        <div class="form-group">
                            <label class="col-sm-2 control-label">Customer</label>
                            <div class="col-sm-10">
                                <p class="form-control-static">{{$order[0]->fname}} {{$order[0]->lname}}</p>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Order Date</label>
                            <div class="col-sm-10">
                                <p class="form-control-static">{{$order[0]->created_at}}</p>

                            </div>
                        </div>


                        <div class="form-group">
                            <label  class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                <p class="form-control-static">{{$order[0]->status}}</p>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">Delivery date</label>
                            <div class="col-sm-10">
                                <p class="form-control-static">{{$order[0]->delivery_date}}</p>
                            </div>
                        </div>



                    </form>


                    <br/>
                    <h2>Job order</h2>
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th>Cloth type</th>
                            <th>Service Type</th>
                            <th>Quantity</th>
                            <th>Total amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allOrders as $allOrder)
                            <tr>
                                <td>{{$allOrder->title}}</td>
                                <td>{{$allOrder->name}}</td>
                                <td>{{$allOrder->quantity}}</td>
                                <td>₦{{$allOrder->total}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <th colspan="2">Total</th>
                        <th>{{array_sum($order[0]->quantity($order[0]->customer_id))}}</th>
                        <th>₦{{array_sum($order[0]->total($order[0]->customer_id))}}</th>
                        </tfoot>
                    </table>


                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->





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

<script src="{{asset('../assets/plugins/moment/moment.js')}}"></script>
<script src="{{asset('../assets/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('../assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('../assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('../assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}" type="text/javascript"></script>


<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="{{asset('../assets/plugins/parsleyjs/dist/parsley.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('../assets/js/jquery.core.js')}}"></script>
<script src="{{asset('../assets/js/jquery.app.js')}}"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
        jQuery('#datepicker').datepicker();
        $("input[name='demo3']").TouchSpin({
            buttondown_class: "btn btn-primary",
            buttonup_class: "btn btn-primary"
        });
    });
</script>


</body>
</html>