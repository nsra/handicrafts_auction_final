@extends('layouts.main_layout')
@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Product Details') }}</h3>
                </div>
                <div class="card-body">
                    <div class="form group text-center" style="display:flex; justify-content: center">
                        <div style="width: 50%; " id="carouselExampleControlsNoTouching" class="carousel slide"
                            data-ride="carousel">
                            <div class="carousel-inner">
                                @if ($product->images->count() > 0)
                                    @foreach ($product->images as $image)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }} text-center">
                                            <img src="{{ asset($image->path) }}" class="card-img-top" alt="..." width="70"
                                                height="500">
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
                    <div class="form-group text-center">
                        <label for="title">{{ __('Auction Timer') }} </label>
                        @if (!$product->isExpired())
                            <div id="countdown" class="text-center"></div>
                        @else
                            <div class=" text-center">{{__('Expired')}}</div>

                            @php
                                $product->order_by_auction();
                            @endphp
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="title">{{ __('title') }} </label>
                        <input required type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            value="{{ $product->title }}">
                      
                    </div>

                    <div class="form-group">
                        <label for="orderNowPrice">{{ __('orderNowPrice') }}</label>
                        <input required type="text" class="form-control @error('orderNowPrice') is-invalid @enderror"
                            name="orderNowPrice" value="{{ $product->orderNowPrice }}$">
                      
                    </div>
                    <div class="form-group">
                        <h6 for="orderNowPrice">{{ __('Starting Bid Price') }}: {{ $product->startingBidPrice() }}$</h6>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('description') }} </label>
                        <textarea required type="text"
                            class="form-control  @error('description') is-invalid @enderror" name="description"
                            value="{{ $product->description }}">
                                    {{ $product->description }}
                                </textarea>
                      
                    </div>
                    <div class="form-group ">
                        <label for="category_id">{{ __('category') }} </label>
                        <select name="category_id" id="category_id">
                            <option value=""> {{ __('Options') }} </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $product->category->id ? 'selected' : '' }}>
                                    {{ __($category->name) }} </option>
                            @endforeach
                        </select>
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
                        <h6 for="orderNowPrice">{{ __('BidIncreament') }}: {{ $product->bidIncreament() }}$</h6>
                        <br>
                        <a href="{{ route('craftsman.product.bids', $product->id) }}" name="cancel"
                            class="btn btn-warning">{{ __('Product Bids') }}:{{ $product->bids->count() }}</a>
                        <a href="{{ URL::previous() }}" name="cancel"
                            class="btn btn-secondary">{{ __('Go Back') }}</a>
                    </div>
                    <br>
                               
                </div>
            </div>
            <br>
            <br>
        </div>
    </div>
    <div class="text-center ">
        <a href="{{ route('craftsman.profile') }}" type="reset" name="cancel" class="btn btn-warning">{{ __('Your profile') }}</a>
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
