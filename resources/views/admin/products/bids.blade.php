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
                            <form action="{{ route('admin.product.bids', $product->id) }}" method="GET">
                                <div class="form-group lg-10">
                                    <input type="text" name="name"
                                        placeholder="{{ __('search by bid Price or description') }}" class="form-control"
                                        value="{{ app('request')->get('name') }}">
                                </div>

                                <div class="form-action col-sm-12 text-right">
                                    <input type="submit" value="{{ __('Search') }}" class="btn btn-primary">
                                    <a class="btn btn-default"
                                        href="{{ route('admin.product.bids', $product->id) }}">{{ __('Cancel') }}
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
                    <h3 class="panel-title"><i class="fa fa-book"></i>{{ $product->title }} {{ __('Bids') }}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th class="text-center">{{ __('price') }}</th>
                                <th class="text-center">{{ __('owner') }}</th>
                                <th class="text-center">{{ __('product') }}</th>
                                <th class="text-center">{{ __('description') }}</th>
                                <th class="text-center">{{ __('created at') }}</th>
                                <th class="text-center">{{ __('bid history') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bids as $bid)
                                <tr>
                                    <td class="text-center">{{ $bid->price }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.product.bid.buyer', $bid->id) }}">
                                            {{ $bid->user->username }}</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.products.show', $bid->product->id) }}">
                                            {{ $bid->product->title }}
                                        </a>
                                    </td>
                                    <td class="text-center">{{ $bid->description }}</td>
                                    <td class="text-center">{{ $bid->created_at }}</td>
                                    <td class="text-center">
                                        <a data-toggle="modal" class="btn btn-lg" id="smallButton"
                                            data-target="#smallModal"
                                            data-attr="{{ route('bid.history', $bid->id) }}"
                                            title="{{ __('Bid History')}}">
                                            <i class="fa fa-history text-success fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="com-md-12 text-right">
                        {{ $bids->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="text-center ">
        <a href="{{ route('products.index') }}" type="reset" name="cancel" class="btn btn-default">{{ __('Cancel') }}</a>
    </div>

    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
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


