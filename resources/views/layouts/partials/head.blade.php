<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'HandicraftsAuction') }}</title>

<script src="{{ asset('js/app.js') }}" defer></script>

<link href="{{asset('/HandicraftsAuction/css/all.min.css" rel="stylesheet')}}">
<link rel="stylesheet" href="{{asset('/HandicraftsAuction/css/all.min.css')}}">

@if (app()->getLocale() == 'ar')
<link rel="stylesheet" href="{{asset('/HandicraftsAuction/css/bootstrap-rtl.min.css')}}">
@else
<link rel="stylesheet" href="{{asset('/HandicraftsAuction/css/bootstrap.min.css')}}">
@endif

<link rel="stylesheet" href="{{asset('/HandicraftsAuction/css/HandicraftsAuction.css')}}">
<script src="{{asset('/HandicraftsAuction/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('/HandicraftsAuction/js/popper-1.16.1.min.js')}}"></script>
<script src="{{asset('/HandicraftsAuction/js/bootstrap.min.js')}}"></script>

<link type="text/javascript" src="{{asset('/HandicraftsAuction/js/all.min.js')}}">

<link href="{{ asset('css/app.css') }}" rel="stylesheet">


<style>
    
    .invalid-feedback {
        display: block;
    }

    /* .content-product_details img {
        width: 100%!important;
        height: 100%!important;
        object-fit: cover;
    } */

    .preview-image img{
        padding: 10px;
        max-width: 100px;
    }

    .rtl {
        direction: rtl !important
    } 

    .ltr {
        direction: ltr !important
    }

    .error {
      color: red;
      margin-top: 10px !important;
    }

    .required {
      color: red;
    }

    .page-bar {
        margin: -22px -14px 22px !important;
    }

    .invalid-feedback{
        width: 100%;
        margin-top: 0.25rem;
        font-size: 80%;
        color: #e3342f;
    }

  
</style>