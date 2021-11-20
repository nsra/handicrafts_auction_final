
@extends('base_layout._layout')

@section('body')
    <div class="row">

        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('admin.titles.show_admin') }}</h3>
                </div>
                <div class="card-body">
                        <div class="form-group " style="text-align: center">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                        <img src="{{$admin->getImage()}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">{{__('lang.name')}} <span class="required">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ $admin->name }}">
                            <span class="error">{{$errors->first('name')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('lang.email')}} <span class="required">*</span></label>
                            <input type="text" class="form-control" name="email" value="{{ $admin->email }}">
                            <span class="error">{{$errors->first('email')}}</span>
                        </div>

                    <div class="form-action text-center">
                        <a href="{{route('admins.index')}}" type="reset" name="cancel"
                           class="btn btn-default">@lang('lang.cancel')</a>
                    </div>
                </div>

            </div>
            <br>
            <br>
        </div>
    </div>


@endsection


