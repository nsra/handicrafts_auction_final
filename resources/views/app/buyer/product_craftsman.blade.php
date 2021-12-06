@extends('layouts.main_layout')
@section('content')
  <!-- start profile -->
  <div class="MyProfile">
    <div class="title">
      <h2 class="p-3">Craftsman Profile</h2>
    </div>
    <div class="container MyProfile-container p-3">
      <div class="container container-image-profile text-center" style="width: 140px;">
        <h2 style="color: #ffbb00">{{$user->firstName}} {{$user->lastName}}</h2>
      </div>
      <br>
      <br>
      <form action="{{route('craftsman_profile.update', $user->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row mb-4">
            <div class="col">
            <div class="input-form">
                <label>First Name</label>
                <input type="text" class="@error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName', optional($user)->firstName) }}">
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
                <input type="text" class="@error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName', optional($user)->lastName) }}">
                            <span class="error">{{$errors->first('lastName')}}</span>

            </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col">
            <div class="input-form">
                <label>User Name</label>
                <input type="text" class=" @error('username') is-invalid @enderror" name="username" value="{{ old('username', optional($user)->username) }}">
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
                <input type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email', optional($user)->email) }}">
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
                <input  maxlength = "10" minlength = "10" type="text" class=" @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile', optional($user)->mobile) }}">
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
                <textarea type="text" class=" @error('address') is-invalid @enderror" name="address" >{{ old('address', optional($user)->address) }}</textarea>
                            <span class="error">{{$errors->first('address')}}</span>
            </div>
            </div>
        </div>
        <div class="row mb-4">
           
            <div>
            <div class="input-form text-center">
                @if($user->products->count()>0)
                <a class="btn btn-secondary btn-lg " href="{{route('buyer.craftsman.products', $user->products[0]->id)}}" >Craftsman Products: {{$user->products->count()}}</a>
                @endif
                <a class="btn btn-lg " href="{{route('buyer.bids')}}" style="background-color: #ffbb00; color:black">Cancel</a>
            </div>
           
            </div>
        </div>
      </form>
    </div>
    <!-- end profile -->
  </div>

@endsection

@section('script')
    AOS.init({duration:1200});
@endsection
        
