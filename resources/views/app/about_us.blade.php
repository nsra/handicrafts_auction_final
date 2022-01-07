@extends('layouts.main_layout')
@section('content')
    <div class="about_us">
        <div class="container">
            <div class="title">
                <h1>{{ __('Handicrafts Auction')}}</h1>
            </div>
            <div class="content_about mt-3">
                <br>
                <div class="goal">
                    <h3>{{ __('Goals')}}</h3>
                    <i class="fas fa-check fa-1x"></i>
                    <span>{{ __('Get rid of the boring routine used to sell your handmades')}}</span><br>
                    <i class="fas fa-check "> </i>
                    <span>{{ __('Achieve the highest possible profit for your handicrafts through the auction')}}</span><br>
                    <i class="fas fa-check "> </i>
                    <span>{{ __('Be Distinguished by ordering and possessing the most attractive and unique items')}}</span><br>
                    <i class="fas fa-check "> </i>
                    <span>{{ __('Ordering products by ease around the clock.')}}</span><br>
                    <i class="fas fa-check "></i>
                    <span>{{ __('Save Your marketing time.')}}</span><br>
                </div>
                <br>
                <div class="category mt-3">
                    <h3>{{ __('Handicrafts Auction Categories')}}</h3>
                    <p>{{ __('The Handicrafts Auction products contains twelve static categories')}}</p>
                    <div class="row">
                        <div class="col-3">
                            <div class="card" style="margin-bottom: 5%!important">
                                <img src="{{ asset('/HandicraftsAuction/image/painting.jfif') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-text text-center">{{ __('paintings')}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <img src="{{ asset('/HandicraftsAuction/image/paper.jfif') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-text text-center">{{ __('paper')}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card ">
                                <img src="{{ asset('/HandicraftsAuction/image/embroideries.jfif') }}"
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-text text-center">{{ __('embroideries')}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <img src="{{ asset('/HandicraftsAuction/image/wool.jpg') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-text text-center">{{ __('wool')}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="card">
                                <img src="{{ asset('/HandicraftsAuction/image/wood.jfif') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-text text-center">{{ __('wood')}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <img src="{{ asset('/HandicraftsAuction/image/beads.jfif') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-text text-center">{{ __('beads')}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card ">
                                <img src="{{ asset('/HandicraftsAuction/image/natural.jfif') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-text text-center">{{ __('natural resources')}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <img src="{{ asset('/HandicraftsAuction/image/Leather.jfif') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-text text-center">{{ __('leather')}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="card">
                                <img src="{{ asset('/HandicraftsAuction/image/plastic.jfif') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-text text-center">{{ __('plastic')}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <img src="{{ asset('/HandicraftsAuction/image/glass.jfif') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-text text-center">{{ __('glass')}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card ">
                                <img src="{{ asset('/HandicraftsAuction/image/clay.jfif') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-text text-center">{{ __('clay')}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <img src="{{ asset('/HandicraftsAuction/image/metals.jfif') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-text text-center">{{ __('metals')}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="use mt-4">
                    <h3>{{ __('How To Use HandicraftsAuction')}}</h3>
                    <br>
                    <div class="card mb-3" style="max-width: 1000px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('/HandicraftsAuction/image/craftsman.PNG') }}"
                                    class="img-fluid rounded-start" style=" display: block;
                                    margin-left: auto;
                                    margin-right: auto;
                                    width: 50%;" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title">{{ __('Register as Craftsman')}}</h4>
                                    <p class="card-text"> {{ __('By registering as a crafttsman you can add your handmade product for sale (ordered) by auction, or by a high OrderNow Price. you cant order a product with craftsman role, create buyer account to bid or order products')}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3" style="max-width: 1000px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('/HandicraftsAuction/image/buyer.PNG') }}"
                                    class="img-fluid rounded-start" style=" display: block;
                                    margin-left: auto;
                                    margin-right: auto;
                                    width: 50%;" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title">{{ __('Register as Buyer')}}</h4>
                                    <p class="card-text">{{ __('By registering as a buyer you can order-now and place bidds to order products by auction, after you success orderring aproduct you have to confirm its shipping from your orders panel you cant list your own products with buyer role, creat buyer account to list your handmades.')}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="Future mt-5">
                    <h3>{{ __('Handicrafts Auction Features')}}</h3>
                    <br>
                    <i class="fas fa-check fa-2x">
                    </i> <span>{{ __('Free shipping.')}}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="fas fa-check fa-2x">
                    </i><span>{{ __('Return acceptance.')}}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="fas fa-check fa-2x">
                    </i> <span>{{ __('Delivary druing 3 hour.')}}</span>
                </div>
                <div class="our-team mt-4">
                    <br>
                    <h3>{{ __('Handicrafts Auction Team')}}</h3>
                    <br>
                    <div class="row">
                        <div class="col ">
                            <div class="card" style="width: 300px; margin-left: 230px;">
                                <img src="{{ asset('/HandicraftsAuction/image/entesar.jpeg') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h4 class="card-text text-center"> Entesar Khaled ElBanna </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card" style="width: 300px;">
                                <img src="{{ asset('/HandicraftsAuction/image/Amany.jfif') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h4 class="card-text text-center">Amany Fadel Herez</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="concact-us mt-5 mb-3">
                    <h3>{{ __('Contact Us')}}</h3>
                    <a>AmanyHerez2000@gmail.com</a>
                    <span> {{ __('or')}} </span>
                    <a>entesar.2000banna@gmail.com</a>
                </div>
            </div>
        </div>
    </div>
@endsection
