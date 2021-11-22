@extends('layouts.main_layout')
@section('content')
  <!-- start profile -->
  <div class="MyProfile">
    {{-- <div class="title">
      <h2 class="p-3">Change Password</h2>
    </div> --}}
    <div class="col-md-11 container MyProfile-container p-3">
        <div class="card">
            <div class="card-header title">
                <h3 class="p-3">{{ __('Change Password') }}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('buyer_password.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="current_password">{{__('current password')}} <span class="required">*</span></label>
                        <input type="text" required class="form-control @error('current_password') is-invalid @enderror" name="current_password">
                        @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{__('new password')}} <span class="required">*</span></label>
                        <input type="password" required class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" value="{{ old('password') }}">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">{{__('confirm new password')}} <span class="required">*</span></label>
                        <input type="password" required id="password-confirm" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="new-password">
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-action text-center">
                        <button type="submit" href="{{route('buyer_password.change')}}"
                            class="btn btn-warning">{{__('Change password')}}</button>
                        <a href="{{route('buyer_profile.edit')}}" type="reset"
                            class="btn btn-secondary">{{__('cancel')}}</a>
                    </div>
            </div>
            </form>
            <br>
            <br>
        </div>
    </div>
  </div>

@endsection

@section('script')
    AOS.init({duration:1200});
@endsection
            
