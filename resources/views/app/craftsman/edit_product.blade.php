
@extends('layouts.main_layout')
@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Product Details') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('craftsman.product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group " style="text-align: center">
                            <div class="fileinput required fileinput required-new" data-provides="fileinput required">
                                <div class="fileinput required-preview thumbnail" data-trigger="fileinput required" style="width: 200px;">
                                        {{-- <img src="{{$product->getImage()}}" alt=""> --}}
                                        <img src="{{asset('/HandicraftsAuction/image/wool.jpg')}}" width="150px" class="p-1">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">{{__('title')}} </label>
                            <input required type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $product->title }}">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="orderNowPrice">{{__('orderNowPrice')}}</label>
                            <input required type="text" class="form-control @error('orderNowPrice') is-invalid @enderror" name="orderNowPrice" value="{{ $product->orderNowPrice }}$">
                            @error('orderNowPrice')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h6 for="orderNowPrice">{{__('Starting Bid Price')}}: {{$product->startingBidPrice()}}</h6>
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('description')}} </label>
                            <textarea required type="text" class="form-control text-left @error('description') is-invalid @enderror" name="description" value="{{ $product->description }}">
                                {{$product->description }}
                            </textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group text-left" >
                            <label for="category_id" >{{__('Choose_Category')}} </label>
                             <select name="category_id" id="category_id">
                                 <option value=""> {{__('Options')}} </option>
                                 @foreach($categories as $category)
                                     <option value="{{$category->id}}" {{ $category->id == $product->category->id ? "selected" : "" }}> {{$category->name}} </option>
                                 @endforeach
                             </select>
                        </div>
                        <div class="form-group">
                            <h6 for="orderNowPrice">{{__('BidIncreament')}}: {{$product->bidIncreament()}}</h6>
                                <br>
                        {{-- </div>
                        <div class="form-action text-center"> --}}
                            @if(!$product->isAuctioned())
                            <button type="submit" class="btn btn-warning">{{__('Update')}}</button>
                            @else
                            <a href="{{route('craftsman.product.bids', $product->id)}}" name="cancel"
                                class="btn btn-warning">{{__('Product Bids')}}:{{$product->bids->count()}}</a>
                            @endIf
                            <a href="{{route('craftsman.products', $craftsman->id)}}" name="cancel"
                                class="btn btn-secondary">{{__('cancel')}}</a>
                        </div>
                        <br>
                        <div class="form-action text-center">
                            
                        </div>
                    </form>
                </div>

            </div>
            <br>
            <br>
        </div>
    </div>


@endsection


