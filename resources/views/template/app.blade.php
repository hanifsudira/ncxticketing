<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ URL::asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/pace/pace.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/alertifyjs/css/alertify.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/alertifyjs/css/themes/bootstrap.css') }}">
    @yield('css')
    <style>
        .pace .pace-progress {
            background: #29d;
            position: fixed;
            z-index: 2000;
            top: 0;
            right: 100%;
            width: 100%;
            height: 2px;
        }
        textarea { 
            resize: vertical; 
        }
    </style>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>
<body class="hold-transition fixed skin-black-light sidebar-mini" style="height: auto; min-height: 100%;"">
<div class="wrapper">
    <header class="main-header">
        <a href="{{route('home')}}" class="logo">
            <span class="logo-mini"><b>DIT</b></span>
            <span class="logo-lg">NCX <b>Ticketing</b></span>
        </a>

        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="user-header">
                        <p>
                          {{ Auth::user()->name }}
                          <small>{{ Auth::user()->username }}</small>
                        </p>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="#" class="btn btn-default btn-flat">Change Password</a>
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('logout') }}"
                                class="btn btn-default btn-flat"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                    @if(Auth::user()->role == 1)
                        @include('admin.menu')
                    @else
                        @include('user.menu')
                    @endif
            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
        @yield('content')
    </div>
    <footer class="main-footer">
        <strong>Made With Love By Divisi IT - <a href="http://telkom.co.id" target="_blank">Telkom Indonesia</a></strong>
    </footer>

    <aside class="control-sidebar control-sidebar-dark">
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
    </aside>
    <div class="control-sidebar-bg"></div>
</div>
</body>
</body>
<script src="{{ URL::asset('assets/plugins/alertifyjs/alertify.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ URL::asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/pace/pace.min.js') }}"></script>
<script src="{{ URL::asset('assets/dist/js/app.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('assets/dist/js/demo.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gojs/1.7.22/go-debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gojs/1.7.22/go.js"></script>
@yield('js')
</html>