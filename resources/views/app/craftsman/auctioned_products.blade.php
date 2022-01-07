@extends('layouts.main_layout')
@section('content')
    <!-- start My Products -->
    <div class="MyProduct">
        <div class="container container-myProduct">
            <h2 class="mt-2">{{ __('Auctioned (and not ordered yet) Products')}}</h2>
            <div class="form group mt-4 mb-3">
                <form action="{{ route('craftsman.auctioned_products') }}" method="GET">
                    <input name="name" size="66" value="{{ app('request')->get('name') }}" class=""
                        type="search" placeholder="{{ __('Search for Product by name or price')}}">
                    <button type="submit" class="btn btn-light">
                        <span><i class="fas fa-search fa-2x"></i></span>
                    </button>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp;
                  
                    <a class="btn btn-lg  btn-warning" href="{{ route('craftsman.products') }}" style="color:black">
                        {{__('All Products')}}</a>
                </form>
            </div>
            <hr>
            <div class="my-product-content">
                @foreach ($products as $product)
                    @if ($product->isAuctioned() && !$product->isOrdered())
                        <div class="row ">
                            <div class="col-2">
                                <img src="{{ asset($product->images->first()->path) }}" width="150px" height="100px"
                                    class="p-1">
                            </div>
                            <div class="col-3">
                                <h5>{{ $product->title }}</h5>
                            </div>
                            <div class="col-3">
                                <h5>{{ __('maxBidPrice:')}} {{ $product->maxBidPrice() }}$</h5>
                            </div>
                            <div class="col-3">
                                <h5>{{ __('OrderNowPrice:')}} {{ $product->orderNowPrice }}$</h5>
                            </div>
                            <div class="col-1">
                                <a href="{{ route('craftsman.product.edit', $product->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-eye">&nbsp;{{ __('Details')}}</i>
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
        <div class="pagination-content">
            <ul class="pagination">
                <li class="page-item ms-2"><a class="page-link" href="#">&laquo;</a></li>
                <li class="page-item  ms-2"><a class="page-link" href="#" style="background-color: gray;">1</a></li>
                <li class="page-item ms-2"><a class="page-link" href="#">2</a></li>
                <li class="page-item  ms-2"><a class="page-link" href="#">3</a></li>
                <li class="page-item ms-2"><a class="page-link" href="#">4</a></li>
                <li class="page-item ms-2 "><a class="page-link" href="#">5</a>
                </li>
                <li class="page-item ms-2"><a class="page-link" href="#">&raquo;</a></li>
            </ul>
        </div>

    </div>
    <!-- end my product -->
@endsection
