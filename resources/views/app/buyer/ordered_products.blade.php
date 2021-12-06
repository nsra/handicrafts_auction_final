@extends('layouts.main_layout')
@section('content')
 <!-- start My Products -->
 <div class="MyProduct">
    <div class="container container-myProduct">
      <h2 class="mt-2">Ordered Products</h2>
      <div class="form group mt-4 mb-3">
        <form action="{{route('buyer.ordered_products')}}" method="GET">
          <input name="name" size="66" value="{{app('request')->get('name')}}" type="search" placeholder="Search for Order by product title">
          <button type="submit" class="btn btn-light">
          <span><i class="fas fa-search fa-2x"></i></span>
          </button>
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
          <a class="btn btn-lg  btn-warning" href="{{route('buyer.bids')}}" style="color:black">All Bids</a>
        </form> 
      </div>
      <hr>
      <div class="my-product-content">
        @foreach($products as $product)
        @if($product->isOrderedByMy())
        <div class="row ">
          <div class="col-2">
            <a href="{{route('buyer.product.show', $product->id)}}">
              <h5>{{$product->title}}</h5>
            </a>
            <img src="{{asset('/HandicraftsAuction/image/wool.jpg')}}" width="150px" height="100px" class="p-1">
          </div>
          <div class="col-3">
            <h5>ProductOwner:<a href="{{route('buyer.product.user', $product->order->id)}}">{{$product->user->username}}</h5></a>
          </div>
          <div class="col-2">
            <h5>OrderPrice:{{$product->order->price}}$</h5>
          </div>
          <div class="col-3">
            <h5>OrderDate:{{$product->order->created_at}}</h5>
          </div>
          <div class="col-1">
           
          
            <a data-toggle="modal" class="btn  btn-success" id="smallButton" data-target="#smallModal" data-attr="{{ route('buyer.order.delete', $product->order->id) }}" title="Converm Product Delivary">
              Confirm Delivary <i class="fa fa-check "></i>
            </a>  
          </div>
        </div>
        @endif
        <br>
        @endforeach
      </div>

    </div>
    <br>
    <br>
    <br>
    <br>
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


        
