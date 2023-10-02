<!DOCTYPE html>
<html lang="en">


<!-- navbar.html  21 Nov 2019 03:51:03 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>TodoList</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <link rel='shortcut icon' type='image/x-icon' href='{{ asset('assets/img/favicon.ico') }}' />
</head>

<body>
    <div class="loader"></div>
        <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
                <nav class="navbar navbar-expand-lg main-navbar sticky">
                    <div class="form-inline mr-auto">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
                                collapse-btn"> <i data-feather="align-justify"></i></a>
                            </li>
                            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a></li>
                            <li>
                               @yield('search_bar')
                            </li>
                        </ul>
                    </div>
                    <div class="navbar-nav ms-auto mb-2 mb-lg-0">

                    </div>
                </nav>
            </div>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                  <div class="sidebar-brand">
                    <a href="{{ route('welcome') }}"> <img alt="image" src="{{ asset('assets/img/banner/1.png') }}" class="header-logo" /> <span
                        class="logo-name">My TodoList</span>
                    </a>
                  </div>
                  <ul class="sidebar-menu">
                        <li class="dropdown">
                            <a href="{{route('welcome')}}" class="nav-link"><i data-feather="monitor"></i><span> List of Tasks</span></a>
                        </li>
                        <li><a class="nav-link" href="{{route('create')}}"><i  data-feather="plus"></i><span>Add Task</span></a></li>
                        <li><a class="nav-link" href="{{route('logout')}}"><i data-feather="log-out"></i><span>logout</span></a></li>
                  </ul>
                </aside>
            </div>
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    <a href="templateshub.net">Templateshub</a>
                </div>
                <div class="footer-right">
                </div>
            </footer>
        </div>
    </div>
  <!-- General JS Scripts -->
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>


<!-- navbar.html  21 Nov 2019 03:51:03 GMT -->
</html>
