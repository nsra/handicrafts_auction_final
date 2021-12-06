
@extends('base_layout._layout')

@section('body')
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Product Details') }}</h3>
                </div>
                <div class="card-body">
                        <div class="form-group " style="text-align: center">
                            <div class="fileinput required fileinput required-new" data-provides="fileinput required">
                                <div class="fileinput required-preview thumbnail" data-trigger="fileinput required" style="width: 200px;">
                                        {{-- <img src="{{$product->getImage()}}" alt=""> --}}
                                        <img src="{{asset('/HandicraftsAuction/image/wool.jpg')}}" width="150px" class="p-1">
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <label for="title">{{__('Auction Timer')}} </label>
                            @if($product->isExpired())
                            <div class="salse">Expired</div>
                            @else 
                            <div id="countdown" class="salse timer"></div>
                            @endif                        
                        </div>
                        
                        <div class="form-group">
                            <label for="title">{{__('title')}} </label>
                            <input required type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $product->title }}">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="orderNowPrice">{{__('orderNowPrice')}}</label>
                            <input required type="text" class="form-control @error('orderNowPrice') is-invalid @enderror" name="orderNowPrice" value="{{ $product->orderNowPrice }}$">
                            @error('orderNowPrice')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        @if($product->isAuctioned())
                        <div class="form-group">
                            <h6 for="orderNowPrice">{{__('Max Bid')}}: {{$product->maxBidPrice()}}$</h6>
                        </div>
                        @else
                        <div class="form-group">
                            <h2 for="orderNowPrice">{{__('Starting Bid Price')}}: {{$product->startingBidPrice()}}$</h2>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="description">{{__('description')}} </label>
                            <textarea required type="text" class="form-control text-left @error('description') is-invalid @enderror" name="description" value="{{ $product->description }}">
                                {{$product->description }}
                            </textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group text-left" >
                            <label for="category_id" >{{__('Choose_Category')}} </label>
                             <select name="category_id" id="category_id">
                                 <option value=""> {{__('Options')}} </option>
                                 @foreach($categories as $category)
                                     <option value="{{$category->id}}" {{ $category->id == $product->category->id ? "selected" : "" }}> {{$category->name}} </option>
                                 @endforeach
                             </select>
                        </div>
                        <div class="form-group">
                            <h6 for="orderNowPrice">{{__('BidIncreament')}}: {{$product->bidIncreament()}}</h6>
                                <br>
                        {{-- </div>
                        <div class="form-action text-center"> --}}
                            @if($product->isAuctioned())
                            <a href="{{route('admin.product.bids', $product->id)}}" name="cancel"
                                class="btn btn-warning">{{__('Product Bids')}}:{{$product->bids->count()}}</a>
                            @endIf
                            <a href="{{route('products.index')}}" name="cancel"
                                class="btn btn-default">{{__('cancel')}}</a>
                        </div>
                        <br>
                       
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
        var days        = Math.floor(seconds/24/60/60);
        var hoursLeft   = Math.floor((seconds) - (days*86400));
        var hours       = Math.floor(hoursLeft/3600);
        var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
        var minutes     = Math.floor(minutesLeft/60);
        var remainingSeconds = seconds % 60;
        function pad(n) {
          return (n < 10 ? "0" + n : n);
        }
        document.getElementById('countdown').innerHTML = pad(days) + ":" + pad(hours) + ":" + pad(minutes) + ":" + pad(remainingSeconds);
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
