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
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('product') }}: {{ $product->user->username }}</h3>
                    <hr>
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
                    <div class="form-group ">
                        <label for="title">{{ __('Auction Timer') }} </label>
                        @if (!$product->isExpired())
                            <div id="countdown" class="salse timer "></div>
                        @else
                            <div class="salse ">Expired</div>
                            @php
                                $product->order_by_auction();
                            @endphp
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="title">{{ __('title') }} </label>
                        <input type="text" class="form-control" name="title" value="{{ $product->title }}">
                    </div>
                    <div class="form-group">
                        <label for="orderNowPrice">{{ __('orderNowPrice') }}</label>
                        <input type="text" class="form-control" name="orderNowPrice"
                            value="{{ $product->orderNowPrice }}$">
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('description') }} </label>
                        <input type="text" class="form-control" name="description" value="{{ $product->description }}">
                    </div>
                    <div class="form-group">
                        <label for="category">{{ __('category') }} </label>
                        <input type="text" class="form-control" name="category" value="{{ $product->category->name }}">
                    </div>
                    @if ($product->isAuctioned())
                        <div class="form-group">
                            <h4 for="orderNowPrice">{{ __('Max Bid') }}: {{ $product->maxBidPrice() }}$</h4>
                        </div>
                    @else
                        <div class="form-group">
                            <h4 for="orderNowPrice">{{ __('Starting Bid Price') }}: {{ $product->startingBidPrice() }}$
                            </h4>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="bidIncreament">{{ __('bid Increament') }} </label>
                        <input type="text" class="form-control" name="bidIncreament"
                            value="{{ $product->bidIncreament() }}$">
                    </div>
                    <div class="form-action text-left">
                        <a href="{{ route('admin.craftsman.product.bids', $product->id) }}" type="reset" name="bids"
                            class="btn btn-primary">{{ __('Show product Bids') }}</a>
                    </div>
                    <div class="form-action text-center">
                        <a href="{{ route('admin.craftsman.products', $craftsman->id) }}" name="cancel"
                            class="btn btn-default">{{ __('cancel') }}</a>
                    </div>
                </div>
            </div>
            <br>
            <br>
        </div>
    </div>


@endsection


@section('script')
    <script>
        var upgradeTime = {!! json_encode($product->remainingTime(), JSON_HEX_TAG) !!};
        var seconds = upgradeTime;

        function timer() {
            var days = Math.floor(seconds / 24 / 60 / 60);
            var hoursLeft = Math.floor((seconds) - (days * 86400));
            var hours = Math.floor(hoursLeft / 3600);
            var minutesLeft = Math.floor((hoursLeft) - (hours * 3600));
            var minutes = Math.floor(minutesLeft / 60);
            var remainingSeconds = seconds % 60;

            function pad(n) {
                return (n < 10 ? "0" + n : n);
            }
            document.getElementById('countdown').innerHTML = pad(days) + ":" + pad(hours) + ":" + pad(minutes) + ":" + pad(
                remainingSeconds);
            if (seconds == 0) {
                clearInterval(countdownTimer);
                document.getElementById('countdown').innerHTML = "Expired";
                location.reload();

            } else {
                seconds--;
            }
        }
        var countdownTimer = setInterval('timer()', 1000);
    </script>

@endsection
