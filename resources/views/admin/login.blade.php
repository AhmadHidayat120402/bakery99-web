<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin - 99 Bakery Jember</title>

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

  <style>
    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: radial-gradient(circle at top right, rgba(198, 40, 40, 0.08), transparent 40%),
                  radial-gradient(circle at bottom left, rgba(255, 179, 0, 0.1), transparent 40%),
                  var(--bg-section-warm);
      padding: 1.5rem;
    }

    .login-card {
      background: #FFFFFF;
      border: 1px solid var(--border-color);
      border-radius: var(--radius-lg);
      box-shadow: 0 16px 40px rgba(198, 40, 40, 0.08);
      max-width: 420px;
      width: 100%;
      overflow: hidden;
    }

    .login-header {
      background: linear-gradient(135deg, var(--primary-red), var(--primary-dark));
      color: #FFFFFF;
      padding: 2.25rem 2rem 2rem;
      text-align: center;
      position: relative;
    }

    .login-brand-img {
      width: 90px;
      height: auto;
      border-radius: 12px;
      border: 2px solid #FFFFFF;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
      object-fit: cover;
      margin-bottom: 1rem;
    }

    .login-title {
      color: #fff
      font-family: var(--font-heading);
      font-weight: 800;
      font-size: 1.4rem;
      margin-bottom: 2px;
    }

    .login-subtitle {
      font-size: 0.82rem;
      opacity: 0.9;
    }

    .login-body {
      padding: 2rem;
    }
  </style>
</head>

<body class="admin-body">

  <div class="login-container">
    <div class="login-card">
      <div class="login-header">
        <img src="{{ asset('img/logo.jpeg') }}" alt="99 Bakery Logo" class="login-brand-img">
        <h4 class="login-title">99 BAKERY JEMBER</h4>
        <p class="login-subtitle mb-0">Portal Masuk Admin Landing Page</p>
      </div>

      <div class="login-body">
        <form action="{{ route('admin.dashboard') }}" method="GET">
          <div class="mb-3">
            <label class="form-label small fw-bold text-dark">Email / Username Admin</label>
            <div class="input-group">
              <span class="input-group-text bg-light border-end-0"><i class="bi bi-person-fill text-muted"></i></span>
              <input type="email" class="form-control border-start-0 ps-0" value="" placeholder="admin@99bakery.com" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label small fw-bold text-dark">Kata Sandi (Password)</label>
            <div class="input-group">
              <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock-fill text-muted"></i></span>
              <input type="password" id="passwordInput" class="form-control border-start-0 border-end-0 ps-0" value="" placeholder="" required>
              <button class="btn btn-light border border-start-0" type="button" onclick="const p = document.getElementById('passwordInput'); p.type = p.type === 'password' ? 'text' : 'password'; this.querySelector('i').classList.toggle('bi-eye-fill'); this.querySelector('i').classList.toggle('bi-eye-slash-fill');">
                <i class="bi bi-eye-fill text-muted"></i>
              </button>
            </div>
          </div>

          <div class="d-flex justify-content-between align-items-center mb-4" style="font-size: 0.83rem;">
            <div class="form-check mb-0">
              <input class="form-check-input" type="checkbox" id="rememberMe" checked>
              <label class="form-check-label text-muted" for="rememberMe">Ingat Saya</label>
            </div>
            <a href="#" onclick="alert('Silakan hubungi Super Admin untuk mereset kata sandi Anda.'); return false;" class="text-danger fw-semibold text-decoration-none">Lupa Password?</a>
          </div>

          <button type="submit" class="btn btn-danger w-100 py-2 rounded-pill fw-bold text-white shadow-sm" style="background-color: var(--primary-red); border: none;">
            Login
          </button>
        </form>

        <div class="mt-4 pt-3 border-top text-center" style="font-size: 0.8rem;">
          <a href="{{ route('home') }}" class="text-muted text-decoration-none"><i class="bi bi-arrow-left me-1"></i> Kembali ke Website Publik</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5.3 JS Bundle -->
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
