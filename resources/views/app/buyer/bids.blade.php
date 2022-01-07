@extends('layouts.main_layout')
@section('content')
    <!-- start My Bids -->
    <div class="Mybid">
        <div class="container container-mybid">
            <h2 class="mt-2">{{__("My Bids")}}</h2>
            <div class="form group mt-4 mb-3">
                <form action="{{ route('buyer.bids') }}" method="GET">
                    <input name="name" size="40" value="{{ app('request')->get('name') }}" class=""
                        type="search" placeholder="{{__('Search for bid by price')}}">
                    <button type="submit" class="btn btn-light">
                        <span><i class="fas fa-search fa-2x"></i></span>
                    </button>
                </form>
            </div>
            <hr>
            <div class="my-bid-content">
                @foreach ($bids as $bid)
                    <div class="row ">
                        <div class="col-3">
                            <h4><a href="{{ route('buyer.product.show', $bid->product->id) }}">{{ $bid->product->title }}
                                </a></h4>
                            <img src="{{ asset($bid->product->images->first()->path) }}" width="150px" height="100px"
                                class="p-1">
                        </div>
                        <div class="col-2">
                            <h4>{{__('Price:')}}{{ $bid->price }}$</h4>
                        </div>
                        <div class="col-2">
                            <h5>{{ $bid->description }}</h5>
                        </div>
                        <div class="col-2">
                            <h4>
                                <a
                                    href="{{ route('buyer.product.craftsman', $bid->product->user->id) }}">{{ $bid->product->user->username }}
                                </a>
                            </h4>
                        </div>
                        @if ($bid->product->isOrderedByMy())
                            <div class="col-1">
                                <a data-toggle="modal" class="btn ms-2 btn-success smallButton" data-target="#smallModal"
                                    data-attr="{{ route('bid.history', $bid->id) }}" title="{{__('Bid History')}}">
                                    <i class="fa fa-history"> </i>
                                </a>
                            </div>
                            <div class="col-2">
                                {{__("you ordered it")}}
                            </div>
                        @else
                        <div class="col-3">
                            <a data-toggle="modal" class="btn ms-2 btn-success smallButton" data-target="#smallModal"
                                data-attr="{{ route('bid.history', $bid->id) }}" title="{{__('Bid History')}}">
                                <i class="fa fa-history"> </i>
                            </a>
                            <a data-toggle="modal" class="btn btn-lg smallButton" data-target="#smallModal"
                                data-attr="{{ route('buyer.bid.edit', $bid->id) }}" title="{{__('Update Bid')}}">
                                <i class="fa fa-edit fa-lg"></i>
                            </a>
                            <a data-toggle="modal" class="btn btn-lg pl-0" id="smallButton" data-target="#smallModal"
                                data-attr="{{ route('buyer.bid.delete', $bid->id) }}" title="{{__('Delete Bid')}}">
                                <i class="fa fa-trash text-danger fa-lg"></i>
                            </a>
                        @endif                          
                        </div>                            
                    </div>
                    <hr>
                @endforeach


            </div>

        </div>
      
        {{ $bids->links('pagination::bootstrap-4') }}
        <br>
        <br>
        <div class="row mb-4">
            <div class="col-4"></div>
            <div class="col-4 input-form text-center">
                <a class="btn btn-lg " href="javascript:history.back()"
                    style="background-color: #ffbb00; color:black; margin-right: auto">{{ __('Cancel')}}</a>
            </div>
        </div>
    </div>
    <!-- end my bid -->
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick="removeBackdrop()" data-dismiss="modal"
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
