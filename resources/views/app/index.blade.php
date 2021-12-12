@extends('layouts.main_layout')
@section('content')
<div class="sec-nav shadow-sm p-1">
    <div class="container-fluid">
      <header>
       
        <nav class="navbar navbar-expand-lg navbar-light">
          <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#main-nav"
            aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="main-nav">
            <ul class="navbar-nav" style="font-size: 16px">
              
              <li class="nav-item">
                <a class="nav-link" href="/category/1/products" style="margin-left: 40px;">Painting</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/2/products">Paper  &nbsp; </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/3/products">Embroidery  &nbsp; </a>
              <li class="nav-item">
                <a class="nav-link" href="/category/4/products">Wool  &nbsp; </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/5/products">Wood  &nbsp; </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/6/products">Bead  &nbsp; </a>
              <li class="nav-item">
                <a class="nav-link" href="/category/7/products">NaturalResources  &nbsp; </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/8/products">Leather  &nbsp; </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/9/products">Plastic  &nbsp; </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/10/products">Glass  &nbsp; </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/11/products">Clay  &nbsp; </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/category/12/products">Metals  &nbsp; </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
    </div>
  </div>
  <br>
 @if((auth()->user() && auth()->user()->role_id == 1) || (auth()->user() && auth()->user()->role_id == 2))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>You are not allowed to bidding!</strong> Create a buyer account to order products.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
<div class="RecentAuction">
    <div class="container">
      <div class="first-Auction-Recent">
        <form action="{{route('index')}}" method="GET">
          <input type="search" name="title" placeholder="Enter Product name to search with" value="{{app('request')->get('title')}}" class="search">
          <select name="category" id="">
            <option value="">Select category to search with</option>
            @foreach($categories as $category)
            <option value={{$category->id}} {{app('request')->get('category')==$category->id ? 'selected' : ""}}>{{$category->name}}</option>
            @endforeach
          </select>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <label>Price Range</label>
          <input type="number" name="lowPrice" size="10" style="width: 10%" value="{{app('request')->get('lowPrice')}}">
          <span>-</span>
          <input type="number" name="highPrice" size="10" style="width: 10%" value="{{app('request')->get('highPrice')}}">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <button type="submit" class="btn btn-warning">
            <i class="fas fa-search"></i>&nbsp; &nbsp; Filter &nbsp;&nbsp;
          </button>
          <a class="btn btn-secondary"
          href="{{route('index')}}">{{__('Reset')}}</a>
        </form> 
      </div>
      <div class="RecentAuction-content">
        <br>
        <h2 class="p-2">Recent Auctions</h2>
        <div class="row">
          @foreach($products as $product)
          @if($product->is_delete==0)
          <div class="col-3 col-3 mb-4 mt-4">
            <div class="card">
              @if(!$product->isExpired())
              <div id="countdown" class="clock{{ $product->id }} timer text-center"></div>
              <script>
                window.addEventListener('load', function() {
                    var duration{{ $product->id }} = {{$product->remainingTime()}},
                    display = document.querySelector('.clock{{ $product->id }}');
                    startTimer(duration{{ $product->id }}, display);
                });
              </script>
              @else 
              <div id="countdown" class="timer">Expired</div>
             
              {{-- @php 
                $product->order_by_auction()
              @endphp --}}
              @endif
              <a href="{{route('product.details', $product->id) }}">
                <img src="{{asset($product->images->first()->path)}}" class="card-img-top" alt="...">
              </a>
              <div class="card-body">
                <h5 class="text-center">{{$product->title}}</h5>
                <div class="d-flex justify-content-between">
                  <span>${{$product->orderNowPrice}}</span>
                  @if(!auth()->user() || (auth()->user() && auth()->user()->id != $product->user_id))
                  <button class="btn btn-secondary btn-sm" onclick="window.location='{{route('buyer.order_now', $product->id) }}'" >
                    Order Now
                  </button>
                  @elseif(auth()->user() && auth()->user()->id == $product->user_id && !$product->is_delete && !$product->isAuctioned())
                  <div>
                    <button onclick="window.location='{{route('craftsman.product.edit', $product->id)}}'" class="btn btn-dark btn-sm" data-value="{{$product->id}}">
                      <i class="far fa-edit"></i>
                    </button>
                    <a data-toggle="modal" class="btn btn-danger btn-sm" id="smallButton" data-target="#smallModal" data-attr="{{ route('craftsman.product.delete_out', $product->id) }}" title="Delete Product">
                      <i class="fas fa-trash text-danger fa-lg"></i>
                    </a> 
                  </div>
                  @endif
                </div>
                <br>
                @if($product->bids->count() === 0) 
                <p>StartingBid:{{$product->startingBidPrice()}}$</p>
                @else
                <p>MaxBid:{{$product->maxBidPrice()}}$</p>
                @endif
                <button class="btn text-center btn-light">{{$product->bids->count()}} Bids</button>
                @if(auth()->user() && auth()->user()->id == $product->user_id)
                <button class="btn text-center btn-warning" 
                  style="background-color: #ffbb00; color:black; width:65.5%" >
                  Its Your Product!
                </button>
                @elseif(auth()->user() && $product->bids->contains('user_id', Auth::user()->id))
                <button class="btn text-center btn-warning" onclick="window.location='{{route('buyer.product.show', $product->id) }}'" 
                  style="background-color: #ffbb00; color:black; width:65.5%" >
                  You Bid!
                </button>
                @else
                <button class="btn text-center btn-warning" onclick="window.location='{{route('buyer.place_bid', $product->id) }}'" 
                  style="background-color: #ffbb00; color:black; width:65.5%" >
                  Place Bid
                </button>
                @endif
              </div>
            </div>
          </div>
          @endif
          @endforeach
        <br>
    </div>
    <div class="text-center">
      {{$products->links('pagination::bootstrap-4')}}
    </div>
  </div>
  <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onClick="window.location.reload();" aria-label="Close">
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
 function startTimer(seconds, display) {
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
          display.textContent = pad(days) + ":" + pad(hours) + ":" + pad(minutes) + ":" + pad(remainingSeconds);
          if (seconds == 0) {
              display.textContent = "Expired";
              // location.reload();
          } else {
              seconds--;
          }
      };
      timer();
      setInterval(timer, 1000);
    }


    function removeBackdrop(){
        $('.modal-backdrop').remove();
    }
    $(document).on('click', '#smallButton', function(event) {
      event.preventDefault();
      let href = $(this).attr('data-attr');
      $.ajax({
          url: href
          , beforeSend: function() {
              $('#loader').show();
          },
          // return the result
          success: function(result) {
              $('#smallModal').modal("show");
              $('#smallBody').html(result).show();
          }
          , complete: function() {
              $('#loader').hide();
          }
          , error: function(jqXHR, testStatus, error) {
              console.log(error);
              alert("Page " + href + " cannot open. Error:" + error);
              $('#loader').hide();
          }
          , timeout: 8000
      })
  });
</script>
   
  @endsection