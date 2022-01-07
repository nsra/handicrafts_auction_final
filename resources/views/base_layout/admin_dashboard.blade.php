<!DOCTYPE html>

<html lang="en" class="ie8 no-js">

<head>

    @include('base_layout.components.header.header_meta')

    @yield('style')
    <style>
        .avocode {
            display: flex;
            align-items: center;
            justifycontent: center;
            padding: auto
        }

        .text-right {
            text-align: center !important;
        }

        .borderd {
            border: solid black;
        }

    </style>
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">
        @includeIf('base_layout.components.header.header')
        <div class="clearfix"></div>
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
                            {{ session('error') }}
                        </div>
                    @elseif(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @yield('breadcrumb')

                    @yield('body')
                    <div class="row col-12 avocode">
                        {{-- <img src="{{asset('/control/assets/layouts/layout/img/topTech.png')}}" alt="logo" width="50px" style="margin-top:7%" height="33px" class="logo-default"/> --}}
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="panel panel-primary">
                                <div class="panel-heading {{app()->getLocale() == 'en' ? '' : 'text-right' }}">
                                    <h2 class="panel-title " style="font-size: 28px">{{ __('Quick Statistic    -    Handicrafts Auction ') }}
                                        <i class="fa fa-gavel"></i>
                                    </h2>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <br>
                                        <br>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-xs-6 text-center">
                                                    <a class="btn btn-default" href="{{ route('roles.index') }}">{{ __('Roles:')}}
                                                        {{ $roles }}</a>
                                                </div>

                                                <div class="col-xs-6 text-left">
                                                    &nbsp;
                                                    <button class="btn btn-default" disabled>{{ __('Bids:')}}
                                                        {{ $bids }}</a>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <hr>
                                            <div class="form-action md-2 ">
                                                <div class="col-xs-6 text-center">
                                                    <a class="btn btn-default"
                                                        href="{{ route('categories.index') }}">{{ __('Ctegories:')}}
                                                        {{ $categories }}</a>
                                                </div>
                                                <div class="col-xs-6  text-left">
                                                    <a class="btn btn-default"
                                                        href="{{ route('buyers.index') }}">{{ __('Buyers:')}}
                                                        {{ $buyers }}</a>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <hr>
                                            <div class="form-action md-2">
                                                <div class="col-xs-6  text-center">
                                                    <a class="btn btn-default" href="{{ route('products.index') }}">{{ __('Products:')}} {{ $products }}</a>
                                                </div>
                                                <div class="col-xs-6  text-left">
                                                    <a class="btn btn-default" href="{{ route('orders.index') }}">{{ __('Orders: ')}}{{ $orders }}</a>
                                                </div>
                                                <br>
                                                <br>
                                                <hr>
                                            </div>
                                            <div class="form-action md-2">
                                                <div class="col-xs-10 text-center">
                                                    <a class="btn btn-default"
                                                        href="{{ route('craftsmen.index') }}">{{ __('Craftsmen:')}}
                                                        {{ $craftsmen }}</a>
                                                </div>
                                                <br>
                                                <br>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

</body>

</html>
