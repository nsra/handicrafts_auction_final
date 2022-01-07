@extends('layouts.main_layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ __('Search') }}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('buyer.product.bids', $product->id) }}" method="GET">
                                <div class="form-group lg-10">
                                    <input class="form-group " type="text" name="name"
                                        placeholder="{{ __('Enter Price or description') }}"
                                        value="{{ app('request')->get('name') }}">
                                    {{-- <div class="form-action col-sm-12 text-right"> --}}
                                    <input type="submit" value="{{ __('Search') }}" class="btn btn-warning">
                                    <a class="btn btn-secondary"
                                        href="{{ route('buyer.product.bids', $product->id) }}">{{ __('Cancel') }}
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
                    <h3 class="panel-title">{{ __('Bids for product:')}} {{ $product->title }} {{ __('- OrderNowPrice:')}}
                        {{ $product->orderNowPrice }}$</h3>
                </div>
                <br>
                <div class="panel-body">
                    <table class="table table-bordered flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th class="text-center">{{ __('price') }}</th>
                                <th class="text-center">{{ __('description') }}</th>
                                <th class="text-center">{{ __('created at') }}</th>
                                <th class="text-center">{{ __('Bid Owner-Buyer') }}</th>
                                <th class="text-center">{{ __('Bid History') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bids as $bid)
                                <tr>
                                    <td class="text-center">{{ $bid->price }}</td>
                                    <td class="text-center">{{ $bid->description }}</td>
                                    <td class="text-center">{{ $bid->created_at }}</td>
                                    <td class="text-center">
                                        @if ($bid->id == $bid->product->authUserBidId())
                                            {{ __('Its your bid!')}}
                                        @else
                                            <a
                                                href="{{ route('buyer.product.bid.user', $bid->id) }}">{{ $bid->user->username }}</a>
                                        @endIf
                                    </td>
                                    <td class="text-center">
                                        <a data-toggle="modal" class="btn btn-success smallButton" data-target="#smallModal"
                                            data-attr="{{ route('bid.history', $bid->id) }}" title="{{ __('Bid History')}}">
                                            <i class="fa fa-history"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <div class="com-md-12 text-right">
                            {{ $bids->links('pagination::bootstrap-4') }}
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="text-center ">
        <a href="{{ route('buyer.product.show', $product->id) }}" type="reset" name="cancel"
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
