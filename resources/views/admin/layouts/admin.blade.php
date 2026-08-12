<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'CMS Admin - 99 Bakery Jember')</title>

  <!-- Favicon / Logo -->
  <link rel="icon" type="image/jpeg" href="{{ asset('img/logo.jpeg') }}">

  <!-- Local Web Fonts: Fraunces (Heading) & Plus Jakarta Sans (Body) -->
  <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}">

  <!-- Bootstrap 5.3 CSS -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}">

  <!-- Base Custom Style & Admin Style -->
  <link rel="stylesheet" href="{{ asset('css/style.css?v=') . date('is') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/admin-style.css?v=') . date('is') }}">
  @stack('styles')
</head>

<body class="admin-body">

  <div class="admin-wrapper">

    <!-- SIDEBAR -->
    @include('admin.partials.sidebar')

    <!-- MAIN CONTENT AREA -->
    <main class="admin-main">

      <!-- TOPBAR HEADER -->
      @include('admin.partials.topbar')

      <!-- BODY CONTENT -->
      <div class="admin-body-content">
        @yield('content')
      </div>

      <!-- FOOTER -->
      @include('admin.partials.footer')

    </main>

  </div>

  <!-- jQuery, List.js & Bootstrap 5.3 JS Bundle -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/listjs/list.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Custom Admin JS -->
  <script src="{{ asset('admin/js/admin.js') }}"></script>
  @stack('scripts')
</body>

</html>
