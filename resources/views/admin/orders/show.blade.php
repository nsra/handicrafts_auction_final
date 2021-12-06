@extends('base_layout._layout')

@section('body')
    <div class="row">
        <div class="col-md-11">
            <div class="card container-fluid">
                <div class="card-header">
                    <h3>{{ __('Order Details') }}</h3>
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
                        <div class="form-group">
                            <h1>Product</h1>
                            <h4>{{__('Title')}}: {{$product->title}} </h4>
                            <h4>{{__('OrderNowPrice')}}: {{$product->orderNowPrice}}$ </h4>
                            @if($product->isAuctioned())
                            <div class="form-group">
                                <h4 for="orderNowPrice">{{__('Max Bid')}}: {{$product->maxBidPrice()}}$</h4>
                            </div>
                            @else
                            <div class="form-group">
                                <h4 for="orderNowPrice">{{__('Starting Bid Price')}}: {{$product->startingBidPrice()}}$</h4>
                            </div>
                            @endif
                            <h4>{{__('description')}}: {{$product->description}} </h4>
                            <h4>{{__('category')}}: {{$product->category->name}} </h4>
                            <hr>
                            <h1>Buyer</h1>
                            <h4>{{__('Username')}}: {{$buyer->username}} </h4>
                            <h4>{{__('firstName')}}: {{$buyer->firstName}} </h4>
                            <h4>{{__('lastName')}}: {{$buyer->lastName}} </h4>
                            <h4>{{__('email')}}: {{$buyer->email}} </h4>
                            <h4>{{__('mobile')}}: {{$buyer->mobile}} </h4>
                            <h4>{{__('address')}}: {{$buyer->address}} </h4>
                            <hr>

                            <h1>Craftsman</h1>
                            <h4>{{__('Username')}}: {{$craftsman->username}} </h4>
                            <h4>{{__('firstName')}}: {{$craftsman->firstName}} </h4>
                            <h4>{{__('lastName')}}: {{$craftsman->lastName}} </h4>
                            <h4>{{__('email')}}: {{$craftsman->email}} </h4>
                            <h4>{{__('mobile')}}: {{$craftsman->mobile}} </h4>
                            <h4>{{__('address')}}: {{$buyer->address}} </h4>
                            <hr>

                            @if($product->isAuctioned())
                            <h1>Product Bids</h1>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped table-condensed flip-content">
                                    <thead class="flip-content">
                                    <tr>
                                        <th class="text-center">{{__('price')}}</th>
                                        <th class="text-center">{{__('description')}}</th>
                                        <th class="text-center">{{__('created at')}}</th>
                                        <th class="text-center">{{__('buyer')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bids as $bid)
                                        <tr>
                                            <td class="text-center">{{$bid->price}}</td>
                                            <td class="text-center">{{$bid->description}}</td>
                                            <td class="text-center">{{$bid->created_at}}</td>
                                            <td class="text-center">{{$bid->user->username}}</td>
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
                <a class="btn btn-lg btn-primary" href="{{route('orders.index')}}">Cancel</a>
              </div>
             
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
        } else {
          seconds--;
        }
      }
      var countdownTimer = setInterval('timer()', 1000);

        $('.delete-order').click(function () {
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
                function () {
                    /**
                     *
                     * send ajax request for deleting order
                     *
                     */
                     
                    $.ajax({
                    
                        method: 'GET',
                        data: {body: '', _token: '{{csrf_token()}}'}
                    }).success(function (response) {
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





