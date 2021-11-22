<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Handicrafts Auction</title>
  <link href="{{asset('/HandicraftsAuction/css/all.min.css" rel="stylesheet')}}">
  <link rel="stylesheet" href="{{asset('/HandicraftsAuction/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('/HandicraftsAuction/css/HandicraftsAuction.css')}}">
  <script src="{{asset('/HandicraftsAuction/js/jquery.min.js')}}"></script>
  <script src="{{asset('/HandicraftsAuction/js/popper.min.js')}}"></script>
  <script src="{{asset('/HandicraftsAuction/js/bootstrap.min.js')}}"></script>
  <link type="text/javascript" src="{{asset('/HandicraftsAuction/js/all.min.js')}}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
    crossorigin="anonymous"></script>
  <script src="{{asset('/HandicraftsAuction/js/countdown.js')}}"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
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