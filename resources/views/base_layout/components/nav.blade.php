<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<div class="page-sidebar navbar-collapse collapse {{app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}">

    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
        data-slide-speed="200" style="padding-top: 20px">
        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-tasks"></i>
                <span class="title">{{ __('Orders') }}</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item start ">
                    <a href="{{ route('orders.index') }}" class="nav-link ">
                        <i class="fa fa-list"></i>
                        <span class="title">{{ __('Show') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-tasks"></i>
                <span class="title">{{ __('Products') }}</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item start ">
                    <a href="{{ route('products.index') }}" class="nav-link ">
                        <i class="fa fa-list"></i>
                        <span class="title">{{ __('Show') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-tasks"></i>
                <span class="title">{{ __('Categories') }}</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item start ">
                    <a href="{{ route('categories.index') }}" class="nav-link ">
                        <i class="fa fa-list"></i>
                        <span class="title">{{ __('Show') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-users"></i>
                <span class="title">{{ __('Craftsmen') }}</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item start ">
                    <a href="{{ route('craftsmen.index') }}" class="nav-link ">
                        <i class="fa fa-list"></i>
                        <span class="title">{{ __('Show') }}</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-users"></i>
                <span class="title">{{ __('Buyers') }}</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item start ">
                    <a href="{{ route('buyers.index') }}" class="nav-link ">
                        <i class="fa fa-list"></i>
                        <span class="title">{{ __('Show') }}</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa  fa-caret-square-o-down  "></i>
                <span class="title">{{ __('Roles') }}</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item start ">
                    <a href="{{ route('roles.index') }}" class="nav-link ">
                        <i class="fa fa-list"></i>
                        <span class="title">{{ __('Show') }}</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
</div>
