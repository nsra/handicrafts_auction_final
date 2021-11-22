<!Doctype html>
<html lang="en">
  <head>
  @include('layouts.partials.head')
  @yield('style')
  </head>

  <body>
    <header>
      @include('layouts.partials.header')
    </header>
    <div class="container">
      <br>
      @if(session('error'))
      <div class="alert alert-danger">
          {{session('error')}}
      </div>
      @elseif(session('success'))
          <div class="alert alert-success">
              {{session('success')}}
          </div>
      @endif
      @yield('content')
    </div>
    <footer>
      <script>
        @yield('script')
      </script>
    </footer>
  </body>
</html>
