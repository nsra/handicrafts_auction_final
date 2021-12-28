@extends('layouts.main_layout')

@section('content')

    @if ((auth()->user() && auth()->user()->role_id == 1) || (auth()->user() && auth()->user()->role_id == 2))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>You are not allowed to bidding!</strong> Create a buyer account to order products.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="Product_details">
        <h2 class="p-3">Product Details</h2>
        <br>
        <div class="container">
            <div class="content-product_details">
                <div class="row">
                    <div class="col-4">
                        <div class="d-flex text-center ">
                            <h2>{{ $product->title }}</h2>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="d-flex text-center ">
                            @if (!$product->isExpired())
                                <div id="countdown" class="salse timer text-center"></div>
                            @else
                                <div class="salse text-center">Expired</div>

                                @php
                                    $product->order_by_auction();
                                @endphp
                            @endif
                        </div>
                    </div>

                    <div class="col-3">
                        @if ($product->isAuctioned())
                            <div class="form-group ">
                                <h5 for="orderNowPrice"><b>{{ __('Max Bid') }}:</b> {{ $product->maxBidPrice() }}$</h5>
                                <button class="btn btn-default" data-value="{{ $product->id }}" style="margin-top: 1%">
                                    OrderNow:{{ $product->orderNowPrice }}<i class="fas fa-dollar-sign"></i>
                                </button>
                            </div>
                        @else
                            <div class="form-group ">
                                <h5 for="orderNowPrice">{{ __('Starting Bid Price') }}: {{ $product->startingBidPrice() }}$
                                </h5>
                                <button class="btn btn-default" data-value="{{ $product->id }}" style="margin-top: 1%">
                                    OrderNow:{{ $product->orderNowPrice }}<i class="fas fa-dollar-sign"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="col-3">
                        @if (auth()->user() && $product->isOrderedByMy())
                            <button class="btn btn-warning btn-lg"
                                style="background-color: #ffbb00; color:black; width:65.5%"
                                onclick="window.location='{{ route('buyer.ordered_products') }}'">
                                You Ordered This Product By: {{ $product->order->price }}$
                            </button>
                        @elseif(auth()->user() && auth()->user()->id == $product->user_id && !$product->is_delete &&
                            !$product->isAuctioned())
                            <div>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;
                                <button onclick="window.location='{{ route('craftsman.product.edit', $product->id) }}'"
                                    class="btn-sm btn btn-dark" data-value="{{ $product->id }}">
                                    <i class="far fa-edit fa-2x"></i>
                                </button>
                                <a data-toggle="modal" class="btn btn-danger btn-sm" id="smallButton"
                                    data-target="#smallModal"
                                    data-attr="{{ route('craftsman.product.delete_out', $product->id) }}"
                                    title="Delete Product">
                                    <i class="fas fa-trash fa-2x"></i>
                                </a>

                            </div>
                        @elseif(auth()->user() && auth()->user()->id == $product->user_id )
                            <button class="btn btn-warning btn-lg"
                                style="background-color: #ffbb00; color:black; width:65.5%"
                                onclick="window.location='{{ route('craftsman.products') }}'">
                                Your Product: OrderNowPrice {{ $product->orderNowPrice }}$
                            </button>
                        @elseif($product->is_delete==0)
                            <button class="btn btn-warning btn-lg"
                                style="background-color: #ffbb00; color:black; width:65.5%"
                                onclick="window.location='{{ route('buyer.order_now', $product->id) }}'">
                                Order Now: {{ $product->orderNowPrice }}$
                            </button>
                        @elseif($product->is_delete!=0)
                        <button class="btn btn-dark btn-lg"
                            style="color:white; width:65.5%"
                            >
                            in-active now : {{ $product->orderNowPrice }}$
                        </button>
                    @endif
                    </div>
                </div>


                <div class="row">
                    <div class="col-5">
                        <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @if ($product->images->count() > 0)
                                    @foreach ($product->images as $image)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ asset($image->path) }}" class="card-img-top" alt="..."
                                                height="550px">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <div class="col-7 description-product">

                        <p for="orderNowPrice"><b>{{ __('Category') }}:</b> {{ $product->category->name }}</p>
                        <p>{{ $product->description }}</p>
                        <br>
                        <span>
                            CraftsmanInfo : <br><br><a
                                href="{{ auth()->user() && auth()->user()->id == $product->user_id ? route('craftsman_profile.edit') : route('product.craftsman', $product->id) }}">{{ $product->user->username }}
                            </a>
                            <u> {{ $product->user->email }}</u>
                            &nbsp;&nbsp; mobile: {{ $product->user->mobile }}
                        </span>
                        <br><br>
                        <p class="mt-3 three_part">Free Shipping <span>|</span>&nbsp;Returns accepted <span>|</span>
                            Dilivery:during 3
                            hours</p>
                    </div>


                </div>
                <div class="row">
                    {{-- @if (!$product->id_delete) --}}
                    @if ((!auth()->user() && $product->is_delete == 0) || (auth()->user() && auth()->user()->role_id == 3 && !$product->isOrderedByMy() && $product->is_delete == 0) || (auth()->user() && auth()->user()->id != $product->user_id && $product->is_delete == 0))
                        <h2 style="margin-top: 4%">Place A Bid On This Product</h2>
                        <hr>
                        <br>
                        <form action="{{ route('buyer.store_placed_bid', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <label>Bid Price</label>
                            <input type="number" class="@error('price') is-invalid @enderror" name="price"
                                style="width: 18%" min="{{ ($product->isAuctioned() ? $product->maxBidPrice() + $product->bidIncreament(): $product->startingBidPrice()) }}"
                                placeholder="min value accepted: {{ ($product->isAuctioned() ? $product->maxBidPrice() + $product->bidIncreament(): $product->startingBidPrice()) }}$">
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label style="margin-left: 4%">Bid description</label>
                            <textarea class=" @error('description') is-invalid @enderror" name="description"
                                placeholder="enter bid description here"></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            @if (auth()->user() && $product->bids->contains('user_id', Auth::user()->id))
                                <button class="btn text-center"
                                    disabled
                                    style="background-color: #ffbb00; color:black; ">
                                    You Bid!
                                </button>
                            @else
                                <button type="submit" class="btn text-center btn-warning"
                                    onclick="window.location='{{ route('buyer.place_bid', $product->id) }}'"
                                    style="background-color: #ffbb00; color:black; ">
                                    Place Bid
                                </button>
                            @endif
                        </form>
                    @endif
                    {{-- @endif --}}

                </div>

            </div>
            <h4 style="margin-top: 4%; margin-bottom: 4%">Bids On This Product:{{ $bids->count() }}</h4>
            
            <div>
                @if ($bids->count() > 0)
                    @foreach ($bids as $bid)
                        <div class="row">
                            <div class="col-2">
                                <h4>{{ $bid->user->username }}</h4>
                            </div>

                            <div class="col-2">
                                <h6>{{ $bid->price }}$</h6>
                            </div>
                            <div class="col-2">
                                <p>
                                    {{ $bid->description }}
                                </p>
                            </div>
                            @if(auth()->user() && ($bid->user->id == auth()->user()->id) && !$product->isOrdered())
                                <div class="col-1">
                                    <a data-toggle="modal" class="btn btn-lg" id="smallButton" data-target="#smallModal"
                                        data-attr="{{ route('buyer.bid.delete', $product->authUserBidId()) }}" title="Delete Bid">
                                        <i class="fa fa-trash text-danger fa-lg"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <br>
                        <br>
                    @endforeach
                    <br>
                    <br>
                    <div class="text-center">
                        {{ $bids->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection

<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onClick="window.location.reload();"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="smallBody">
                <div>
                    <!-- the result to be displayed apply here -->
                </div>
            </div>
        </div>
    </div>
</div>
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

        function removeBackdrop() {
            $('.modal-backdrop').remove();
        }
        $(document).on('click', '#smallButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
    </script>

@endsection
