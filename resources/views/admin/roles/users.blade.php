@extends('base_layout._layout')
@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
    <style>
        .permission>li {
            float: right;
            width: 25%;
            height: 160px;
        }

    </style>
@endsection
@section('body')
    <div class="card">
        <div class="card-header">
            <h3>{{ __('Users') }}</h3>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">{{ __('Role') }}: {{ __($role->name) }}</h3>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-condensed flip-content">
                <thead class="flip-content">
                    <tr>
                        <th class="text-center">{{ __('FirstName') }}</th>
                        <th class="text-center">{{ __('LastName') }}</th>
                        <th class="text-center">{{ __('Username') }}</th>
                        <th class="text-center">{{ __('Email') }}</th>
                        <th style="text-align: center" class="text-center">{{ __('Options') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{ $user->firstName }}</td>
                            <td class="text-center">{{ $user->lastName }}</td>
                            <td class="text-center">{{ $user->username }} </td>
                            <td class="text-center">{{ $user->email }} </td>
                            <td class="text-center">
                                @if ($user->role->name === 'Craftsman')
                                    <a href="{{ route('admin.craftsman.products', $user->id) }}" class="btn btn-primary ">
                                       {{ __('products count: ')}}{{ $user->products->count() }}
                                    </a>
                                @elseif($user->role->name === 'Buyer')
                                    <a href="{{ route('admin.buyer.bids', $user->id) }}" class="btn btn-primary ">
                                        {{ __('bids count:')}} {{ $user->bids->count() }}
                                    </a>
                                @endif
                                {{-- @if ($user->role->name !== 'Admin')
                            <a class="btn btn-danger delete-user" data-value="{{$user->id}}">
                                <i class="fa fa-trash"></i>
                            </a>
                            @endif --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <div class="form-group" style="text-align: center">
                <a href="{{ route('roles.index') }}" name="cancel" class="btn btn-default">{{ __('cancel') }}</a>
            </div>
        </div>

    </div>
@endsection
