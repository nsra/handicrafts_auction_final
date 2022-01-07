@extends('base_layout._layout')
@section('style')
    <style>
        .item {
            color: #666;
            background: #333;
            height: auto;
            width: auto;
            line-height: 300px;
            /* Align the text vertically center. */
            font-size: 52px;
            text-align: center;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        .carousel {
            margin-top: 20px;
        }

        .carousel-control {
            top: 50%;

            /* border 3px, size 40px */
            border: 3px solid #fff;
            -webkit-border-radius: 23px;
            -moz-border-radius: 23px;
            border-radius: 23px;

            width: 40px;
            height: 100px;
            margin-top: -20px;
            font-size: 60px;
            font-weight: 100;
            line-height: 25px;
            color: #fff;
            text-align: center;
            opacity: .5;
            filter: alpha(opacity=50);
        }

        .bs-example {
            margin: 20px;
        }

        /* cancel background image gradient */
        .carousel-control.left-flat {
            right: auto;
            left: 15px;
        }

        /* override background image gradient */
        .carousel-control.right-flat {
            right: 15px;
            left: auto;
        }

    </style>
@endsection
@section('body')
    <div class="row">
        <div class="col-md-11">
            <div class="card container-fluid">
                <div class="card-header">
                    <h3>{{ __('Order Details') }}</h3>
                </div>
                <div class="card-body">

                    <div class="form-group text-center">
                        <div class="col-sm-12">
                            <div class="bs-example" style="width: 50%">
                                <div id="myCarousel" class="carousel slide">
                                    <!-- Carousel indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                        <li data-target="#myCarousel" data-slide-to="2"></li>
                                    </ol>
                                    <!-- Carousel items -->
                                    <div class="carousel-inner">
                                        @foreach ($product->images as $image)
                                            <div class="item {{ $loop->first ? 'active' : '' }}">
                                                <img src="{{ asset($image->path) }}" class="card-img-top" alt="...">
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Carousel nav --> <a class="carousel-control left-flat" href="#myCarousel"
                                        data-slide="prev">&lsaquo;</a>
                                    <a class="carousel-control right-flat" href="#myCarousel" data-slide="next">&rsaquo;</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <h1>Product</h1>
                        <h4><b>{{ __('Title') }}:</b> {{ $product->title }} </h4>
                        <h4><b>{{ __('OrderNowPrice') }}:</b> {{ $product->orderNowPrice }}$ </h4>
                        @if ($product->isAuctioned())
                            <div class="form-group">
                                <h4 for="orderNowPrice"><b>{{ __('Max Bid') }}:</b> {{ $product->maxBidPrice() }}$</h4>
                            </div>
                        @else
                            <div class="form-group">
                                <h4 for="orderNowPrice"><b>{{ __('Starting Bid Price') }}:</b> {{ $product->startingBidPrice() }}$
                                </h4>
                            </div>
                        @endif
                        <h4><b>{{ __('description') }}:</b> {{ $product->description }} </h4>
                        <h4><b>{{ __('category') }}:</b> {{ __($product->category->name) }} </h4>
                        <hr>
                        <h1>Buyer</h1>
                        <div class="form-group container-image-profile text-center" style="width: 140px;">
                            <img src="{{asset($buyer->image)}}" class="card-img-top" alt="...">
                        </div>
                        <h4><b>{{ __('Username') }}:</b> {{ $buyer->username }} </h4>
                        <h4><b>{{ __('firstName') }}:</b> {{ $buyer->firstName }} </h4>
                        <h4><b>{{ __('lastName') }}:</b> {{ $buyer->lastName }} </h4>
                        <h4><b>{{ __('email') }}:</b> {{ $buyer->email }} </h4>
                        <h4><b>{{ __('mobile') }}:</b> {{ $buyer->mobile }} </h4>
                        <h4><b>{{ __('address') }}:</b> {{ $buyer->address }} </h4>
                        <hr>

                        <h1>Craftsman</h1>
                        <div class="form-group container-image-profile text-center" style="width: 140px;">
                            <img src="{{asset($craftsman->image)}}" class="card-img-top" alt="...">
                        </div>
                        <h4><b>{{ __('Username') }}:</b> {{ $craftsman->username }} </h4>
                        <h4><b>{{ __('firstName') }}:</b> {{ $craftsman->firstName }} </h4>
                        <h4><b>{{ __('lastName') }}:</b> {{ $craftsman->lastName }} </h4>
                        <h4><b>{{ __('email') }}:</b> {{ $craftsman->email }} </h4>
                        <h4><b>{{ __('mobile') }}:</b> {{ $craftsman->mobile }} </h4>
                        <h4><b>{{ __('address') }}:</b> {{ $buyer->address }} </h4>
                        <hr>

                        @if ($product->isAuctioned())
                            <h1>Product Bids</h1>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped table-condensed flip-content">
                                    <thead class="flip-content">
                                        <tr>
                                            <th class="text-center">{{ __('price') }}</th>
                                            <th class="text-center">{{ __('description') }}</th>
                                            <th class="text-center">{{ __('created at') }}</th>
                                            <th class="text-center">{{ __('buyer') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bids as $bid)
                                            <tr>
                                                <td class="text-center">{{ $bid->price }}</td>
                                                <td class="text-center">{{ $bid->description }}</td>
                                                <td class="text-center">{{ $bid->created_at }}</td>
                                                <td class="text-center">{{ $bid->user->username }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        @endif
                    </div>
                </div>
            </div>


            <div class="input-form text-center">
                <a class="btn btn-lg btn-primary" href="{{ route('orders.index') }}">{{ __('Cancel')}}</a>
            </div>

        </div>
    </div>


@endsection
