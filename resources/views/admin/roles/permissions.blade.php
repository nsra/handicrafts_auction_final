@extends('base_layout._layout')
@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
    <style>
        .permission>li{
            float: right;
            width: 25%;
            height: 160px;
        }
    </style>
@endsection
@section('body')
    <div class="card">
        <div class="card-header">
            <h3>{{ __('Permissions') }}</h3>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">{{__('Roles')}}: {{$role->name}}</h3>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-condensed flip-content">
                <thead class="flip-content">
                <tr>
                    <th class="text-left">{{__('name')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td class="text-left">{{$permission->name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

