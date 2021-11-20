
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
                        <div class="form-group">
                            <label for="bidIncreament">{{__('bid Increament')}} </label>
                            <input type="text" class="form-control" name="bidIncreament" value="{{ $product->bidIncreament }}$">
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


