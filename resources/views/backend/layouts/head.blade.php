<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>River Crane</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <script src="http://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>

  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js" type="text/javascript">
  </script>
  <!-- Bootstrap -->
  <link href="{{asset('backend/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{asset('backend/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{asset('backend/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
  <!-- iCheck -->
  <link href="{{asset('backend/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

  <!-- bootstrap-progressbar -->
  <link href="{{asset('backend/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}"
    rel="stylesheet">
  <!-- JQVMap -->
  <link href="{{asset('backend/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet" />
  <!-- bootstrap-daterangepicker -->
  <link href="{{asset('backend/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="{{asset('backend/build/css/custom.min.css')}}" rel="stylesheet">
  <link href="{{asset('backend/vendors/dropzone/dist/min/dropzone.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('backend/select/css/jquery.multiselect.css')}}">
  <link rel="stylesheet" href="{{asset('backend/select/css/style.css')}}">
  @stack('styles')
</head>