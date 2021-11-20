@extends('base_layout._layout')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-search"></i>@lang('lang.search')</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('buyers.index')}}" method="GET">
                                <div class="col-sm-4 form-group">
                                    <label for="name">@lang('lang.name')</label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{app('request')->get('name')}}">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="email">@lang('lang.email')</label>
                                    <input type="text" name="email" class="form-control"
                                           value="{{app('request')->get('email')}}">
                                </div>


                                <div class="form-action col-sm-12 text-right">
                                    <input type="submit" value="{{trans('lang.search')}}" class="btn btn-primary">
                                    <a class="btn btn-default"
                                       href="{{route('admins.index')}}">@lang('lang.cancel')</a>
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
                    <h3 class="panel-title"><i class="fa fa-book"></i>{{__('admin.titles.admins')}}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                        <tr>
                            <th class="text-center">@lang('lang.name')</th>
                            <th class="text-center">@lang('lang.email')</th>
                            <th class="text-center">@lang('lang.role')</th>
                            <th style="text-align: center" class="text-center">@lang('lang.options')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <td class="text-center">{{$admin->name}}</td>
                                <td class="text-center">{{$admin->email}}</td>
                                <td class="text-center">{{$admin->getRoleNames()->first()}} </td>
                                <td class="text-center">
                                    <a href="{{route('admin.view_permissions', $admin->id)}}" class="btn btn-primary ">
                                        <i class="fa fa-lock"></i>
                                    </a>
                                    <a href="{{route('admins.edit', $admin->id)}}" class="btn btn-default ">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{route('admins.show', $admin->id)}}" class="btn btn-primary ">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a class="btn btn-danger delete-admin" data-value="{{$admin->id}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="com-md-12 text-right">
                        {{$admins->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.delete-admin').click(function () {
            var id = $(this).data('value')
            swal({
                    title: "@lang('lang.questions.confirm_remove')",
                    text: "@lang('admin.questions.do_remove')",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "@lang('lang.yes')",
                    cancelButtonText: "@lang('lang.no')",
                    closeOnConfirm: false
                },
                function () {
                    /**
                     *
                     * send ajax request for deleting admin
                     *
                     */
                    $.ajax({
                        url: '{{route('admin.destroy')}}/' + id,
                        method: 'GET',
                        data: {body: '', _token: '{{csrf_token()}}'}
                    }).success(function (response) {
                        if (response.status == 200) {
                            swal("@lang('lang.alert')", response.message, "success")
                            window.location.reload()
                        } else {
                            swal("@lang('lang.alert')", response.message, "error")
                        }
                    })
                });
        })
    </script>
@endsection

