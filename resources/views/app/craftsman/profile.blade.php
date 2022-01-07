@extends('layouts.main_layout')
@section('content')
    <!-- start profile -->
    <div class="MyProfile">
        <div class="title">
            <h2 class="p-3">{{ __('My Profile')}}</h2>
        </div>
        <div class="container MyProfile-container p-3">
            <div class="container container-image-profile text-center" style="width: 140px;">
                <img src="{{asset($user->image)}}" class="card-img-top" alt="...">
            </div>
            <div class="text-center">
                <a data-toggle="modal" class="btn btn-warning smallButton" data-target="#smallModal"
                    data-attr="{{ route('craftsman.edit_image', $user->id) }}" title="Update Your Image">
                    {{ __('Update My Image')}} <i class="fa fa-pen"> </i>
                </a>
            </div>
            <br>
            <br>
            <div class="row col-10">
                <div class="col-3">
                    {{-- <div class="input-form float-end"> --}}
                        <a class="btn btn-lg btn-secondary" href="{{ route('craftsman.products') }}"
                            style="color:black">&nbsp;&nbsp;{{ __('View My Products')}}</a>
                    {{-- </div> --}}
                </div>
                <div class="col-3">
                    {{-- <div class="input-form">  --}}
                        &nbsp;&nbsp; <a class="btn btn-lg btn-secondary" href="{{ route('craftsman.ordered_products') }}"
                            style="color:black">{{ __('Ordered products')}}</a>
                    {{-- </div> --}}
                </div>
            </div>
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
                            @error('firstName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-form">
                            <label>{{ __('Last Name')}}</label>
                            <input type="text" class="@error('lastName') is-invalid @enderror" name="lastName"
                                value="{{ old('lastName', optional($user)->lastName) }}">
                            @error('lastName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </span>
                            @enderror
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
                                    <strong>{{ __($message) }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-form">
                            <label>{{ __('Email')}}</label>
                            <input type="email" class=" @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email', optional($user)->email) }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <div class="input-form">
                            <label>{{ __('Mobile')}}</label>
                            <input maxlength="10" minlength="10" type="text" class=" @error('mobile') is-invalid @enderror"
                                name="mobile" value="{{ old('mobile', optional($user)->mobile) }}">
                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <div class="input-form">
                            <label>{{ __('Address')}}</label>
                            <textarea type="text" class=" @error('address') is-invalid @enderror"
                                name="address">{{ old('address', optional($user)->address) }}</textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </span>
                            @enderror                        
                        </div>
                    </div>
                </div>

                <div>
                    <div class="input-form text-center">
                        <button type="submit" style="background-color: #ffbb00; color:black">{{ __('Update Profile')}}</button> &nbsp;
                        &nbsp; &nbsp; &nbsp;
                        <a class="btn btn-lg " href="{{ route('craftsman_password.change') }}"
                            style="background-color: #ffbb00; color:black">{{ __('Update Password')}}</a>
                    </div>
                </div>
        </div>
        </form>
    </div>
    <!-- end profile -->
    </div>

<div class="modal fade" id="smallModal" style="padding: 0 !important" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onClick="window.location.reload();"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="smallBody">
                <div>
                    <!-- the result to be displayed apply here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>

        function removeBackdrop() {
            $('.modal-backdrop').remove();
        }
        $(document).on('click', '.smallButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
    </script>

@endsection

