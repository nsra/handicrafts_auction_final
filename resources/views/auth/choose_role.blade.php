@extends('layouts.main_layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register Role') }}</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Craftsman') }}</label>
                            <div class="col-md-6">
                                <a class="nav-link"
                                    href="{{ route('show_craftsman_register') }}">{{ __('Craftsman Register') }}</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Buyer') }}</label>
                            <div class="col-md-6">
                                <a class="nav-link"
                                    href="{{ route('show_buyer_register') }}">{{ __('Buyer Register') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
