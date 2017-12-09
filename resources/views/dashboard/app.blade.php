<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('bassets/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ URL::asset('bassets/img/favicon.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link href="{{ URL::asset('bassets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('bassets/css/material-dashboard.css?v=1.2.0') }}" rel="stylesheet" />
    <link href="{{ URL::asset('bassets/css/demo.css') }}" rel="stylesheet" />
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    <link href='https://cdn.datatables.net/1.10.16/css/dataTables.material.min.css' rel='stylesheet' type='text/css'>
    @yield('css')
</head>
<body>
    <div class="wrapper">
        @if(Auth::user()->role == 1)
            @include('admin.menu')
        @else
            @include('user.menu')
        @endif
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"> Material Dashboard </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">dashboard</i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">notifications</i>
                                    <span class="notification">5</span>
                                    <p class="hidden-lg hidden-md">Notifications</p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#">Mike John responded to your email</a>
                                    </li>
                                    <li>
                                        <a href="#">You have 5 new tasks</a>
                                    </li>
                                    <li>
                                        <a href="#">You're now friend with Andrew</a>
                                    </li>
                                    <li>
                                        <a href="#">Another Notification</a>
                                    </li>
                                    <li>
                                        <a href="#">Another One</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">person</i>
                                    <p class="hidden-lg hidden-md">Profile</p>
                                </a>
                            </li>
                        </ul>
                        <form class="navbar-form navbar-right" role="search">
                            <div class="form-group  is-empty">
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="material-input"></span>
                            </div>
                            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                <i class="material-icons">search</i>
                                <div class="ripple-container"></div>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
</body>
<script src="{{ URL::asset('bassets/js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('bassets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('bassets/js/material.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('bassets/js/chartist.min.js') }}"></script>
<script src="{{ URL::asset('bassets/js/arrive.min.js') }}"></script>
<script src="{{ URL::asset('bassets/js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ URL::asset('bassets/js/bootstrap-notify.js') }}"></script>
<script src="{{ URL::asset('bassets/js/material-dashboard.js?v=1.2.0') }}"></script>
<script src="{{ URL::asset('bassets/js/demo.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.material.min.js"></script>
@yield('js')
<script type="text/javascript">
    $(document).ready(function() {
        demo.initDashboardPageCharts();
    });
</script>
</html>