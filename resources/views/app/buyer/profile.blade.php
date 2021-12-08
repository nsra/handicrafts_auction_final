@extends('layouts.main_layout')
@section('content')
    <!-- start profile -->
    <div class="MyProfile">
        <div class="title">
            <h2 class="p-3">My Profile</h2>
        </div>
        <div class="container MyProfile-container p-3">
            <div class="container container-image-profile text-center" style="width: 140px;">
                <h2 style="color: #ffbb00">{{ $user->firstName }} {{ $user->lastName }}</h2>
            </div>
            <br>
            <br>
            <div class="row mb-4">
                <div class="col">
                    <div class="input-form float-end">
                        <a class="btn btn-lg btn-secondary" href="{{ route('buyer.bids') }}" style="color:black"> &nbsp;
                            &nbsp; View My Bids &nbsp; &nbsp; &nbsp; </a>
                    </div>
                </div>
                <div class="col mb-4">
                    <div class="input-form">
                        &nbsp;&nbsp; <a class="btn btn-lg btn-secondary" href="{{ route('buyer.ordered_products') }}"
                            style="color:black"> &nbsp; &nbsp; &nbsp; &nbsp;My Orders &nbsp; &nbsp; &nbsp;</a>
                    </div>
                </div>
                <div>
                    <br>
                    <form action="{{ route('craftsman_profile.update', $user->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row mb-4">
                            <div class="col">
                                <div class="input-form">
                                    <label>First Name</label>
                                    <input type="text" class="@error('firstName') is-invalid @enderror" name="firstName"
                                        value="{{ old('firstName', optional($user)->firstName) }}">
                                    @error('firstName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-form">
                                    <label>Last Name</label>
                                    <input type="text" class="@error('lastName') is-invalid @enderror" name="lastName"
                                        value="{{ old('lastName', optional($user)->lastName) }}">
                                    <span class="error">{{ $errors->first('lastName') }}</span>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <div class="input-form">
                                    <label>User Name</label>
                                    <input type="text" class=" @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username', optional($user)->username) }}">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-form">
                                    <label>Email</label>
                                    <input type="email" class=" @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email', optional($user)->email) }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <div class="input-form">
                                    <label>Mobile</label>
                                    <input maxlength="10" minlength="10" type="text"
                                        class=" @error('mobile') is-invalid @enderror" name="mobile"
                                        value="{{ old('mobile', optional($user)->mobile) }}">
                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <div class="input-form">
                                    <label>Address</label>
                                    <textarea type="text" class=" @error('address') is-invalid @enderror"
                                        name="address">{{ old('address', optional($user)->address) }}</textarea>
                                    <span class="error">{{ $errors->first('address') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="input-form text-center">
                            <button type="submit" style="background-color: #ffbb00; color:black">Update Profile</button>
                            &nbsp; &nbsp; &nbsp; &nbsp;
                            <a class="btn btn-lg " href="{{ route('craftsman_password.change', $user->id) }}"
                                style="background-color: #ffbb00; color:black">Update Password</a>
                        </div>
                </div>
            </div>
            </form>
        </div>
        <!-- end profile -->
    </div>

@endsection
