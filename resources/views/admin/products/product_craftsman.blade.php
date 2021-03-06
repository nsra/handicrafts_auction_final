@extends('base_layout._layout')

@section('body')
    <div class="row">

        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $product->title }} {{ __('craftsman') }}</h3>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="form-group container-image-profile text-center" style="width: 140px;">
                        <img src="{{asset($craftsman->image)}}" class="card-img-top" alt="...">
                    </div>
                    <div class="form-group">
                        <label for="firstName">{{ __('firstName') }} </label>
                        <input type="text" class="form-control" name="firstName" value="{{ $craftsman->firstName }}">
                    </div>
                    <div class="form-group">
                        <label for="lastName">{{ __('lastName') }} </label>
                        <input type="text" class="form-control" name="lastName" value="{{ $craftsman->lastName }}">
                    </div>
                    <div class="form-group">
                        <label for="username">{{ __('username') }} </label>
                        <input type="text" class="form-control" name="username" value="{{ $craftsman->username }}">
                    </div>
                    <div class="form-group">
                        <label for="email">{{ __('email') }} </label>
                        <input type="email" class="form-control" name="email" value="{{ $craftsman->email }}">
                    </div>
                    <div class="form-group">
                        <label for="mobile">{{ __('mobile') }} </label>
                        <input type="mobile" class="form-control" name="mobile" value="{{ $craftsman->mobile }}">
                    </div>
                    <div class="form-group">
                        <label for="address">{{ __('address') }} </label>
                        <textarea type="address" class="form-control"
                            name="address">{{ $craftsman->address }} </textarea>
                    </div>

                    <div class="form-group">
                        <label for="address">
                            <a href="{{ route('admin.craftsman.products', $craftsman->id) }}">{{ __('craftsman products:')}}
                                {{ $craftsman->products->count() }}</a>
                        </label>
                    </div>

                    <div class="form-action text-center">
                        <a href="{{ route('products.index', $product->id) }}" type="reset" name="cancel"
                            class="btn btn-default">{{ __('Cancel') }}</a>
                    </div>
                </div>

            </div>
            <br>
            <br>
        </div>
    </div>


@endsection
