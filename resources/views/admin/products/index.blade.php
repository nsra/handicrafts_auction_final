@extends('base_layout._layout')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-search"></i>Search</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('products.index') }}" method="GET">
                                <input type="search" name="name" size="80"
                                    placeholder="{{ __('Enter Product title or price to search with')}}"
                                    value="{{ app('request')->get('name') }}">
                                <select name="category" id="">
                                    <option value="">{{__('Select category to search with')}}</option>
                                    @foreach ($categories as $category)
                                        <option value={{ $category->id }}
                                            {{ app('request')->get('category') == $category->id ? 'selected' : '' }}>
                                            {{ __($category->name) }}</option>
                                    @endforeach
                                </select>
                                <div class="form-action md-2 text-right">
                                    <input type="submit" value="{{ __('Search') }}" class="btn btn-primary">
                                    <a class="btn btn-default" href="{{ route('products.index') }}">{{ __('Cancel') }}</a>
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
                    <h3 class="panel-title"><i class="fa fa-book"></i>{{ __('Products') }}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th class="text-center">
                                </th>
                                <th class="text-center">{{ __('OrderNowPrice')}}</th>
                                <th class="text-center">{{ __('OwnerName')}}</th>
                                <th class="text-center">{{__('Category')}}</th>
                                <th class="text-center">{{ __('MaxBid')}}</th>
                                <th style="text-align: center" class="text-center">{{ __('Options')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="text-center">
                                        <a
                                            href="{{ route('admin.products.show', $product->id) }}">{{ $product->title }}</a>
                                        <br>
                                        <img src="{{ asset($product->images->first()->path) }}" width="150px"
                                            height="100px" class="p-1">
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        {{ $product->orderNowPrice }}$</td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <a
                                            href="{{ route('admin.product.craftsman', $product->id) }}">{{ $product->user->username }}</a>
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        {{ __($product->category->name) }}</td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <a
                                            href="{{ route('admin.product.bids', $product->id) }}">{{ $product->isAuctioned() ? $product->maxBidPrice() . '$' : '0' }}</a>
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        @if(!$product->isOrdered())
                                        <a data-toggle="modal" class="btn btn-lg" id="smallButton"
                                            data-target="#smallModal"
                                            data-attr="{{ route('product.delete', $product->id) }}"
                                            title="{{ __('Delete Product')}}">
                                            <i class="fa fa-trash text-danger fa-lg"></i>
                                        </a>
                                        @else
                                        <a class="btn btn-default">
                                            {{__('ordered product')}}
                                        </a>
                                        @endif
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
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).on('click', '#smallButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
    </script>
@endsection
