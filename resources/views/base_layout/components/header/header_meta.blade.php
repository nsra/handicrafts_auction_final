<meta charset="utf-8" />
<title>{{__("Handicrafts Auction")}}</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<script src="{{ asset('/HandicraftsAuction/js/jquery.min.js') }}"></script>
<script src="{{ asset('/HandicraftsAuction/js/popper.min.js') }}"></script>
<script src="{{ asset('/HandicraftsAuction/js/bootstrap.min.js') }}"></script>

<style>
    @font-face {
        font-family: "JF Flat Regular";
        src: url(../fonts/JF-Flat-regular.eot);
        src: url(../fonts/JF-Flat-regular.eot?#iefix) format('embedded-opentype'),
            url('../fonts/JF-Flat-regular.svg#JF Flat Regular') format('svg'),
            url(../fonts/JF-Flat-regular.woff) format('woff'),
            url(../fonts/JF-Flat-regular.ttf) format('truetype');
        font-weight: bolder;
        font-style: normal
    }

    body {
        font-family: "JF Flat Regular", 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
        /* font-size: 14px;
        color: black;
        line-height: 1.429; */
    }
    .error {
        color: red;
        margin-top: 10px !important;
    }

    .item{
        background-color: transparent !important;
    }
    .carousel-control {
        border: none !important;
        color: black !important;
    }

    .required {
        color: red;
    }

    .rtl {
        direction: rtl !important
    }

    .ltr {
        direction: ltr !important
    }
    
    .page-bar {
        margin: -22px -14px 22px !important;
    }

    .invalid-feedback {
        width: 100%;
        margin-top: 0.25rem;
        font-size: 80%;
        color: #e3342f;
    }

    .fa-search,
    .fa-plus,
    .fa-book,
    .fa-edit,
    .fa-list {
        margin-right: 5px;
    }

</style>


<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('/control/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('/control/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet"
    type="text/css" />

@if(app()->getLocale() == 'ar')
    <link href="{{asset('/control/assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('/control/assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css')}}"
          rel="stylesheet"
          type="text/css"/>
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('/control/assets/global/css/components-rtl.min.css')}}" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{asset('/control/assets/global/css/plugins-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('/control/assets/layouts/layout/css/layout-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/control/assets/layouts/layout/css/themes/darkblue-rtl.min.css')}}" rel="stylesheet"
          type="text/css"
          id="style_color"/>
    <link href="{{asset('/control/assets/layouts/layout/css/custom-rtl.min.css')}}" rel="stylesheet" type="text/css"/>

@else
    <link href="{{asset('/control/assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('/control/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}"
          rel="stylesheet"
          type="text/css"/>
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('/control/assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{asset('/control/assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('/control/assets/layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/control/assets/layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet"
          type="text/css"
          id="style_color"/>
    <link href="{{asset('/control/assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css"/>

@endif


<!-- END GLOBAL MANDATORY STYLES -->
<link href="{{ asset('/control/assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet"
    type="text/css" />
<!-- END THEME LAYOUT STYLES -->
<link href="{{ asset('/control/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet"
    type="text/css" />

<link rel="shortcut icon" href="favicon.ico" />
