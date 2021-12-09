<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'HandicraftsAuction') }}</title>

<script src="{{ asset('js/app.js') }}" defer></script>

<link rel="stylesheet" href="{{asset('/HandicraftsAuction/css/all.min.css')}}">
<link rel="stylesheet" href="{{asset('/HandicraftsAuction/css/fontawesom.min.css')}}">
<link rel="stylesheet" href="{{asset('/HandicraftsAuction/css/bootstrap.min.css')}}">

<link rel="stylesheet" href="{{asset('/HandicraftsAuction/css/HandicraftsAuction.css')}}">
<script src="{{asset('/HandicraftsAuction/js/jquery.min.js')}}"></script>
<script src="{{asset('/HandicraftsAuction/js/popper.min.js')}}"></script>
<script src="{{asset('/HandicraftsAuction/js/bootstrap.min.js')}}"></script>
<link type="text/javascript" src="{{asset('/HandicraftsAuction/js/all.min.js')}}">

<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

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