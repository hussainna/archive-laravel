<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('admin.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!--the navbar part-->
    @include('admin.adminHeader')

    <!--the Sidebar part-->
    @include('admin.sidebar')
  <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!--Footer-->
    @include('admin.footer')


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('admin.secript')
</body>
</html>
