<!DOCTYPE html>
<html lang="{{app()->getLocale() }}" dir="{{app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}">

<head>
    @include('base_layout.components.header.header_meta')
    @yield('header')
    @yield('style')
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white {{app()->getlocale()== 'en' ? 'ltr': 'rtl'}}">
    <div id="app">
        <div class="page-wrapper">

            @includeIf('base_layout.components.header.header')
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"></div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    @includeIf('base_layout.components.nav')
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->

                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">

                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ __(session('error')) }}
                            </div>
                        @elseif(session('success'))
                            <div class="alert alert-success">
                                {{ __(session('success')) }}
                            </div>
                        @endif

                        @yield('breadcrumb')
                        @yield('body')
                        <!-- END PAGE HEADER-->
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END CONTAINER -->
            <!-- BEGIN FOOTER -->
            @includeIf('base_layout.components.footer.footer')
            <!-- END FOOTER -->
        </div>
        <!-- BEGIN QUICK NAV -->

        <!-- END QUICK NAV -->


        <!-- FOOTER META STARTS -->
        @includeIf('base_layout.components.footer.footer_meta')
        <!-- FOOTER META ENDS -->
        @yield('script')
    </div>
</body>

</html>
