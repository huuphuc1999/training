<!DOCTYPE html>
<html lang="en">

<head>
  @include('backend.layouts.head')
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      @include('backend.layouts.menu')



      <!-- page content -->
      <div class="right_col" role="main">
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        {{-- @include('sweetalert::alert') --}}


        @yield('main-content')




      </div>
      <!-- /page content -->

      @include('backend.layouts.footer')

</body>

</html>