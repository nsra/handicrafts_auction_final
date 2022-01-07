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
                            <form action="{{ route('craftsmen.index') }}" method="GET">
                                <div class="form-group lg-10">
                                    <input type="text" name="name"
                                        placeholder="{{ __('search by Username, FirstName, LastName or Email') }}"
                                        class="form-control" value="{{ app('request')->get('name') }}">
                                </div>

                                <div class="form-action md-2 text-right">
                                    <input type="submit" value="{{ __('Search') }}" class="btn btn-primary">
                                    <a class="btn btn-default" href="{{ route('craftsmen.index') }}">{{ __('Cancel') }}</a>
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
                    <h3 class="panel-title"><i class="fa fa-book"></i>{{ __('craftsmen') }}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th class="text-center">{{ __('FirstName') }}</th>
                                <th class="text-center">{{ __('LastName') }}</th>
                                <th class="text-center">{{ __('Username') }}</th>
                                <th class="text-center">{{ __('Email') }}</th>
                                <th class="text-center">{{ __('products') }}</th>
                                <th style="text-align: center" class="text-center">{{ __('Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($craftsmen as $craftsman)
                                <tr>
                                    <td class="text-center">{{ $craftsman->firstName }}</td>
                                    <td class="text-center">{{ $craftsman->lastName }}</td>
                                    <td class="text-center">{{ $craftsman->username }} </td>
                                    <td class="text-center">{{ $craftsman->email }} </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.craftsman.products', $craftsman->id) }}"
                                            class="btn btn-primary ">
                                            {{$craftsman->products->count()}} <i class="fa fa-tasks"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.craftsmen.show', $craftsman->id) }}"
                                            class="btn btn-primary ">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a data-toggle="modal" class="btn btn-lg" id="smallButton"
                                            data-target="#smallModal"
                                            data-attr="{{ route('craftsman.delete', $craftsman->id) }}"
                                            title="{{ __('Delete Craftsman')}}">
                                            <i class="fa fa-trash text-danger fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="com-md-12 text-right">
                        {{ $craftsmen->links('pagination::bootstrap-4') }}
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
