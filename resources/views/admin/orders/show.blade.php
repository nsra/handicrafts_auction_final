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
                        <h4>{{ __('Title') }}: {{ $product->title }} </h4>
                        <h4>{{ __('OrderNowPrice') }}: {{ $product->orderNowPrice }}$ </h4>
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
                        <h4>{{ __('description') }}: {{ $product->description }} </h4>
                        <h4>{{ __('category') }}: {{ $product->category->name }} </h4>
                        <hr>
                        <h1>Buyer</h1>
                        <h4>{{ __('Username') }}: {{ $buyer->username }} </h4>
                        <h4>{{ __('firstName') }}: {{ $buyer->firstName }} </h4>
                        <h4>{{ __('lastName') }}: {{ $buyer->lastName }} </h4>
                        <h4>{{ __('email') }}: {{ $buyer->email }} </h4>
                        <h4>{{ __('mobile') }}: {{ $buyer->mobile }} </h4>
                        <h4>{{ __('address') }}: {{ $buyer->address }} </h4>
                        <hr>

                        <h1>Craftsman</h1>
                        <h4>{{ __('Username') }}: {{ $craftsman->username }} </h4>
                        <h4>{{ __('firstName') }}: {{ $craftsman->firstName }} </h4>
                        <h4>{{ __('lastName') }}: {{ $craftsman->lastName }} </h4>
                        <h4>{{ __('email') }}: {{ $craftsman->email }} </h4>
                        <h4>{{ __('mobile') }}: {{ $craftsman->mobile }} </h4>
                        <h4>{{ __('address') }}: {{ $buyer->address }} </h4>
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
                <a class="btn btn-lg btn-primary" href="{{ route('orders.index') }}">Cancel</a>
            </div>

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
            } else {
                seconds--;
            }
        }
        var countdownTimer = setInterval('timer()', 1000);

        $('.delete-order').click(function() {
            var id = $(this).data('value')
            swal({
                    title: "Delete order",
                    text: "Are you sure you want to delete order!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "yes",
                    cancelButtonText: "no",
                    closeOnConfirm: false
                },
                function() {
                    /**
                     *
                     * send ajax request for deleting order
                     *
                     */

                    $.ajax({

                        method: 'GET',
                        data: {
                            body: '',
                            _token: '{{ csrf_token() }}'
                        }
                    }).success(function(response) {
                        if (response.status == 200) {
                            swal("@lang('lang.alert')", response.message, "success")
                            window.location.reload()
                        } else {
                            swal("@lang('lang.alert')", response.message, "error")
                        }
                    })
                });
        })
    </script>

@endsection
