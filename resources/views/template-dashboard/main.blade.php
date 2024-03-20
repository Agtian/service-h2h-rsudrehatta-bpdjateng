<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('asset/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('asset/img/favicon.png') }}">
    <title>
      Argon Dashboard 2 by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('asset/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('asset/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('asset/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
    @livewireStyles
    @include('sweetalert::alert')
    @stack('style')
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
        @if (Auth::user()->level_user == 1)
            @include('template-dashboard.inc.sidebar.sidebar-user')
        @elseif (Auth::user()->level_user == 2)
            @include('template-dashboard.inc.sidebar.sidebar-admin')
        @else
            @include('template-dashboard.inc.sidebar.sidebar-account-not-active')
        @endif
    </aside>
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        @include('template-dashboard.inc.navbar')
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            @yield('content')
            <div class="row mt-4">
                @include('template-dashboard.inc.footer')
            </div>
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="{{ asset('asset/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('asset/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/chartjs.min.js') }}"></script>


    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
              damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('asset/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
    @livewireScripts
    @stack('script')
</body>

</html>
