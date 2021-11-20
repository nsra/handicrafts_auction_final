@extends('base_layout._layout')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-search"></i>{{__('Search')}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('craftsmen.index')}}" method="GET">
                                <div class="form-group lg-10">
                                    <input type="text" name="name" placeholder="{{__('search by Username, FirstName, LastName or Email')}}" class="form-control"
                                           value="{{app('request')->get('name')}}">
                                </div>

                                <div class="form-action md-2 text-right">
                                    <input type="submit" value="{{__('Search')}}" class="btn btn-primary">
                                    <a class="btn btn-default"
                                       href="{{route('craftsmen.index')}}">{{__('Cancel')}}</a>
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
                    <h3 class="panel-title"><i class="fa fa-book"></i>{{__('craftsmen')}}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                        <tr>
                            <th class="text-center">{{__('FirstName')}}</th>
                            <th class="text-center">{{__('LastName')}}</th>
                            <th class="text-center">{{__('Username')}}</th>
                            <th class="text-center">{{__('Email')}}</th>
                            <th class="text-center">{{__('products')}}</th>
                            <th style="text-align: center" class="text-center">{{__('Options')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($craftsmen as $craftsman)
                            <tr>
                                <td class="text-center">{{$craftsman->firstName}}</td>
                                <td class="text-center">{{$craftsman->lastName}}</td>
                                <td class="text-center">{{$craftsman->username}} </td>
                                <td class="text-center">{{$craftsman->email}} </td>
                                <td class="text-center">
                                    <a href="{{route('admin.craftsman.products', $craftsman->id)}}" class="btn btn-primary ">
                                        <i class="fa fa-tasks"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('admin.craftsmen.show', $craftsman->id)}}" class="btn btn-primary ">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a class="btn btn-danger delete-craftsman" data-value="{{$craftsman->id}}">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                    <a href="{{route('craftsman.destroy', $craftsman->id)}}" class="btn btn-primary ">
                                        <i class="fa">delete</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="com-md-12 text-right">
                        {{$craftsmen->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.delete-craftsman').click(function () {
            var id = $(this).data('value')
            swal({
                    title: "Delete craftsman",
                    text: "Are You Shure You Want To Remove This craftsman with all his products!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false
                },
                function () {
                    /**
                     *
                     * send ajax request for deleting craftsman
                     *
                     */
                    $.ajax({
                        url: 'craftsman/' + id,
                        method: 'GET',
                        DataType: 'json', 
                        data:{"_token": "{{ csrf_token() }}"}, 
                    }).success(function (response) {
                        if (response.status == 200) {
                            swal("alert", response.message, "success")
                            window.location.reload()
                        } else {
                            swal("alert", response.message, "error")
                        }
                    })
                });
        })
    </script>
@endsection

