<nav class="navbar navbar-expand-lg navbar-light shadow-sm p-2 {{app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}">
    <div class="container-fluid">
        <a class="navbar-brand" href="/index"><img src="{{ asset('/HandicraftsAuction/image/auction.PNG') }}"
                width="50px" height="50px" alt="" class="p-0">&nbsp;&nbsp;{{ __('HandicraftsAuction')}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex">
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/index">{{ __('Home')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about_us">{{ __('About')}}</a>
                    </li>

                    @if (auth()->user() && Auth::user()->role->name === 'Buyer')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('buyer.ordered_products') }}">{{ __('MyOrders')}}</a>
                        </li>
                    @elseif(auth()->user() && Auth::user()->role->name === "Craftsman")
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('craftsman.ordered_products') }}">{{ __('MyOrderedProducts')}}</a>
                        </li>
                    @endif

                    @auth
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->role->name === 'Admin')
                                    <a class="dropdown-item" href="{{ route('admin_dashboard') }}">
                                        {{ __('control panel') }}
                                    </a>
                                @else
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        {{ __('My Profile') }}
                                    </a>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout.custom') }}">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('show_multiguard_login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('show_roleto_register') }}">{{ __('Register') }}</a>
                        </li>

                    @endauth

                    {{-- <li class="nav-item dropdown ">
                        <a class=" nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" data-hover="dropdown"
                            data-close-others="true">
                                {{ app()->getLocale() == 'en' ? 'english' : 'العربية' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default p-1" style=" min-width: 5rem; !important">
                            <li >
                                <a href="{{ route('language.change', ['lang' => 'ar']) }}">
                                    {{ __('arabic')}}
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('language.change', ['lang' => 'en']) }}">
                                    {{ __('english')}}
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</nav>
