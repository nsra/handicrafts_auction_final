@extends('layouts.main_layout')
@section('content')
    <div class="Product_details">
        <h2 class="p-3">Place Bid</h2>
        <br>
        <div class="container">
            <div class="content-product_details">
                <div class="row">
                    <div class="col-5">
                        <div class="d-flex text-center ">
                            <h2>{{ $product->title }}</h2>
                        </div>

                    </div>
                    <div class="col-2">
                        @if (!$product->isExpired())
                            <div id="countdown" class="salse timer text-center"></div>
                        @else
                            <div class="salse text-center">Expired</div>
                        @endif
                    </div>

                    <div class="col-2">
                        @if ($product->isAuctioned())
                            <div class="form-group ">
                                <h5 for="orderNowPrice"><b>{{ __('Max Bid') }}:</b> {{ $product->maxBidPrice() }}$</h5>
                            </div>
                        @else
                            <div class="form-group ">
                                <h5 for="orderNowPrice">{{ __('Starting Bid Price') }}:
                                    {{ $product->startingBidPrice() }}$
                                </h5>
                            </div>
                        @endif
                    </div>
                    <div class="col-3">
                        @if (auth()->user() && $product->isOrderedByMy())
                            <button class="btn btn-warning btn-lg"
                                style="background-color: #ffbb00; color:black; width:65.5%"
                                onclick="window.location='{{ route('buyer.ordered_products') }}'">
                                You Ordered This Product
                            </button>
                        @elseif(auth()->user() && auth()->user()->id == $product->user_id)
                            <div>
                                <button onclick="window.location='{{ route('craftsman.product.edit', $product->id) }}'"
                                    class="btn btn-dark" data-value="{{ $product->id }}">
                                    <i class="far fa-edit"></i>
                                </button>
                                <button class="btn btn-danger delete-product" data-value="{{ $product->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        @else
                            @if ($product->is_delete == 0)
                                <button class="btn btn-warning btn-lg"
                                    style="background-color: #ffbb00; color:black; width:65.5%"
                                    onclick="window.location='{{ route('buyer.order_now', $product->id) }}'">
                                    Order Now: {{ $product->orderNowPrice }}$
                                </button>
                            @endif
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

                        @if (auth()->user() && auth()->user()->id == $product->user_id)
                            <button class="btn text-center btn-warning" style="background-color: #ffbb00; color:black;">
                                Its Your Product!
                            </button>
                        @elseif(auth()->user() && $product->bids->contains('user_id', Auth::user()->id))
                            <button class="btn text-center btn-warning" disabled
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
                    <br>
                @endif

                <h4 style="margin-top: 3%">Bids On This Product:{{ $bids->count() }}</h4>
                <br>
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
                            @if(auth()->user() && auth()->user()->role_id == 3 && $bid->user->id == auth()->user()->id && !$product->isOrderedByMy())
                                <div class="col-1">
                                    <a data-toggle="modal" class="btn btn-lg" id="smallButton" data-target="#smallModal"
                                        data-attr="{{ route('buyer.bid.delete', $product->authUserBidId()) }}" title="Delete Bid">
                                        <i class="fa fa-trash text-danger fa-lg"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <br>
                    @endforeach
                @endif
                <br>
                <br>
                <div class="text-center">
                    {{ $bids->links('pagination::bootstrap-4') }}
                </div>
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
            document.getElementById('countdown').innerHTML = pad(days) + ":" + pad(hours) + ":" +
                pad(minutes) + ":" + pad(remainingSeconds);
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
