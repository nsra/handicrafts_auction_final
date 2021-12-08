@extends('base_layout._layout')

@section('body')
    <div class="row">

        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Show Craftsman') }}</h3>
                    <hr>
                </div>
                <div class="card-body">
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
                        <input type="address" class="form-control" name="address" value="{{ $craftsman->address }}">
                    </div>

                    <div class="form-action text-left">
                        <a href="{{ route('admin.craftsman.products', $craftsman->id) }}" type="reset" name="bids"
                            class="btn btn-primary">{{ __('Show craftsman Products') }}</a>
                    </div>
                    <div class="form-action text-center">
                        <a href="{{ route('craftsmen.index') }}" type="reset" name="cancel"
                            class="btn btn-default">{{ __('Cancel') }}</a>
                    </div>
                </div>

            </div>
            <br>
            <br>
        </div>
    </div>


@endsection
