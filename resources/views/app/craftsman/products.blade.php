@extends('layouts.main_layout')
@section('content')
 <!-- start My Products -->
 <div class="MyProduct">
    <div class="container container-myProduct">
      <h2 class="mt-2">My Products</h2>
      <div class="form group mt-4 mb-3">
        <form action="{{route('craftsman.products', $user->id)}}" method="GET">
          <input name="name" class="" type="search" placeholder="Search for Product by name or price">
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
            <a href="{{route('craftsman.product.edit', $product->id)}}" class="btn btn-secondary">
              <i class="fas fa-eye"></i>
            </a>
          </div>

          @if(!$product->isAuctioned())
          <div class="col-1">
            <a href="{{route('craftsman.product.edit', $product->id)}}" class="btn btn-dark" data-value="{{$user->id}}">
              <i class="far fa-edit"></i>
            </a>
          </div>
          <div class="col-1">
            <a  class="btn btn-danger delete-admin" data-value="{{$product->id}}">
              <i class="fas fa-trash-alt"></i>
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
    <div class="pagination-content">
      <ul class="pagination">
        <li class="page-item ml-2"><a class="page-link" href="#" >&laquo;</a></li>
        <li class="page-item  ml-2"><a class="page-link" href="#" style="background-color: gray;">1</a></li>
        <li class="page-item ml-2"><a class="page-link" href="#">2</a></li>
        <li class="page-item  ml-2"><a class="page-link" href="#">3</a></li>
        <li class="page-item ml-2"><a class="page-link" href="#">4</a></li>
        <li class="page-item ml-2 "><a class="page-link" href="#" >5</a>
        </li>
        <li class="page-item ml-2"><a class="page-link" href="#">&raquo;</a></li>
      </ul>
    </div>

  </div>
  <!-- end my product -->
@endsection
@section('script')
    <script>
        $('.delete-admin').click(function () {
            var id = $(this).data('value')
            swal({
                    title: "@lang('lang.questions.confirm_remove')",
                    text: "@lang('admin.questions.do_remove')",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "@lang('lang.yes')",
                    cancelButtonText: "@lang('lang.no')",
                    closeOnConfirm: false
                },
                function () {
                    /**
                     *
                     * send ajax request for deleting admin
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


        
