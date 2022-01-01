@extends('layouts.main_layout')
@section('content')
    <div class="confirmOrder">
        <h2 class="p-3">Checkout Your Order</h2>
        <br>
        <div class="container">
            <div class="content-confirmeOrder">
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

                            @php
                                $product->order_by_auction();
                            @endphp
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
                      <br>
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

                @if (auth()->user() && $product->isOrderedByMy())
                    <div class="text-center">
                        <br>
                        <button class="btn btn-warning btn-lg" style="background-color: #ffbb00; color:black;"
                            onclick="window.location='{{ route('index') }}'">
                            You Ordered This product By: {{ $product->order->price }}$
                        </button>
                    </div>
                @else
                    <h2 style="margin-top: 4%; margin-bottom:3%">Confirm Your Order</h2>
                    <br>
                    <div class="row">
                        <div class="col-2">
                            <h6 class="ml-5" style="margin-left: 0; padding-left: 0">
                                {{ auth()->user()->username }}</h6>
                        </div>
                        <div class="col-5 dddress-confirmeOrder">
                            <h6>Your Address:
                                {{ auth()->user()->address }}</h6>
                        </div>
                        <div class="col-4">
                            <span>
                                Your Mobile :{{ auth()->user()->mobile }}
                            </span>
                        </div>
                        <br>

                        <div class="col-4">
                            <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                            <a class="btn btn-lg " target="_blank" href="{{ route('buyer_profile.edit') }}"
                                style="background-color: #ffbb00; color:black"><i class="fas fa-pen"></i> Update Your
                                Information</a>
                        </div>

                    </div>
                    <br>
                    <form action="{{ route('buyer.store_order_now', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        <input type="checkbox" required>
                        <span>I pledge to deliver the order price upon receipt</span>
                        <br>
                        <div class="text-center">
                            <br>

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <button type="submit" class="btn btn-warning btn-lg"
                                style="background-color: #ffbb00; color:black;"
                                {{ $product->isOrdered() ? 'disabled' : '' }}>
                                Deliver Now</button>
                            @if ($product->isOrdered())
                                <button class="btn btn-default btn-lg">
                                    The Product Has Blocked</button>
                            @endif
                        </div>
                    </form>

                    <br>
                    <hr>
                    <br>
                @endif
                <h4>Bids On This Product:{{ $bids->count() }}</h4>
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
                            @if(auth()->user() && $bid->user->id == auth()->user()->id && !$product->isOrdered())
                                <div class="col-2">
                                it's Your Bid
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
