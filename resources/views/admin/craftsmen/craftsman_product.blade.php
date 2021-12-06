
@extends('base_layout._layout')

@section('body')
    <div class="row">

        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('product') }}: {{$product->user->username}}</h3>
                    <hr>
                </div>
                <div class="card-body">
                        {{-- <div class="form-group " style="text-align: center">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                        <img src="{{$admin->getImage()}}" alt="">
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-group text-center">
                            <label for="title">{{__('Auction Timer')}} </label>
                            @if(!$product->isExpired())
                            <div id="countdown" class="salse timer text-center"></div>
                            @else 
                            <div class="salse text-center">Expired</div>
                              @php 
                                $product->order_by_auction()
                              @endphp
                            @endif                       
                        </div>
                        
                        <div class="form-group">
                            <label for="title">{{__('title')}} </label>
                            <input type="text" class="form-control" name="title" value="{{ $product->title }}">
                        </div>
                        <div class="form-group">
                            <label for="orderNowPrice">{{__('orderNowPrice')}}</label>
                            <input type="text" class="form-control" name="orderNowPrice" value="{{ $product->orderNowPrice }}$">
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('description')}} </label>
                            <input type="text" class="form-control" name="description" value="{{ $product->description }}">
                        </div>
                        <div class="form-group">
                            <label for="category">{{__('category')}} </label>
                            <input type="text" class="form-control" name="category" value="{{ $product->category->name }}">
                        </div>
                        @if($product->isAuctioned())
                        <div class="form-group">
                            <h4 for="orderNowPrice">{{__('Max Bid')}}: {{$product->maxBidPrice()}}$</h4>
                        </div>
                        @else
                        <div class="form-group">
                            <h4 for="orderNowPrice">{{__('Starting Bid Price')}}: {{$product->startingBidPrice()}}$</h4>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="bidIncreament">{{__('bid Increament')}} </label>
                            <input type="text" class="form-control" name="bidIncreament" value="{{ $product->bidIncreament() }}$">
                        </div>
                        <div class="form-action text-left">
                            <a href="{{route('admin.craftsman.product.bids', $product->id)}}" type="reset" name="bids"
                               class="btn btn-primary">{{__('Show product Bids')}}</a>
                        </div>
                        <div class="form-action text-center">
                            <a href="{{route('admin.craftsman.products', $craftsman->id)}}" name="cancel"
                               class="btn btn-default">{{__('cancel')}}</a>
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





