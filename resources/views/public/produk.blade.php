@extends('public.layouts.app')

@section('title', 'Katalog Produk & Harga - 99 Bakery Jember')
@section('meta_description', 'Katalog lengkap roti hajatan, brownies, bolen pisang, donat, kue basah, dan snackbox murah berkualitas di 99 Bakery Jember.')

@section('content')
<!-- BREADCRUMB & HEADER -->
<section class="bg-warm-section py-4 border-bottom">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-2 small">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-danger fw-semibold">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Katalog Produk</li>
      </ol>
    </nav>
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-md-between gap-3">
      <div>
        <h1 class="h2 fw-extrabold mb-1">Katalog Produk 99 Bakery</h1>
        <p class="text-muted mb-0 small">Temukan varian pilihan roti hajatan, brownies, bolen, kue basah, dessert, dan kue tart fresh setiap hari.</p>
      </div>
      <div>
        <a href="{{ asset('pdf/catalog.pdf') }}" target="_blank" download class="btn btn-danger btn-sm shadow-sm px-3 py-2 fw-bold d-inline-flex align-items-center gap-2">
          <i class="bi bi-download fs-6"></i> Unduh Katalog (PDF)
        </a>
      </div>
    </div>
  </div>
</section>

<!-- MAIN PRODUCT CATALOG SECTION -->
<section class="py-5">
  <div class="container" id="productListApp">

    <!-- Search Bar & Category Filter Pills -->
    <div class="bg-white p-4 rounded-4 border shadow-sm mb-4">
      <div class="mb-3">
        <div class="position-relative">
          <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary opacity-75 fs-5"></i>
          <input type="text" class="search search-box-input form-control form-control-lg ps-5" placeholder="Cari nama roti, brownies, bolen, kue tart, snackbox...">
        </div>
      </div>

      <!-- Filter Category Pills (Instant List.js Filter) -->
      <div class="d-flex flex-wrap gap-1">
        <button type="button" class="filter-category-btn active" data-cat="all">Semua Produk</button>
        @foreach($categories as $cat)
          <button type="button" class="filter-category-btn" data-cat="{{ $cat->slug }}">{{ $cat->name }}</button>
        @endforeach
      </div>
    </div>

    <!-- PRODUCT CARDS GRID FOR LIST.JS -->
    <div class="list row g-3 g-md-4">
      @forelse($products as $product)
      <div class="col-6 col-md-4 col-lg-3 d-flex align-items-stretch product-item">
        <div class="product-card w-100">
          <div class="product-img-box">
            @if($product->badge)
              <span class="product-badge shadow-sm" style="background-color: {{ $product->badge->bg_color }}; color: {{ $product->badge->text_color }}; font-size: 0.72rem;">
                @if($product->badge->icon)<i class="{{ $product->badge->icon }} me-1"></i>@endif{{ $product->badge->name }}
              </span>
            @endif
            <img src="{{ asset($product->image) }}" loading="lazy" class="product-img lazy-blur" alt="{{ $product->name }}">
          </div>
          <div class="product-body">
            <span class="category-slug d-none">{{ $product->category->slug ?? '' }}</span>
            <span class="product-category category">{{ $product->category->name ?? 'Aneka Roti' }}</span>
            <h3 class="product-title name">{{ $product->name }}</h3>
            <p class="product-desc desc">{{ $product->description }}</p>
            <div class="product-footer">
              <div>
                <div class="product-price price-display">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                <div class="product-price-note">per {{ $product->unit }}</div>
              </div>
              <button type="button" class="btn-sm-detail"
                data-title="{{ $product->name }}"
                data-price="Rp {{ number_format($product->price, 0, ',', '.') }}"
                data-category="{{ $product->category->name ?? 'Roti' }}"
                data-desc="{{ $product->description }}"
                data-img="{{ asset($product->image) }}">Detail</button>
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12 text-center py-5">
        <div class="bg-white p-5 rounded-4 shadow-sm border max-w-md mx-auto">
          <i class="bi bi-box-seam fs-1 text-danger mb-2 d-block"></i>
          <h5 class="fw-bold text-dark mb-1">Produk Belum Tersedia</h5>
          <p class="text-muted small mb-0">Belum ada item roti yang dapat ditampilkan di katalog saat ini.</p>
        </div>
      </div>
      @endforelse
    </div>

  </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('vendor/listjs/list.min.js') }}"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // 1. Initialize List.js on #productListApp
    var options = {
      valueNames: [ 'name', 'category', 'desc', 'category-slug' ],
      listClass: 'list'
    };

    var productList = new List('productListApp', options);

    // 2. Client-side Category Filter Event Listener (Instant Without Page Reload)
    $('.filter-category-btn').on('click', function() {
      var cat = $(this).attr('data-cat');
      $('.filter-category-btn').removeClass('active');
      $(this).addClass('active');

      if (cat === 'all') {
        productList.filter();
      } else {
        productList.filter(function(item) {
          var itemSlug = (item.values()['category-slug'] || '').toLowerCase();
          var itemCatName = (item.values()['category'] || '').toLowerCase();
          var targetCat = cat.toLowerCase();
          return itemSlug === targetCat || itemCatName.includes(targetCat);
        });
      }
    });

    // 3. Auto-filter when coming from Home Page link (e.g., /produk?cat=roti-hajatan-snack-box)
    var urlParams = new URLSearchParams(window.location.search);
    var initialCat = urlParams.get('cat');
    if (initialCat && initialCat !== 'all') {
      var $targetBtn = $('.filter-category-btn[data-cat="' + initialCat + '"]');
      if ($targetBtn.length) {
        $targetBtn.trigger('click');
      } else {
        // Fallback matching slug / name
        $('.filter-category-btn').each(function() {
          if ($(this).attr('data-cat').toLowerCase() === initialCat.toLowerCase()) {
            $(this).trigger('click');
            return false;
          }
        });
      }
    }

    // 4. Progressive Blur Lazy Loader with IntersectionObserver
    function initLazyBlurImages() {
      var lazyImages = document.querySelectorAll('.lazy-blur-img[data-src]');

      var loadImage = function(img) {
        var actualSrc = img.getAttribute('data-src');
        if (!actualSrc) return;

        var tempImg = new Image();
        tempImg.src = actualSrc;

        tempImg.onload = function() {
          img.src = actualSrc;
          img.removeAttribute('data-src');
          img.classList.add('img-loaded');
        };

        tempImg.onerror = function() {
          img.src = actualSrc;
          img.removeAttribute('data-src');
          img.classList.add('img-loaded');
        };
      };

      if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function(entries, obs) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              loadImage(entry.target);
              obs.unobserve(entry.target);
            }
          });
        }, { rootMargin: '200px 0px' });

        lazyImages.forEach(function(img) { observer.observe(img); });
      } else {
        lazyImages.forEach(function(img) { loadImage(img); });
      }
    }

    initLazyBlurImages();

    // Re-trigger lazy loader when List.js filters or searches
    productList.on('updated', function() {
      initLazyBlurImages();
    });
  });
</script>
@endpush
