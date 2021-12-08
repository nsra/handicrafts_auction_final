@extends('layouts.main_layout')
@section('content')
    <!-- start My Products -->
    <div class="MyProduct">
        <div class="container container-myProduct">
            <h2 class="mt-2">Craftsman Products</h2>
            <hr>
            <div class="my-product-content">
                @foreach ($products as $product)
                    <div class="row ">
                        <div class="col-2">
                            <img src="{{ asset($product->images->first()->path) }}" width="150px" height="100px"
                                class="p-1">
                        </div>
                        <div class="col-3">
                            <h4>{{ $product->title }}</h4>
                        </div>
                        <div class="col-2">
                            <h2>{{ $product->orderNowPrice }}$</h2>
                        </div>
                        <div class="col-1">
                            <a href="{{ route('product.details', $product->id) }}" class="btn btn-secondary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                        <div class="col-1">

                            @if (auth()->user() && $product->bids->count() > 0 && auth()->user()->role_id == 3)
                                <h4><a
                                        href="{{ route('buyer.product.bids', $product->id) }}">{{ $product->bids->count() }}Bids</a>
                                </h4>
                            @elseif(auth()->user() && $product->bids->count()>0 && auth()->user()->role_id == 2)
                                <h4><a
                                        href="{{ route('craftsman.product.bids', $product->id) }}">{{ $product->bids->count() }}Bids</a>
                                </h4>
                            @else
                                <h4>{{ $product->bids->count() }} Bids</h4>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <br>

        <div class="input-form text-center">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
        <br>
        <div class="input-form text-center">
            <a class="btn btn-lg " href="{{ route('product.details', $product->id) }}"
                style="background-color: #ffbb00; color:black">Cancel</a>
        </div>
    </div>
    <!-- end my product -->
@endsection
