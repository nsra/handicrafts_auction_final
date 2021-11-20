<!Doctype html>
<html lang="en">
  <head>
    @include('layouts.partials.head')
  </head>

  <body>

    <div class="container">

      <header class="blog-header py-3">
        @include('layouts.partials.header')
      </header>

      <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
           @include('layouts.partials.nav')
        </nav>
      </div>

      <div class="row mb-2">
        @yield('profile_content')
      </div>
    
    </div>

    <footer class="blog-footer p-3">
      @include('layouts.partials.footer')
    </footer>

  </body>
</html>
