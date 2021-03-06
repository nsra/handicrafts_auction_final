@extends('layouts.main_layout')
@section('style')
    <style>
        input[type="file"] {
            display: block;
        }

        .imageThumb {
            height: 300px;
            width: 200px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }

        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }

        .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
        }

        .remove:hover {
            background: white;
            color: black;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Product Details') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <form action="{{ route('craftsman.product.update', $product->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form group text-center" id="products_slider" style="display:flex; justify-content: center">
                                    <div style="width: 80%; " id="carouselExampleControlsNoTouching" class="carousel slide"
                                        data-ride="carousel">
                                        <div class="carousel-inner">
                                            @if ($product->images->count() > 0)
                                                @foreach ($product->images as $image)
                                                    <div
                                                        class="carousel-item {{ $loop->first ? 'active' : '' }} text-center">
                                                        <img src="{{ asset($image->path) }}" class="card-img-top"
                                                            alt="..." width="70" height="500">
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
                                <br>
                                <br>
                                <label for="image">{{ __('Edit Product images')}}</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mt-1 text-center">
                                            <input type="file" id="images" name="images[]" class="@error('title') is-invalid @enderror" placeholder="Choose images" multiple accept="image/*">
                                        </div>
                                      
                                    </div>
                                </div>
                                @error('images')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __($message) }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <div class="form-group ">
                                    <div class="form-group">
                                        @if (!$product->isAuctioned())
                                            <a data-toggle="modal" class="btn btn-lg" id="smallButton"
                                                data-target="#smallModal"
                                                data-attr="{{ route('craftsman.product.delete', $product->id) }}"
                                                title="Delete Product">
                                                <i class="fa fa-trash text-danger fa-lg"></i> &nbsp; {{ __('Delete Your Product')}}
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="title">{{ __('title') }} </label>
                                    <input required type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ $product->title }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="orderNowPrice">{{ __('orderNowPrice') }}</label>
                                    <input required type="text"
                                        class="form-control @error('orderNowPrice') is-invalid @enderror"
                                        name="orderNowPrice" value="{{ $product->orderNowPrice }}">
                                    @error('orderNowPrice')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <h6 for="orderNowPrice">{{ __('Starting Bid Price') }}:
                                        {{ $product->startingBidPrice() }} $</h6>
                                </div>
                                <div class="form-group ">
                                    <label for="description">{{ __('description') }}</label> 
                                    <textarea required type="text" 
                                        class="{{app()->getLocale() == 'en' ? '' : 'text-right' }} form-control @error('description') is-invalid @enderror"
                                        name="description" >
                                            {{ $product->description }}
                                        </textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
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
                                                {{ __($category->name) }} </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @if ($product->isAuctioned())
                                    <div class="form-group">
                                        <h4 for="orderNowPrice">{{ __('Max Bid') }}: {{ $product->maxBidPrice() }}$</h4>
                                    </div>
                                {{-- @else
                                    <div class="form-group">
                                        <h4 for="orderNowPrice">{{ __('Starting Bid Price') }}:
                                            {{ $product->startingBidPrice() }}$</h4>
                                    </div> --}}
                                @endif
                                <div class="form-group">
                                    <h6 for="orderNowPrice">{{ __('BidIncreament') }}: {{ $product->bidIncreament() }}$
                                    </h6>
                                    <br>
                                    {{-- </div>
                                <div class="form-action text-center"> --}}
                                    @if (!$product->isAuctioned() && !$product->isOrdered())
                                        <button type="submit" class="btn btn-warning">{{ __('Update') }}</button>
                                    @else
                                        <a href="{{ route('craftsman.product.bids', $product->id) }}" name="cancel"
                                            class="btn btn-warning">{{ __('Product Bids') }}:{{ $product->bids->count() }}</a>
                                    @endIf
                                    <a href="{{ route('craftsman.products', $craftsman->id) }}" name="cancel"
                                        class="btn btn-secondary">{{ __('cancel') }}</a>
                                </div>
                                <br>
                                <div class="form-action text-center">

                                </div>
                            </form>
                        </div>
                        <div class="col-4 text-center">
                            <label for="title">{{ __('Auction Timer') }} </label>
                            @if (!$product->isExpired())
                                <div id="countdown" class=""></div>
                            @else
                                <div>{{ __('Expired')}}</div>

                                @php
                                    $product->order_by_auction();
                                @endphp
                            @endif
                            <br>
                            <form action="{{ route('craftsman.product.extend_auction', $product->id) }}" method="GET">
                                <label for="">{{ __('Extend Auction')}}</label>
                                <input required type="number" max="15" min="1" placeholder="{{ __('Enter number of days to extend auction')}}"
                                    name="days" style="width:92%">
                                <br>
                                <br>
                                <button type="submit" class="btn btn-secondary" {{$product->isOrdered()? 'disabled':''}}>{{ __('extend auction') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
        </div>
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

        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#images").on("change", function(e) {
                    $("#products_slider").hide();
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result +
                                "\" title=\"" + file.name + "\" />" +
                                "<br /><button class=\"remove\">Remove image</span>" +
                                "</span>").insertAfter("#images");
                            $(".remove").click(function() {
                                $(this).parent(".pip").remove();
                            });
                        });
                        fileReader.readAsDataURL(f);
                    }
                    console.log(files);
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });

    </script>

@endsection
