@extends('base_layout._layout')

@section('body')
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-book"></i>{{ __('Roles') }}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th class="text-center">{{ __('name') }}</th>
                                <th style="text-align: center" class="text-center">{{ __('users') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="text-center">{{ $role->name }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('role.view_users', $role->id) }}" class="btn btn-primary ">
                                            <i class="fa fa-users"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="com-md-12 text-right">
                        {{ $roles->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
