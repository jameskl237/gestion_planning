<!DOCTYPE html>
<html lang="en">


<!-- navbar.html  21 Nov 2019 03:51:03 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Planning_UYI</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/prism/prism.css') }}">

    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('assets/img/favicon.ico') }}' />

    @yield('style')
</head>


<body class="{{ Auth::user()->color }}">


    <div class="loader" style="display: none;"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar"
                                class="nav-link nav-link-lg
                                collapse-btn"> <i
                                    data-feather="align-justify"></i></a>
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
                    <ul class="navbar-nav navbar-right">
                        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                                class="nav-link notification-toggle nav-link-lg" aria-expanded="false"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-bell bell">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                </svg>
                            </a>
                            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                                <div class="dropdown-header">
                                    Notifications
                                    <div class="float-right">
                                        <a href="#">Mark All As Read</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @php
                            if (Auth::user()) {
                                $im = Auth::user()->image;
                            } else {
                                $im = 'public\template\assets\img\banner\1.png';
                            }
                        @endphp
                        <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image"
                                    src="images/{{ $im }}" class="user-img-radious-style"> <span
                                    class="d-sm-none d-lg-inline-block"></span></a>
                            <div class="dropdown-menu dropdown-menu-right pullDown">
                                <div class="dropdown-title">{{ Auth::user()->name }}</div>
                                <a href="{{ route('profil') }}" class="dropdown-item has-icon"> <i class="farfa-user"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"> <i
                                        class="fas fa-sign-out-alt"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                </div>
            </nav>
        </div>
        <div class="main-sidebar sidebar-style-2">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="{{ route('welcome') }}"> <img alt="image"
                            src="{{ asset('assets/img/banner/1.png') }}" class="header-logo" /> <span
                            class="logo-name">Plannings</span>
                    </a>
                </div>
                <ul class="sidebar-menu">
                    <li><a class="nav-link" href="{{ route('welcome') }}"><i
                                data-feather="home"></i><span>Dashbord</span></a></li>
                    <li class="{{ Request::is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('welcome') }}" class="nav-link">
                            <i data-feather="list"></i>
                            <span> Liste des Taches</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-briefcase">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2">
                                </rect>
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                            </svg><span>Plannifier</span></a>
                        <ul class="dropdown-menu" style="display: none;">
                            <li><a class="nav-link" href="{{ route('plannings') }}">Planning Cours & TD</a></li>
                            <li><a class="nav-link" href="{{ route('eval') }}">Planning evaluation</a></li>
                        </ul>
                    </li>
                    <li class="{{ Request::is('notification') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('notif') }}"><i data-feather="plus"></i><span>Notifications</span></a>
                    </li>
                    <li class="{{ Request::is('programmer') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('programmer') }}"><i data-feather="home"></i><span>Programmer</span></a>
                    </li>
                    <li><a class="{{ Request::is('info') ? 'active' : '' }}" href="{{ route('info') }}"><i
                                data-feather="list"></i><span>Liste personnelle</span></a>
                    </li>
                    <li class="{{ Request::is('profil') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('profil') }}"><i data-feather="user"></i><span>Profil</span></a></li>
                    <li class="{{ Request::is('calendar') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('calendar') }}"><span><i data-feather="calendar"></i>
                                Calendrier</span></a></li>
                    <li><a class="nav-link" href=""><span></span></a></li>
                    <li><a class="nav-link" href=""><span></span></a></li>
                    <li><a class="nav-link" href=""><span></span></a></li>
                    <li><a class="nav-link" href=""><span></span></a></li>
                    <li><a class="nav-link" href=""><span></span></a></li>
                </ul>
            </aside>
        </div>

        <!-- Main Content -->
        <div class="main-content">

            @yield('content')

        </div>
        <div class="settingSidebar">
            <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
            </a>
            <div class="settingSidebar-body ps-container ps-theme-default">
                <div class=" fade show active">
                    <div class="setting-panel-header">Setting Panel
                    </div>
                    <div class="p-15 border-bottom">
                        <h6 class="font-medium m-b-10">Select Layout</h6>
                        <div class="selectgroup layout-color w-50">
                            <label class="selectgroup-item">
                                {{-- value="1" --}}
                                <input type="radio" name="color1" value="light"
                                    class="selectgroup-input-radio select-layout" checked>
                                <span class="selectgroup-button">Light</span>
                            </label>
                            <label class="selectgroup-item">
                                {{-- value="2" --}}
                                <input type="radio" name="color1" value="dark"
                                    class="selectgroup-input-radio select-layout">
                                <span class="selectgroup-button">Dark</span>
                            </label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <h6 class="font-medium m-b-10">Sidebar Color</h6>
                        <div class="selectgroup selectgroup-pills sidebar-color">
                            <label class="selectgroup-item">
                                {{-- value="1" --}}
                                <input type="radio" name="color2" value="light-sidebar"
                                    class="selectgroup-input select-sidebar">
                                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                    data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                            </label>
                            <label class="selectgroup-item">
                                {{-- value="2" --}}
                                <input type="radio" name="color2" value="dark-sidebar"
                                    class="selectgroup-input select-sidebar" checked>
                                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                    data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                            </label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <h6 class="font-medium m-b-10">Color Theme</h6>
                        <div class="theme-setting-options">
                            <ul class="choose-theme list-unstyled mb-0" id="theme">
                                <li title="white" class="active">
                                    <div class="white"></div>
                                    {{-- <div class="white"><input type="radio" id="color_theme" name="theme"
                                                value="theme-white" class="selectgroup-input select-sidebar" checked>
                                        </div> --}}
                                </li>
                                <li title="cyan" value="theme-cyan">
                                    <div class="cyan"></div>
                                    {{-- <div class="cyan"><input type="radio" name="color3" id="color_theme"
                                                value="theme-cyan" class="selectgroup-input select-sidebar"></div> --}}
                                </li>
                                <li title="black" value="theme-black">
                                    <div class="black"></div>
                                    {{-- <div class="black"><input type="radio" name="color3" id="color_theme"
                                                value="theme-black" class="selectgroup-input select-sidebar"></div> --}}
                                </li>
                                <li title="purple" value="theme-purple">
                                    <div class="purple"></div>
                                    {{-- <div class="purple"><input type="radio" name="color3" id="color_theme"
                                                value="theme-purple" class="selectgroup-input select-sidebar">
                                        </div> --}}
                                </li>
                                <li title="orange" value="theme-orange">
                                    <div class="orange"></div>
                                    {{-- <div class="orange"><input type="radio" name="color3" id="color_theme"
                                                value="theme-orange" class="selectgroup-input select-sidebar">
                                        </div> --}}
                                </li>
                                <li title="green" value="theme-green">
                                    <div class="green"></div>
                                    {{-- <div class="green"><input type="radio" name="color3" id="color_theme"
                                                value="theme-green" class="selectgroup-input select-sidebar"></div> --}}
                                </li>
                                <li title="red" value="theme-red">
                                    <div class="red"></div>
                                    {{-- <div class="red"><input type="radio" name="color3" id="color_theme"
                                                value="theme-red" class="selectgroup-input select-sidebar"></div> --}}
                                </li>
                            </ul>
                            <input type="hidden" id="color_theme_id" value="">
                        </div>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" onclick="choisir()" tabindex="4">
                        appliquer
                    </button>
                </div>
                <div class="p-15 border-bottom">
                    <div class="theme-setting-options">
                        <label class="m-b-0">
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                id="mini_sidebar_setting">
                            <span class="custom-switch-indicator"></span>
                            <span class="control-label p-l-10">Mini Sidebar</span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <div class="theme-setting-options">
                        <label class="m-b-0">
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                id="sticky_header_setting">
                            <span class="custom-switch-indicator"></span>
                            <span class="control-label p-l-10">Sticky Header</span>
                        </label>
                    </div>
                </div>
                <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                    <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                        <i class="fas fa-undo"></i> Restore Default
                    </a>
                </div>
                <input type="hidden" id="affichageConcatenation" name="">
                <div class="form-group">

                </div>
            </div>
        </div>

    </div>
    <footer class="main-footer">
        <div class="footer-left">
            <a href="templateshub.net">Planning_UYI</a>
        </div>
        <div class="footer-right">
        </div>
    </footer>
    <!-- General JS Scripts -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('assets/bundles/prism/prism.js') }}"></script>

    <!-- Custom JS File -->
    <script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/export-tables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/export-tables/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/export-tables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/export-tables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/export-tables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/bundles/editable-table/mindmup-editabletable.js') }}"></script>
    <script src="{{ asset('assets/js/page/editable-table.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/export-tables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/datatables.js') }}"></script>
    <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/sweetalert.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @stack('script_other')
    <script>
        function getRadioValue(radios) {
            for (var i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    return radios[i].value;
                }
            }
            // return 'light';
        }

        function getRadioVal(radios) {
            for (var i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    return radios[i].value;
                }
            }
            // return 'light-sidebar';
        }

        function choisir() {

            var layout = document.getElementsByName('color1');
            var sidebar = document.getElementsByName('color2');
            var theme = document.getElementById('color_theme_id');

            var choix = getRadioValue(sidebar);
            var choice = getRadioValue(layout);
            var cho = theme.value;
            if (cho === '') {
                cho = 'theme-white';
            }

            $.ajax({
                url: 'api/color',
                method: 'POST',
                data: {
                    layout: choice,
                    sidebar: choix,
                    theme: cho,
                    user_id: '{{ Auth::user()->id }}'
                },
                success: function(response) {
                    console.log(response);
                    if (response == 'ok') {
                        location.reload();
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    </script>
</body>


<!-- navbar.html  21 Nov 2019 03:51:03 GMT -->

</html>
