<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'CMS Admin - 99 Bakery Jember')</title>

  <!-- Favicon / Logo -->
  <link rel="icon" type="image/jpeg" href="{{ asset('img/logo.jpeg') }}">

  <!-- Google Fonts: Outfit (Heading) & Plus Jakarta Sans (Body) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap 5.3 CSS -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}">

  <!-- Base Custom Style & Admin Style -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/admin-style.css') }}">
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

  <!-- Bootstrap 5.3 JS Bundle -->
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Custom Admin JS -->
  <script src="{{ asset('admin/js/admin.js') }}"></script>
  @stack('scripts')
</body>

</html>
