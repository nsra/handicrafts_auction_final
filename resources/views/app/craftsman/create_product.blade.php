
@extends('layouts.main_layout')
@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Create Product') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('craftsman.product.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group " style="text-align: center">
                            <div class="fileinput required fileinput required-new" data-provides="fileinput required">
                                <div class="fileinput required-preview thumbnail" data-trigger="fileinput required" style="width: 200px; ">
                                        {{-- <img src="{{}}" alt=""> --}}
                                        <img src="{{asset('/HandicraftsAuction/image/wool.jpg')}}" width="150px"  class="p-1">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">{{__('title')}} </label>
                            <input required type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="orderNowPrice">{{__('orderNowPrice')}}</label>
                            <input required type="number" class="form-control @error('orderNowPrice') is-invalid @enderror" name="orderNowPrice" value="{{ old('orderNowPrice') }}">
                            @error('orderNowPrice')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('description')}} </label>
                            <textarea required type="text" class="form-control @error('description') is-invalid @enderror" name="description" >
                                {{ old('description') }}
                            </textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="category">{{__('category')}} </label>
                            <input required type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old($category->name) }}">
                            @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            <label for="category_id" >{{__('Choose_Category')}} </label>
                             <select name="category_id" id="category_id" >
                                 <option value=""> {{__('Options')}} </option>
                                 @foreach($categories as $category)
                                     <option value="{{old('category')}}"> {{$category->name}} </option>
                                 @endforeach
                             </select>
                        </div>
                        <div class="form-action text-center">
                            <button type="submit" class="btn btn-warning">{{__('Create')}}</button>
                     
                            <a href="{{route('craftsman.products', $craftsman->id)}}" name="cancel"
                               class="btn btn-secondary">{{__('Cancel')}}</a>
                        </div>
                    </form>
                </div>

            </div>
            <br>
            <br>
        </div>
    </div>


@endsection


