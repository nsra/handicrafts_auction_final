@extends('base_layout._layout')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-search"></i>{{ __('Search') }}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.craftsman.products', $craftsman->id) }}" method="GET">
                                <div class="form-group lg-10">
                                    <input type="text" name="name"
                                        placeholder="{{ __('search by product title, Price or description') }}"
                                        class="form-control" value="{{ app('request')->get('name') }}">
                                </div>

                                <div class="form-action col-sm-12 text-right">
                                    <input type="submit" value="{{ __('Search') }}" class="btn btn-primary">
                                    <a class="btn btn-default"
                                        href="{{ route('admin.craftsman.products', $craftsman->id) }}">{{ __('Cancel') }}
                                    </a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-book"></i>{{ __('products') }}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th class="text-center">{{ __('title') }}</th>
                                <th class="text-center">{{ __('price') }}</th>
                                <th class="text-center">{{ __('bids') }}</th>
                                <th class="text-center">{{ __('created at') }}</th>
                                <th class="text-center">{{ __('Details') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="text-center">{{ $product->title }}</td>
                                    <td class="text-center">{{ $product->orderNowPrice }}</td>
                                    <td class="text-center">{{ $product->bids->count() }}</td>
                                    <td class="text-center">{{ $product->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.craftsman.product', $product->id) }}"
                                            class="btn btn-primary ">
                                            <i class="fa fa-tasks"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="com-md-12 text-right">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="text-center ">
        <a href="{{ route('craftsmen.index') }}" type="reset" name="cancel"
            class="btn btn-default">{{ __('Cancel') }}</a>
    </div>
@endsection
