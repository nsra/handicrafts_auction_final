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
            <h3>{{ __('Products') }}</h3>
        </div>
        <div class="card-body">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">{{ __('Category') }}: {{ __($category->name) }}</h3>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-condensed flip-content">
                <thead class="flip-content">
                    <tr>
                        <th class="text-center">{{ __('title') }}</th>
                        <th class="text-center">{{ __('description') }}</th>
                        <th class="text-center">{{ __('show') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="text-center">{{ $product->title }}</td>
                            <td class="text-center">{{\Illuminate\Support\Str::limit($product->description, 100, '...') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-primary ">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
