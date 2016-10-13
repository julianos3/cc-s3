<!DOCTYPE html>
<html class="no-js css-menubar" lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">
    <title>Login | Central Condo</title>

    <link rel="apple-touch-icon" href="{{ asset('portal/assets/images/apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('portal/assets/images/favicon.ico') }}">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('portal/global/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('portal/global/css/bootstrap-extend.min.css') }}">
    <link rel="stylesheet" href="{{ asset('portal/assets/css/site.min.css') }}">
    <!-- Plugins -->
    <link rel="stylesheet" href="{{ asset('portal/global/vendor/animsition/animsition.css') }}">
    <link rel="stylesheet" href="{{ asset('portal/global/vendor/asscrollable/asScrollable.css') }}">
    <link rel="stylesheet" href="{{ asset('portal/global/vendor/switchery/switchery.css') }}">
    <link rel="stylesheet" href="{{ asset('portal/global/vendor/intro-js/introjs.css') }}">
    <link rel="stylesheet" href="{{ asset('portal/global/vendor/slidepanel/slidePanel.css') }}">
    <link rel="stylesheet" href="{{ asset('portal/global/vendor/flag-icon-css/flag-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('portal/assets/examples/css/pages/login-v2.css') }}">
    <link rel="stylesheet" href="{{ asset('portal/assets/examples/css/pages/forgot-password.css') }}">
    <link rel="stylesheet" href="{{ asset('portal/global/vendor/waves/waves.css') }}">
    <link rel="stylesheet" href="{{ asset('portal/assets/examples/css/pages/register-v2.css') }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('portal/global/fonts/material-design/material-design.min.css') }}">
    <link rel="stylesheet" href="{{ asset('portal/global/fonts/web-icons/web-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('portal/global/fonts/brand-icons/brand-icons.min.css') }}">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    <!--[if lt IE 9]>
    <script src="{{ asset('portal/global/vendor/html5shiv/html5shiv.min.js') }}"></script>
    <![endif]-->
    <!--[if lt IE 10]>
    <script src="{{ asset('portal/global/vendor/media-match/media.match.min.js') }}"></script>
    <script src="{{ asset('portal/global/vendor/respond/respond.min.js') }}"></script>
    <![endif]-->
    <!-- Scripts -->
    <script src="{{ asset('portal/global/vendor/modernizr/modernizr.js') }}"></script>
    <script src="{{ asset('portal/global/vendor/breakpoints/breakpoints.js') }}"></script>
    <script>
        Breakpoints();
    </script>
</head>

@yield('content')



<!-- Core  -->
<script src="{{ asset('portal/global/vendor/jquery/jquery.js') }}"></script>
<script src="{{ asset('portal/global/vendor/bootstrap/bootstrap.js') }}"></script>
<script src="{{ asset('portal/global/vendor/animsition/animsition.js') }}"></script>
<script src="{{ asset('portal/global/vendor/asscroll/jquery-asScroll.js') }}"></script>
<script src="{{ asset('portal/global/vendor/mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('portal/global/vendor/asscrollable/jquery.asScrollable.all.js') }}"></script>
<script src="{{ asset('portal/global/vendor/ashoverscroll/jquery-asHoverScroll.js') }}"></script>
<script src="{{ asset('portal/global/vendor/waves/waves.js') }}"></script>
<!-- Plugins -->
<script src="{{ asset('portal/global/vendor/switchery/switchery.min.js') }}"></script>
<script src="{{ asset('portal/global/vendor/intro-js/intro.js') }}"></script>
<script src="{{ asset('portal/global/vendor/screenfull/screenfull.js') }}"></script>
<script src="{{ asset('portal/global/vendor/slidepanel/jquery-slidePanel.js') }}"></script>
<script src="{{ asset('portal/global/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
<!-- Scripts -->
<script src="{{ asset('portal/global/js/core.js') }}"></script>
<script src="{{ asset('portal/assets/js/site.js') }}"></script>
<script src="{{ asset('portal/assets/js/sections/menu.js') }}"></script>
<script src="{{ asset('portal/assets/js/sections/menubar.js') }}"></script>
<script src="{{ asset('portal/assets/js/sections/gridmenu.js') }}"></script>
<script src="{{ asset('portal/assets/js/sections/sidebar.js') }}"></script>
<script src="{{ asset('portal/global/js/configs/config-colors.js') }}"></script>
<script src="{{ asset('portal/assets/js/configs/config-tour.js') }}"></script>
<script src="{{ asset('portal/global/js/components/asscrollable.js') }}"></script>
<script src="{{ asset('portal/global/js/components/animsition.js') }}"></script>
<script src="{{ asset('portal/global/js/components/slidepanel.js') }}"></script>
<script src="{{ asset('portal/global/js/components/switchery.js') }}"></script>
<script src="{{ asset('portal/global/js/components/tabs.js') }}"></script>
<script src="{{ asset('portal/global/js/components/jquery-placeholder.js') }}"></script>
<script src="{{ asset('portal/global/js/components/animate-list.js') }}"></script>
<script src="{{ asset('portal/global/js/components/material.js') }}"></script>
<script>
    (function (document, window, $) {
        'use strict';
        var Site = window.Site;
        $(document).ready(function () {
            Site.run();
        });
    })(document, window, jQuery);
</script>
</body>
</html>