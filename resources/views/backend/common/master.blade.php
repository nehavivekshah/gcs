<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Google font-->
  @include('backend.common.header')

</head>

<body>
  <!-- loader starts-->
  <div class="loader-wrapper">
    <div class="loader">
      <div class="loader4"></div>
    </div>
  </div>

  <!-- loader ends-->
  <!-- tap on top starts-->
  <div class="tap-top"><i data-feather="chevrons-up"></i></div>
  <!-- tap on tap ends-->
  <!-- page-wrapper Start-->
  <div class="page-wrapper compact-wrapper" id="pageWrapper">

    <!-- Page Header Start-->

    @include('backend.common.page-header')

    <!-- Page Header Ends                              -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper">

      <!-- Page Sidebar Start-->

      @include('backend.common.side-bar');

      <!-- Page Sidebar Ends-->
      <div class="page-body" style="margin-top:10px !important;">

        @yield('main-section')

      </div>
      <!-- footer start-->
      @include('backend.common.footer')
    </div>
  </div>
  <!-- latest jquery-->
  <script src="{{ url('public/assets/js/jquery.min.js') }}"></script>
  <!-- Bootstrap js-->
  <script src="{{ url('public/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
  <!-- feather icon js-->
  <script src="{{ url('public/assets/js/icons/feather-icon/feather.min.js') }}"></script>
  <script src="{{ url('public/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
  <!-- scrollbar js-->
  <script src="{{ url('public/assets/js/scrollbar/simplebar.js') }}"></script>
  <script src="{{ url('public/assets/js/scrollbar/custom.js') }}"></script>
  <!-- Sidebar jquery-->
  <script src="{{ url('public/assets/js/config.js') }}"></script>
  <!-- Plugins JS start-->
  <script src="{{ url('public/assets/js/sidebar-menu.js') }}"></script>
  <script src="{{ url('public/assets/js/sidebar-pin.js') }}"></script>
  <script src="{{ url('public/assets/js/slick/slick.min.js') }}"></script>
  <script src="{{ url('public/assets/js/slick/slick.js') }}"></script>
  <script src="{{ url('public/assets/js/header-slick.js') }}"></script>
  <!-- calendar js-->
  <script src="{{ url('public/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('public/assets/js/datatable/datatables/datatable.custom.js') }}"></script>

  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

  <!-- Plugins JS Ends-->
  <!-- Theme js-->
  <script src="{{ url('public/assets/js/script.js') }}"></script>
  <!-- <script src="{{ url('public/assets/js/theme-customizer/customizer.js') }}"></script> -->

  @stack('scripts')

</body>

</html>