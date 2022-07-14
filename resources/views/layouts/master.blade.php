<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') | المحاضر الرسمية</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- css style -->
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="{{asset('css/rtl.adminlte.css')}}">
  <link rel="stylesheet" href="{{asset('css/custom.css')}}">
  <link rel="stylesheet" href="{{asset('css/print.css')}}" media="print">
</head>
<body  class="hold-transition sidebar-mini">
    <div id="app" class="wrapper">

  <!-- Navbar -->
   <nav class="main-header navbar navbar-expand bg-primary navbar-white navbar-light">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">

        <router-link to="/" class="nav-link">الرئيسية</router-link>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <router-link to="/users" class="nav-link">للاتصال</router-link>
      </li>
    </ul>
    <div>

    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link bg-primary">
      <img src="images/pvs.png" alt="pvs Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      {{-- <span class="brand-text font-weight-light">
                    DCWTlemcen
      </span> --}}
      @yield('slogan')
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="images/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <div class="text-white text-center">{{ Auth::guard('web')->user()->name }}</div>
          <div class="text-white text-center">{{ Auth::guard('web')->user()->role }}</div>
        </div>
      </div>

      <!-- SidebarSearch Form -->

      <!-- Sidebar Menu -->
        @include('admin.inc.sidebarMenu');
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <router-view></router-view>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Powered By Hakki Rabah
    </div>
    <!-- Default to the left -->
    @yield('copyright')

  </footer>
</div>
<!-- ./wrapper -->

<!-- js SCRIPTS -->

{{-- @if(Auth::guard('admin')->user()->role=="Admin" ||
    Auth::guard('admin')->user()->role=="Chef" ||
    Auth::guard('admin')->user()->role=="Agent" ||
    Auth::guard('admin')->user()->role=="Invite") --}}
    @if(Auth::guard('web')->user()->role=="Admin" ||
    Auth::guard('web')->user()->role=="Chef" ||
    Auth::guard('web')->user()->role=="Agent" ||
    Auth::guard('web')->user()->role=="Invite")
    <script>
        window.user=@json(Auth::guard('web')->user());
        window.csrf_token = "{{ csrf_token() }}";
    </script>
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="https://unpkg.com/vue-chartjs/dist/vue-chartjs.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
