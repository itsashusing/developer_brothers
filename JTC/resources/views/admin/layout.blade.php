<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Think of DG Think of JTC | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body class="skin-blue">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="logo"><b>Admin</b>JTC</a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">

                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        @if (session('admin_id'))
                        <li class="dropdown user user-menu">
                            <div>
                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-primary mb-2" data-bs-toggle="collapse"
                                        href="#multiCollapseExample1" role="button" aria-expanded="false"
                                        aria-controls="multiCollapseExample1">Admin</a>
                                </div>
                                <div class="">
                                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                                        <div class="card p-2 " style="width: 10rem; background-color: #3C8DBC">
                                            <div>

                                                <a href="{{route('profile')}}"
                                                    class="btn btn-success btn-sm">Profile</a>
                                                <a href="{{ route('adminlogout') }}" class="btn btn-danger btn-sm">Sign
                                                    out</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </li>
                        @else
                        <li class="dropdown messages-menu">
                            <a class="text-center  btn btn-primary btn-sm " href="{{ route('adminlogin') }}">Login</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left info">
                        <h3>Admin</h3>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form -->

                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i
                                class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                            <li class="active"><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-files-o"></i>
                            <span>FO</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('allFo') }}"><i class="fa fa-circle-o"></i> All</a>
                            </li>
                            <li><a href="{{ route('activeFo') }}"><i class="fa fa-circle-o"></i> Active</a></li>
                            <li><a href="{{route('inActiveFo')}}"><i class="fa fa-circle-o"></i> Inactive</a></li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>Add Leads</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('addLeads') }}"><i class="fa fa-circle-o"></i> ADD</a>
                            </li>
                            <li><a href="{{ route('importleads') }}"><i class="fa fa-circle-o"></i> Import</a></li>

                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>Leads</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('allLeads')}}"><i class="fa fa-circle-o"></i> All</a></li>
                            <li><a href="{{route('openLeads')}}"><i class="fa fa-circle-o"></i> Open</a></li>
                            <li><a href="{{route('closeLeads')}}"><i class="fa fa-circle-o"></i> Close</a>
                            </li>
                            <li><a href="{{route('timeoutLeads')}}"><i class="fa fa-circle-o"></i> Time out</a>
                            </li>
                            <li><a href="{{route('notAssignLeads')}}"><i class="fa fa-circle-o"></i> Not Assign</a>
                            </li>
                        </ul>
                    </li>

                    <li class="header">Others</li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa-solid fa-rotate-right"></i>
                            <span>Sub Admin</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('roles') }}"><i class="fa fa-circle-o"></i> Role</a>
                            </li>
                            <li><a href="{{ route('activeFo') }}"><i class="fa fa-circle-o"></i> Sub Admin</a></li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-solid fa-rotate-right"></i>
                            <span>Reopen Request</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('addLeads') }}"><i class="fa fa-circle-o"></i> Accept</a>
                            </li>
                            <li><a href="{{ route('activeFo') }}"><i class="fa fa-circle-o"></i> Reject</a></li>

                        </ul>
                    </li>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @yield('title')
                    {{-- <small>Version 2.0</small> --}}
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>
            <!-- Main content -->
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('danger'))
            <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                {{ session('danger') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <section class="content">
                <div class="container">

                    @yield('content')
                </div>
            </section>
        </div>
    </div>

    <!-- /.content -->
    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2024-2025 <a href="/">JTC</a>.</strong> All
        rights reserved.
    </footer>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="{{ url('public/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ url('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{ url('/plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('/dist/js/app.min.js" type="text/javascript') }}"></script>
    <!-- Sparkline -->
    <script src="{{ url('/plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="{{ url('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="{{ url('/plugins/daterangepicker/daterangepicker.js" type="text/javascript') }}"></script>
    <!-- datepicker -->
    <script src="{{ url('/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript') }}"></script>
    <!-- iCheck -->
    <script src="{{ url('/plugins/iCheck/icheck.min.js" type="text/javascript') }}"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{ url('/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript') }}"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="{{ url('/plugins/chartjs/Chart.min.js" type="text/javascript') }}"></script>


    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('/plugins/dist/js/demo.js" type="text/javascript') }}"></script>


</body>

</html>