@extends('layouts.main_layout')
@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ __('Buyer Bids')}}</h3>
                </div>
                <br>
                <div class="panel-body">
                    <table class="table table-bordered flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th class="text-center">{{ __('price') }}</th>
                                <th class="text-center">{{ __('description') }}</th>
                                <th class="text-center">{{ __('product') }}</th>
                                <th class="text-center">{{ __('created at') }}</th>
                                <th class="text-center">{{ __('bid history') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bids as $bid)
                                <tr>
                                    <td class="text-center">{{ $bid->price }}</td>
                                    <td class="text-center">{{ $bid->description }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('craftsman.product.show', $bid->product->id) }}">{{ $bid->product->title }}
                                        </a>
                                    </td>
                                    <td class="text-center">{{ $bid->created_at }}</td>
                                    <td class="text-center">
                                        <a data-toggle="modal" class="btn btn-success smallButton" data-target="#smallModal"
                                            data-attr="{{ route('bid.history', $bid->id) }}" title="{{ __('Bid History')}}">
                                            <i class="fa fa-history"> {{ __('Bid History')}}</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="text-center ">
        <a href="{{ route('craftsman.product.bid.user', $bid->id) }}" type="reset" name="cancel"
            class="btn btn-warning">{{ __('Cancel') }}</a>
    </div>

<div class="modal fade" id="smallModal" style="padding: 0 !important" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onClick="window.location.reload();"
                    aria-label="Close">
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
        function removeBackdrop() {
            $('.modal-backdrop').remove();
        }
        $(document).on('click', '.smallButton', function(event) {
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