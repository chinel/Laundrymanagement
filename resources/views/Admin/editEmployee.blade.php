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
    <link href="{{asset('../assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

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
                <h4 class="page-title">Edit employee</h4>
            </div>
        </div>


        <div class="row">


            <div class="col-lg-12">
                <div class="card-box">



                    <form class="form-horizontal" role="form" data-parsley-validate novalidate action="{{url('Admin/editEmployee/'.$employee->id)}}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">First Name*</label>
                            <div class="col-sm-10">
                                <input type="text" required  class="form-control" name="fname"
                                       placeholder="First Name" value="{{$employee->fname}}">
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">Last Name*</label>
                            <div class="col-sm-10">
                                <input type="text" required  class="form-control" name="lname" value="{{$employee->lname}}"
                                       placeholder="Last Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-sm-2 control-label">Phone*</label>
                            <div class="col-sm-10">
                                <input  type="text" placeholder="Phone" required parsley-type="number" name="contact" value="{{$employee->contact}}"
                                        class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Birth date</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker" required name="birthdate" value="{{$employee->birthdate}}">
                                    <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
                                </div><!-- input-group -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Gender</label>
                            <div class="col-sm-10">
                                <select class="form-control" required name="gender">
                                    <option value="">Select gender</option>
                                    <option value="female" @if($employee->gender == "female") selected @endif>Female</option>
                                    <option value="male" @if($employee->gender == "male") selected @endif>Male</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Job position</label>
                            <div class="col-sm-10">
                                <select class="form-control" required name="position">
                                    <option value="">Select job position</option>
                                    <option value="accountant" @if($employee->position == "accountant") selected @endif>Accountant</option>
                                    <option value="quality control" @if($employee->position == "quality control") selected @endif>Quality Control</option>
                                    <option value="launderer" @if($employee->position == "launderer") selected @endif>Launderer</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-sm-2 control-label">Address*</label>
                            <div class="col-sm-10">
                                <textarea required class="form-control" name="address">{{$employee->address}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-sm-2 control-label">Employee's old Photo*</label>
                            <div class="col-sm-10">
                                <img src="{{asset('/uploads/'.$employee->photo)}}" width="150" height="150"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-sm-2 control-label">Employee's new Photo*</label>
                            <div class="col-sm-10">
                                <input  type="file" class="form-control" name="photo">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-primary waves-effect waves-light pull-right">
                                    Submit
                                </button>

                            </div>
                        </div>
                    </form>
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

<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="{{asset('../assets/plugins/parsleyjs/dist/parsley.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('../assets/js/jquery.core.js')}}"></script>
<script src="{{asset('../assets/js/jquery.app.js')}}"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
        jQuery('#datepicker').datepicker();
    });
</script>


</body>
</html>