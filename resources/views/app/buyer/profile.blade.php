@extends('layouts.main_layout')
@section('content')
  <!-- start profile -->
  <div class="MyProfile">
    <div class="title">
      <h2 class="p-3">My Profile</h2>
    </div>
    <div class="container MyProfile-container p-3">
      <div class="container container-image-profile text-center ">
        <h6>Ali Saleh</h6>
      </div>

      <div class="row mb-4">
        <div class="col">
          <div class="input-form">
            <label>First Name</label>
            <input type="text">
          </div>
        </div>
        <div class="col">
          <div class="input-form">
            <label>Last Name</label>
            <input type="text">
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col">
          <div class="input-form">
            <label>User Name</label>
            <input type="text">
          </div>
        </div>
        <div class="col">
          <div class="input-form">
            <label>Email</label>
            <input type="text">
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col">
          <div class="input-form">
            <label>Mobile</label>
            <input type="text">
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col">
          <div class="input-form">
            <label>Address</label>
            <textarea></textarea>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col">
          <div class="input-form float-end">
            <button>View My Products</button>
          </div>
        </div>
        <div class="col mb-4">
          <div class="input-form">
            <button>View My Bids</button>
          </div>
        </div>
        <div>
          <div class="input-form text-center">
            <button style="background-color: #ffbb00;">Update Profile</button>
          </div>
        </div>

      </div>
    </div>
    <!-- end profile -->
  </div>


@section('script')
    AOS.init({duration:1200});
@endsection
        
