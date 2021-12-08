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
                            <a href="{{ route('buyer.product.show', $product->id) }}" class="btn btn-secondary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                        <div class="col-1">
                            <h4><a
                                    href="{{ route('buyer.product.bids', $product->id) }}">{{ $product->bids->count() }}Bids</a>
                            </h4>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="input-form text-center">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
        <div class="input-form text-center">
            <a class="btn btn-lg " href="{{ route('buyer.product.craftsman', $user->id) }}"
                style="background-color: #ffbb00; color:black">Cancel</a>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
    <!-- end my product -->
@endsection
