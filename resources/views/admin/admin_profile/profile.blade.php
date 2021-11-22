@extends('base_layout._layout')

@section('body')
    <?php
    use Illuminate\Support\Facades\URL;
    ?>
    <div class="row">

        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Profile') }}</h3>
                    <hr>
                </div>
                <div class="card-body">
                    <form action="{{route('admin_profile.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label for="firstName">{{__('firstName')}} <span class="required">*</span></label>
                            <input type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName', optional($user)->firstName) }}">
                            @error('firstName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="lastName">{{__('lastName')}} <span class="required">*</span></label>
                            <input type="text" class="@error('lasttName') is-invalid @enderror form-control" name="lastName" value="{{ old('lastName', optional($user)->lastName) }}">
                            <span class="error">{{$errors->first('lastName')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="username">{{__('Username')}} <span class="required">*</span></label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', optional($user)->username) }}">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">{{__('email')}} <span class="required">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', optional($user)->email) }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="address">{{__('address')}} <span class="required">*</span></label>
                            <textarea type="text" class="form-control @error('address') is-invalid @enderror" name="address" >{{ old('address', optional($user)->address) }}</textarea>
                            <span class="error">{{$errors->first('address')}}</span>
                        </div>
                        
                        <div class="form-group">
                            <label for="mobile">{{__('mobile')}} <span class="required">*</span></label>
                            <input  maxlength = "10" minlength = "10" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile', optional($user)->mobile) }}">
                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-action text-center">
                            <button type="submit"  class="btn btn-primary">{{__('edit')}}</button>
                            <a href="{{route('admin_password.change')}}"
                               class="btn btn-default">{{__('change password')}}</a>
                            <a  href="{{route('admin_dashboard')}}" type="reset"
                               class="btn btn-default">{{__('cancel')}}</a>
                        </div>
                </div>
                </form>
                <br>
                <br>
            </div>
        </div>
@endsection
