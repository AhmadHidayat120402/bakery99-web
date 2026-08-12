<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hasil Batch Compress Gambar - 99 Bakery</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <style>
    body { background-color: #f8f9fa; font-family: 'Segoe UI', system-ui, sans-serif; padding-top: 40px; padding-bottom: 60px; }
    .card-metric { border: none; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .bg-gradient-red { background: linear-gradient(135deg, #C62828, #E53935); color: #fff; }
  </style>
</head>
<body>
  <div class="container" style="max-width: 900px;">
    
    <div class="text-center mb-4">
      <div class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1.5 rounded-pill mb-2">
        <i class="bi bi-check-circle-fill me-1"></i> BATCH COMPRESS SUCCESSFUL
      </div>
      <h2 class="fw-bold text-dark">Hasil Kompresi Seluruh Gambar produk</h2>
      <p class="text-muted">Seluruh gambar pada <code>public/img/products</code> telah dikompresi ke WebP dan jalur database diperbarui otomatis.</p>
    </div>

    <!-- METRIC CARDS -->
    <div class="row g-3 mb-4">
      <div class="col-6 col-md-3">
        <div class="card card-metric p-3 text-center bg-white">
          <span class="text-muted small d-block">Jumlah Berkas</span>
          <h3 class="fw-bold text-dark mb-0 mt-1">{{ $total_files }}</h3>
          <small class="text-secondary" style="font-size: 0.75rem;">Foto Diproses</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card card-metric p-3 text-center bg-white">
          <span class="text-muted small d-block">Ukuran Asli</span>
          <h3 class="fw-bold text-danger mb-0 mt-1">{{ $total_original }}</h3>
          <small class="text-secondary" style="font-size: 0.75rem;">Total Sebelum</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card card-metric p-3 text-center bg-white">
          <span class="text-muted small d-block">Ukuran Baru</span>
          <h3 class="fw-bold text-success mb-0 mt-1">{{ $total_compressed }}</h3>
          <small class="text-secondary" style="font-size: 0.75rem;">Total Sesudah</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card card-metric p-3 text-center bg-gradient-red">
          <span class="text-white-50 small d-block">Penghematan</span>
          <h3 class="fw-bold text-white mb-0 mt-1">{{ $total_savings }}%</h3>
          <small class="text-white-50" style="font-size: 0.75rem;">Ruang Dihemat</small>
        </div>
      </div>
    </div>

    <!-- TABLE DETAILS -->
    <div class="card card-metric bg-white overflow-hidden mb-4">
      <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
        <h6 class="fw-bold text-dark mb-0"><i class="bi bi-file-earmark-zip me-2 text-danger"></i> Rincian Berkas Diproses</h6>
        <span class="badge bg-light text-dark border">WebP 800px / Quality 75%</span>
      </div>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Pratinjau</th>
              <th>Jalur Berkas Baru</th>
              <th>Ukuran Asli</th>
              <th>Ukuran Baru</th>
              <th>Hemat</th>
            </tr>
          </thead>
          <tbody>
            @forelse($results as $item)
            <tr>
              <td class="fw-bold text-muted">{{ $loop->iteration }}</td>
              <td>
                <img src="{{ asset($item['new_path']) }}" style="width: 55px; height: 40px; object-fit: cover; border-radius: 6px;" alt="Compressed preview">
              </td>
              <td>
                <span class="fw-semibold text-dark d-block" style="font-size: 0.82rem;">{{ $item['name'] }}</span>
                <code style="font-size: 0.75rem;">{{ $item['new_path'] }}</code>
              </td>
              <td class="text-muted"><del>{{ $item['old_size_formatted'] }}</del></td>
              <td class="fw-bold text-success">{{ $item['new_size_formatted'] }}</td>
              <td>
                <span class="badge bg-success-subtle text-success border border-success-subtle fw-bold">
                  -{{ $item['savings_percent'] }}%
                </span>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center py-4 text-muted">Tidak ada berkas yang diproses.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div class="d-flex justify-content-center gap-3">
      <a href="{{ route('home') }}" class="btn btn-danger px-4 py-2 rounded-pill fw-bold">
        <i class="bi bi-house-door-fill me-1"></i> Kembali ke Beranda
      </a>
      <a href="{{ route('admin.produk') }}" class="btn btn-outline-dark px-4 py-2 rounded-pill fw-bold">
        <i class="bi bi-box-seam-fill me-1"></i> Kelola CMS Produk
      </a>
    </div>

  </div>
</body>
</html>
