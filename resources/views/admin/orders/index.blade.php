@extends('base_layout._layout')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-book"></i>{{ __('Orders') }}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th class="text-center">{{ __('id')}}</th>
                                <th class="text-center">{{ __('product')}}</th>
                                <th class="text-center">{{ __('price')}}</th>
                                <th class="text-center">{{ __('buyer')}}</th>
                                <th class="text-center">{{ __('created_at')}}</th>
                                <th class="text-center">{{ __('craftsman')}}</th>
                                <th style="text-align: center" class="text-center">{{ __('Options')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="text-center" style="vertical-align: middle">{{ $order->id }}</td>
                                    <td class="text-center">
                                        {{ $order->product->title }}
                                        <br>
                                        <img src="{{ asset($order->product->images->first()->path) }}" width="150px"
                                            height="100px" class="p-1">
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        {{ $order->price }}$
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">{{ $order->user->username }}
                                    </td>

                                    <td class="text-center" style="vertical-align: middle">{{ $order->created_at }}</td>

                                    <td class="text-center" style="vertical-align: middle">
                                        {{ $order->product->user->username }}
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-primary">
                                            {{ __('order details')}}
                                        </a>
                                        <a data-toggle="modal" class="btn btn-lg" id="smallButton"
                                            data-target="#smallModal" data-attr="{{ route('order.delete', $order->id) }}"
                                            title="{{ __('Delete Order')}}">
                                            <i class="fa fa-trash text-danger fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="com-md-12 text-right">
                        {{ $orders->links('pagination::bootstrap-4') }}
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
