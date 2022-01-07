@extends('layouts.main_layout')
@section('content')
    <!-- start profile -->
    <div class="MyProfile">
        <div class="title">
            <h2 class="p-3">{{ __('Buyer Profile')}}</h2>
        </div>
        <div class="container MyProfile-container p-3">
            <div class="container container-image-profile text-center" style="width: 140px;">
                {{-- <h2 style="color: #ffbb00">{{ $user->firstName }} {{ $user->lastName }}</h2> --}}
                <img src="{{asset($user->image)}}" class="card-img-top" alt="...">
            </div>
            <br>
            <br>
            <form action="{{ route('craftsman_profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row mb-4">
                    <div class="col">
                        <div class="input-form">
                            <label>{{ __('First Name')}}</label>
                            <input type="text" class="@error('firstName') is-invalid @enderror" name="firstName"
                                value="{{ old('firstName', optional($user)->firstName) }}">
                          
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-form">
                            <label>{{ __('Last Name')}}</label>
                            <input type="text" class="@error('lastName') is-invalid @enderror" name="lastName"
                                value="{{ old('lastName', optional($user)->lastName) }}">

                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <div class="input-form">
                            <label>{{ __('User Name')}}</label>
                            <input type="text" class=" @error('username') is-invalid @enderror" name="username"
                                value="{{ old('username', optional($user)->username) }}">
                          
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-form">
                            <label>{{ __('Email')}}</label>
                            <input type="email" class=" @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email', optional($user)->email) }}">
                           
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <div class="input-form">
                            <label>{{ __('Mobile')}}</label>
                            <input maxlength="10" minlength="10" type="text" class=" @error('mobile') is-invalid @enderror"
                                name="mobile" value="{{ old('mobile', optional($user)->mobile) }}">
                           
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <div class="input-form">
                            <label>{{ __('Address')}}</label>
                            <textarea type="text" class=" @error('address') is-invalid @enderror"
                                name="address">{{ old('address', optional($user)->address) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">

                    <div>
                        <div class="input-form text-center">
                            <a class="btn btn-lg " href="{{ route('buyer.product.bids', $product->id) }}"
                                style="background-color: #ffbb00; color:black">{{ __('Cancel')}}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- end profile -->
    </div>

@endsection

