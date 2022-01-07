<!Doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
  @include('layouts.partials.head')
  @yield('style')
  </head>

  <body class="{{app()->getlocale()== 'en' ? 'ltr': 'rtl'}}">
    <header>
      @include('layouts.partials.header')
    </header>
    <div class="container">
      <br>
      @if(session('error'))
      <div class="alert alert-danger">
          {{ __(session('error'))}}
      </div>
      @elseif(session('success'))
          <div class="alert alert-success">
              {{ __(session('success'))}}
          </div>
      @endif
      @yield('content')
    </div>
    <footer>
      @include('layouts.partials.footer')
    </footer>
      @yield('script')
  </body>
</html>
