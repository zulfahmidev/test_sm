<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title class="capitalize">{{ (getCurrentPage()) ? ucfirst(getCurrentPage()) : 'Dashboard' }} - Pemesanan Kendaraan</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- Font Awesome Css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-100">
  <!-- Wrapper -->
  <div class="flex">

    <!-- Sidebar -->
    @include('includes.sidebar')
    <!-- End Sidebar -->
  
    <!-- Main -->
    <div class="w-full h-full overflow-y-scroll relative">

      <!-- Topbar -->
      @include('includes.topbar')
      <!-- End Topbar -->
    
      <!-- Content -->
      <div class="p-4">
        <div class="container m-auto">
          @yield('content')
        </div>
      </div>
      <!-- End Content -->

    </div>
    <!-- End Main -->

  </div>
  <!-- End Wrapper -->

  <!-- Font Awesome Js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

  <!-- Main Script -->
  <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>