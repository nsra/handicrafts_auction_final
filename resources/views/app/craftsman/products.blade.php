@extends('layouts.main_layout')
@section('content')
 <!-- start My Products -->
 <div class="MyProduct">
    <div class="container container-myProduct">
      <h2 class="mt-2">My Products</h2>
      <div class="form group mt-4 mb-3">
        <form action="{{route('craftsman.products')}}" method="GET">
          <input name="name" size="40"  value="{{app('request')->get('name')}}" class="" type="search" placeholder="Search for Product by name or price">
          <button type="submit" class="btn btn-light">
          <span><i class="fas fa-search fa-2x"></i></span>
          </button>
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a class="btn btn-lg btn-warning" href="{{route('craftsman.auctioned_products', $user->id)}}" style="color:black">Filter Auctioned Products</a>
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
           <a class="btn btn-lg btn-warning" href="{{route('craftsman.product.create')}}" style="color:black">Create New Product</a>
        </form> 
      </div>
      <hr>
      <div class="my-product-content">
        @foreach($products as $product)
        <div class="row ">
          <div class="col-2">
            <img src="{{asset('/HandicraftsAuction/image/wool.jpg')}}" width="150px" height="100px" class="p-1">
          </div>
          <div class="col-3">
            <h4>{{$product->title}}</h4>
          </div>
          <div class="col-2">
            <h2>{{$product->orderNowPrice}}$</h2>
          </div>
          <div class="col-1">
            @if($product->bids->count() > 0)

            <a href="{{route('craftsman.product.bids', $product->id)}}" class="btn btn-secondary">
              product bids: {{$product->bids->count()}}
            </a>
            @else
             No Bids
            @endif
          </div>
        
          @if(!$product->isAuctioned())
          <div class="col-1">
            <a href="{{route('craftsman.product.edit', $product->id)}}" class="btn btn-dark" data-value="{{$product->id}}">
              <i class="far fa-edit"></i>
            </a>
          </div>
          <div class="col-1">
 
            <a data-toggle="modal" class="btn btn-lg" id="smallButton" data-target="#smallModal" data-attr="{{ route('craftsman.product.delete', $product->id) }}" title="Delete Bid">
              <i class="fa fa-trash text-danger fa-lg"></i>
            </a>  
          </div>
          @else 
          <div class="col-1">
            <h4><a href="{{route('craftsman.product.bids', $product->id)}}">{{$product->bids->count()}}Bids</a></h4>
          </div>
          @endif
        </div>
        @endforeach
        {{-- <div class="row">
          <div class="col-2">
            <img src="{{asset('/HandicraftsAuction/image/wool.jpg')}}" width="150px" height="100px" class="p-1">
          </div>
          <div class="col-5">
            <h6>Attractive embroidered Fleece Scarf</h6>
          </div>
          <div class="col-2">
            <h2>86$</h2>
          </div>
          <div class="col-1"></div>
          <div class="col-1"><i class="fas fa-eye fa-2x"></i></div>
          <div class="col-1"></div>
        </div>
        <div class="row ">
          <div class="col-2">
            <img src="{{asset('/HandicraftsAuction/image/wool.jpg')}}" width="150px" height="100px" class="p-1">
          </div>
          <div class="col-5">
            <h6>Attractive embroidered Fleece Scarf</h6>
          </div>
          <div class="col-2">
            <h2>11$</h2>
          </div>
          <div class="col-1"></div>
          <div class="col-1"><i class="fas fa-eye fa-2x"></i></div>
          <div class="col-1"></div>
        </div>
        <div class="row">
          <div class="col-2">
            <img src="{{asset('/HandicraftsAuction/image/wool.jpg')}}" width="150px" height="100px" class="p-1">
          </div>
          <div class="col-5">
            <h6>Attractive embroidered Fleece Scarf</h6>
          </div>
          <div class="col-2">
            <h2>27$</h2>
          </div>
          <div class="col-1"></div>
          <div class="col-1"><i class="fas fa-eye fa-2x"></i></div>
          <div class="col-1"></div>
        </div> --}}

      </div>

    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    {{$products->links('pagination::bootstrap-4')}}

  </div>
  <!-- end my product -->
  <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="removeBackdrop()" data-dismiss="modal" aria-label="Close">
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
@endsection


