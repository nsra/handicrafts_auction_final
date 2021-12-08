@extends('layouts.main_layout')
@section('content')
    <!-- start My Products -->
    <div class="MyProduct">
        <div class="container container-myProduct">
            <h2 class="mt-2">Ordered Products</h2>
            <div class="form group mt-4 mb-3">
                <form action="{{ route('craftsman.ordered_products') }}" method="GET">
                    <input name="name" size="66" value="{{ app('request')->get('name') }}" type="search"
                        placeholder="Search for Order by product title">
                    <button type="submit" class="btn btn-light">
                        <span><i class="fas fa-search fa-2x"></i></span>
                    </button>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    <a class="btn btn-lg  btn-warning" href="{{ route('craftsman.products') }}" style="color:black">All
                        Products</a>
                </form>
            </div>
            <hr>
            <div class="my-product-content">
                @foreach ($products as $product)
                    @if ($product->isOrdered())
                        <div class="row ">
                            <div class="col-2">
                                <h5>{{ $product->title }}</h5>
                                <br>
                                <img src="{{ asset($product->images->first()->path) }}" width="150px" height="100px"
                                    class="p-1">
                            </div>
                            <div class="col-3">
                                <h5>OrderOwner:<a
                                        href="{{ route('craftsman.product.order.user', $product->order->id) }}">{{ $product->order->user->username }}
                                </h5></a>
                            </div>
                            <div class="col-2">
                                <h5>OrderPrice:{{ $product->order->price }}$</h5>
                            </div>
                            <div class="col-3">
                                <h5>OrderDate:{{ $product->order->created_at }}</h5>
                            </div>
                            <div class="col-1">
                                <a href="{{ route('craftsman.product.edit', $product->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-eye">&nbsp;Details</i>
                                </a>
                            </div>
                        </div>
                    @endif
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
        {{ $products->links('pagination::bootstrap-4') }}

    </div>
    <!-- end my product -->
@endsection
@section('script')
    <script>
        $('.delete-admin').click(function() {
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
                function() {
                    /**
                     *
                     * send ajax request for deleting admin
                     *
                     */

                    $.ajax({

                        method: 'GET',
                        data: {
                            body: '',
                            _token: '{{ csrf_token() }}'
                        }
                    }).success(function(response) {
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
