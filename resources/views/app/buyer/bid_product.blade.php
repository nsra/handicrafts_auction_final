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
                            data-bs-touch="false" data-bs-interval="false">
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
                    <div class="form-group text-center">
                        <label for="title">{{ __('Auction Timer') }} </label>
                        @if (!$product->isExpired())
                            <div id="countdown" class="text-center"></div>
                        @else
                            <div class=" text-center">Expired</div>

                            @php
                                $product->order_by_auction();
                            @endphp
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="title">{{ __('title') }} </label>
                        <input required type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            value="{{ $product->title }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="orderNowPrice">{{ __('orderNowPrice') }}</label>
                        <input required type="text" class="form-control @error('orderNowPrice') is-invalid @enderror"
                            name="orderNowPrice" value="{{ $product->orderNowPrice }}$">
                        @error('orderNowPrice')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <h6 for="orderNowPrice">{{ __('Starting Bid Price') }}: {{ $product->startingBidPrice() }}$</h6>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('description') }} </label>
                        <textarea required type="text"
                            class="form-control text-left @error('description') is-invalid @enderror" name="description"
                            value="{{ $product->description }}">
                                    {{ $product->description }}
                                </textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group text-left">
                        <label for="category_id">{{ __('Choose_Category') }} </label>
                        <select name="category_id" id="category_id">
                            <option value=""> {{ __('Options') }} </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $product->category->id ? 'selected' : '' }}>
                                    {{ $category->name }} </option>
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
                        <a href="{{ route('buyer.product.bids', $product->id) }}" name="cancel"
                            class="btn btn-warning">{{ __('Product Bids') }}:{{ $product->bids->count() }}</a>
                        <a href="{{ route('buyer.bids') }}" name="cancel"
                            class="btn btn-secondary">{{ __('cancel') }}</a>
                    </div>
                    <br>
                    <div class="form-action">
                        @if ($product->isOrderedByMy())
                            <button class="btn btn-success">You Have Ordered this product</button>
                        @elseif ($product->isOrdered())
                            <button class="btn btn-dark">This product is in-active now</button>
                        @elseif($product->authUserBidId() > 0)
                            <div class="form-group">
                                <a data-toggle="modal" class="btn btn-lg" id="smallButton" data-target="#smallModal"
                                    data-attr="{{ route('buyer.bid.delete', $product->authUserBidId()) }}"
                                    title="Delete Bid">
                                    <i class="fa fa-trash text-danger fa-lg"></i>
                                </a>
                                <label for="delete">Delete your bid on this product </label>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <br>
            <br>
        </div>
    </div>
    <div class="text-center ">
        <a href="{{ route('buyer.profile') }}" type="reset" name="cancel" class="btn btn-warning">{{ __('Your profile') }}</a>
    </div>
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick="removeBackdrop()" data-dismiss="modal"
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
