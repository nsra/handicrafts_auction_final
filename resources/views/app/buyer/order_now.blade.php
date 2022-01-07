@extends('layouts.main_layout')
@section('content')
    <div class="confirmOrder">
        <h2 class="p-3">{{__('Checkout Your Order')}}</h2>
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
                            <div class="salse text-center">{{ __('Expired')}}</div>

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
                      <div id="carouselExampleControlsNoTouching" class="carousel slide" data-ride="carousel">
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
                          <a class="carousel-control-prev" href="#carouselExampleControlsNoTouching" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleControlsNoTouching" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                      </div>
                  </div>
                  <div class="col-7 description-product">
                      <p for="orderNowPrice"><b>{{ __('Category') }}:</b> {{ __($product->category->name) }}</p>
                      <br>
                      <p>{{ $product->description }}</p>
                      <br>
                      <span>
                            {{ __('CraftsmanInfo:')}} <br><br><a
                              href="{{ auth()->user() && auth()->user()->id == $product->user_id ? route('craftsman_profile.edit') : route('product.craftsman', $product->id) }}">{{ $product->user->username }}
                          </a>
                          <u> {{ $product->user->email }}</u>
                          &nbsp;&nbsp; {{__('mobile:')}} {{ $product->user->mobile }}
                      </span>
                      <br><br>
                      <p class="mt-3 three_part">{{ __('Free Shipping')}} <span>|</span>&nbsp;{{ __('Returns accepted')}} <span>|</span>
                          {{ __('Dilivery:during 3 hours')}} </p>
                  </div>
              </div>

                @if (auth()->user() && $product->isOrderedByMy())
                    <div class="text-center">
                        <br>
                        <button class="btn btn-warning btn-lg" style="background-color: #ffbb00; color:black;"
                            onclick="window.location='{{ route('index') }}'">
                            {{ __('You Ordered This product By:')}} {{ $product->order->price }}$
                        </button>
                    </div>
                @else
                    <h2 style="margin-top: 4%; margin-bottom:3%">{{ __('Confirm Your Personal Info')}}</h2>
                    <br>
                    <div class="row">
                        <div class="col-2">
                            <h6 class="ms-5" style="margin-left: 0; padding-left: 0">
                                {{ auth()->user()->username }}</h6>
                        </div>
                        <div class="col-5 dddress-confirmeOrder">
                            <h6>{{ __('Your Address:')}}
                                {{ auth()->user()->address }}</h6>
                        </div>
                        <div class="col-4">
                            <span>
                                {{ __('Your Mobile:')}}{{ auth()->user()->mobile }}
                            </span>
                        </div>
                        <br>

                        <div class="col-4">
                            <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                            <a class="btn btn-lg " target="_blank" href="{{ route('buyer_profile.edit') }}"
                                style="background-color: #ffbb00; color:black"><i class="fas fa-pen"></i> {{ __('Update Your Information')}}</a>
                        </div>

                    </div>
                    <br>
                    <form action="{{ route('buyer.store_order_now', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        <input type="checkbox" required>
                        <span>{{ __('I pledge to deliver the order price upon receipt')}}</span>
                        <br>
                        <div class="text-center">
                            <br>

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <button type="submit" class="btn btn-warning btn-lg"
                                style="background-color: #ffbb00; color:black;"
                                {{ $product->isOrdered() ? 'disabled' : '' }}>
                                {{ __('Deliver Now')}}
                            </button>
                            @if ($product->isOrdered())
                                <button class="btn btn-default btn-lg">
                                    {{ __('The Product Has Blocked')}}
                                </button>
                            @endif
                        </div>
                    </form>

                    <br>
                    <hr>
                    <br>
                @endif
                <h4>{{ __('Bids On This Product:')}} {{ $bids->count() }}</h4>
                <br>
                @if ($bids->count() > 0)
                    @foreach ($bids as $bid)
                        <div class="row">
                            <div class="col-3">
                                <h3>{{ $bid->user->username }}</h3>
                            </div>
                            <div class="col-1">
                                <h4>{{ $bid->price }}$</h4>
                            </div>
                            <div class="col-4">
                                <h4>
                                    {{ $bid->description }}
                                </h4>
                            </div>
                            <div class="col-2">
                                <a data-toggle="modal" class="btn btn-lg btn-success smallButton" data-target="#smallModal"
                                    data-attr="{{ route('bid.history', $bid->id) }}" title="{{ __('Bid History')}}">
                                      <i class="fa fa-history"> {{ __('Bid History')}}</i>
                                </a>
                            </div>
                            @if(auth()->user() && $bid->user->id == auth()->user()->id && !$product->isOrdered())
                                <div class="col-2">
                                    {{ __('it\'s Your Bid')}}
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
                <br>
                <br>
                <div class="text-center">
                    {{ $bids->links('pagination::bootstrap-4') }}
                </div>
            </div>

        </div>
    </div>

<div class="modal fade" id="smallModal" style="padding: 0 !important" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
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
        function removeBackdrop() {
            $('.modal-backdrop').remove();
        }
        $(document).on('click', '.smallButton', function(event) {
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