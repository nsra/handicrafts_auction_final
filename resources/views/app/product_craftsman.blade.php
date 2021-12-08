@extends('layouts.main_layout')
@section('content')
    <!-- start profile -->
    <div class="MyProfile">
        <div class="title">
            <h2 class="p-3">Craftsman Profile</h2>
        </div>
        <div class="container MyProfile-container p-3">
            <div class="container container-image-profile text-center" style="width: 140px;">
                <h2 style="color: #ffbb00">{{ $product->user->firstName }} {{ $product->user->lastName }}</h2>
            </div>
            <br>
            <br>
            <div class="row mb-4">
                <div class="col">
                    <div class="input-form">
                        <label>First Name</label>
                        <input type="text" class="@error('firstName') is-invalid @enderror" name="firstName"
                            value="{{ $product->user->firstName }}">
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
                            value="{{ $product->user->lastName }}">
                        <span class="error">{{ $errors->first('lastName') }}</span>

                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="input-form">
                        <label>User Name</label>
                        <input type="text" class=" @error('username') is-invalid @enderror" name="username"
                            value="{{ $product->user->username }}">
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
                            value="{{ $product->user->email }}">
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
                        <input maxlength="10" minlength="10" type="text" class=" @error('mobile') is-invalid @enderror"
                            name="mobile" value="{{ $product->user->mobile }}">
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
                            name="address">{{ $product->user->address }}</textarea>
                        <span class="error">{{ $errors->first('address') }}</span>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div>
                    <div class="input-form text-center">
                        @if ($user->products->count() > 0 && auth()->user()->role_id == 3)
                            <a class="btn btn-secondary btn-lg "
                                href="{{ route('buyer.craftsman.products', $product->id) }}">Craftsman Products:
                                {{ $product->user->products->count() }}</a>
                        @elseif($user->products->count()>0 && (!auth()->user() || auth()->user()->role_id != 3))
                            <a class="btn btn-secondary btn-lg "
                                href="{{ route('user.products', $product->id) }}">Craftsman Products:
                                {{ $product->user->products->count() }}</a>
                        @endif
                        <a class="btn btn-lg " href="{{ route('product.details', $product->id) }}"
                            style="background-color: #ffbb00; color:black">Cancel</a>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <!-- end profile -->
    </div>

@endsection
