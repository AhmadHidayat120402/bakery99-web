@extends('layouts.app')

@section('title', 'Katalog Produk & Harga - 99 Bakery Jember')

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
        <a href="{{ asset('catalog.pdf') }}" target="_blank" download class="btn btn-danger btn-sm shadow-sm px-3 py-2 fw-bold d-inline-flex align-items-center gap-2">
          <i class="bi bi-download fs-6"></i> Unduh Katalog (PDF)
        </a>
      </div>
    </div>
  </div>
</section>

<!-- MAIN PRODUCT CATALOG SECTION -->
<section class="py-5">
  <div class="container" id="productListApp">
    
    <!-- Search Bar & Filter Controls -->
    <div class="bg-white p-4 rounded-4 border shadow-sm mb-4">
      <div class="row g-3 align-items-center mb-3">
        <div class="col-12">
          <div class="position-relative">
            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary opacity-75 fs-5"></i>
            <input type="text" class="search search-box-input form-control form-control-lg ps-5" placeholder="Cari nama roti, brownies, bolen, kue tart, snackbox...">
          </div>
        </div>
      </div>

      <!-- Filter Category Pills -->
      <div class="d-flex flex-wrap gap-1">
        <button type="button" class="filter-category-btn active" data-cat="all">Semua Produk</button>
        <button type="button" class="filter-category-btn" data-cat="roti hajatan">Roti Hajatan & Snackbox</button>
        <button type="button" class="filter-category-btn" data-cat="aneka roti">Aneka Roti</button>
        <button type="button" class="filter-category-btn" data-cat="brownies">Brownies & Bolu</button>
        <button type="button" class="filter-category-btn" data-cat="bolen">Aneka Bolen</button>
        <button type="button" class="filter-category-btn" data-cat="donat">Donat & Dessert</button>
        <button type="button" class="filter-category-btn" data-cat="kue basah">Kue Basah</button>
        <button type="button" class="filter-category-btn" data-cat="kue tart">Kue Tart</button>
      </div>
    </div>

    <!-- PRODUCT CARDS LIST FOR LIST.JS -->
    <div class="list row g-2 g-md-4">

      <!-- 1. Paket Roti Hajatan Spesial -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="product-card">
          <div class="product-img-box">
            <span class="product-badge badge-hajatan">Best Seller Hajatan</span>
            <img src="{{ asset('img/products/roti/sobek coklat.jpg') }}" loading="lazy" class="product-img lazy-blur" alt="Paket Roti Hajatan Spesial">
          </div>
          <div class="product-body">
            <span class="product-category category">Roti Hajatan & Snackbox</span>
            <h3 class="product-title name">Paket Roti Hajatan Spesial</h3>
            <p class="product-desc desc">Kombinasi roti lembut pilihan & kue lezat yang dikemas cantik untuk berbagai konsumsi acara syukuran/pernikahan.</p>
            <div class="product-footer">
              <div>
                <div class="product-price price-display">Rp 8.000</div>
                <span class="d-none price">8000</span>
                <div class="product-price-note">per box / paket</div>
              </div>
              <button type="button" class="btn-sm-detail">Detail</button>
            </div>
          </div>
        </div>
      </div>

      <!-- 2. Snackbox Paket Rapat & Syukuran -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="product-card">
          <div class="product-img-box">
            <span class="product-badge badge-hajatan">Paket Hemat</span>
            <img src="{{ asset('img/products/roti/Pizza besar.jpg') }}" loading="lazy" class="product-img lazy-blur" alt="Snackbox Paket Rapat & Syukuran">
          </div>
          <div class="product-body">
            <span class="product-category category">Roti Hajatan & Snackbox</span>
            <h3 class="product-title name">Snackbox Paket Rapat & Syukuran</h3>
            <p class="product-desc desc">Paket praktis 2 kue + 1 roti manis + air mineral dus bersih dan elegan untuk konsumsi instansi & rapat.</p>
            <div class="product-footer">
              <div>
                <div class="product-price price-display">Rp 12.000</div>
                <span class="d-none price">12000</span>
                <div class="product-price-note">per box</div>
              </div>
              <button type="button" class="btn-sm-detail">Detail</button>
            </div>
          </div>
        </div>
      </div>

      <!-- 3. Roti Sisir Mentega Premium -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="product-card">
          <div class="product-img-box">
            <span class="product-badge badge-fresh">Fresh Daily</span>
            <img src="{{ asset('img/products/roti/sisir mini pandan.jpg') }}" loading="lazy" class="product-img lazy-blur" alt="Roti Sisir Mentega Premium">
          </div>
          <div class="product-body">
            <span class="product-category category">Aneka Roti</span>
            <h3 class="product-title name">Roti Sisir Mentega Premium</h3>
            <p class="product-desc desc">Tekstur sangat lembut beraroma harum mentega asli dengan rasa manis gurih yang memanjakan lidah.</p>
            <div class="product-footer">
              <div>
                <div class="product-price price-display">Rp 12.000</div>
                <span class="d-none price">12000</span>
                <div class="product-price-note">porsi isi 4</div>
              </div>
              <button type="button" class="btn-sm-detail">Detail</button>
            </div>
          </div>
        </div>
      </div>

      <!-- 4. Roti Sobek Isi Kombinasi -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="product-card">
          <div class="product-img-box">
            <span class="product-badge badge-fresh">Fresh Baked</span>
            <img src="{{ asset('img/products/roti/Sobek pisang.jpg') }}" loading="lazy" class="product-img lazy-blur" alt="Roti Sobek Isi Kombinasi">
          </div>
          <div class="product-body">
            <span class="product-category category">Aneka Roti</span>
            <h3 class="product-title name">Roti Sobek Isi Kombinasi</h3>
            <p class="product-desc desc">Roti sobek empuk isi coklat, keju, dan srikaya yang pas dikonsumsi hangat bersama keluarga.</p>
            <div class="product-footer">
              <div>
                <div class="product-price price-display">Rp 15.000</div>
                <span class="d-none price">15000</span>
                <div class="product-price-note">per pack</div>
              </div>
              <button type="button" class="btn-sm-detail">Detail</button>
            </div>
          </div>
        </div>
      </div>

      <!-- 5. Roti Isi Coklat Keju Soft -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="product-card">
          <div class="product-img-box">
            <span class="product-badge badge-bestseller">Favorit</span>
            <img src="{{ asset('img/products/roti/buna coklat.png') }}" loading="lazy" class="product-img lazy-blur" alt="Roti Isi Coklat Keju Soft">
          </div>
          <div class="product-body">
            <span class="product-category category">Aneka Roti</span>
            <h3 class="product-title name">Roti Isi Coklat Keju Soft</h3>
            <p class="product-desc desc">Roti perorangan dengan isian coklat lumer dan keju parut lezat yang melimpah.</p>
            <div class="product-footer">
              <div>
                <div class="product-price price-display">Rp 7.000</div>
                <span class="d-none price">7000</span>
                <div class="product-price-note">per pcs</div>
              </div>
              <button type="button" class="btn-sm-detail">Detail</button>
            </div>
          </div>
        </div>
      </div>

      <!-- 6. Fudgy Brownies Shiny Crust -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="product-card">
          <div class="product-img-box">
            <span class="product-badge badge-bestseller">Favorit</span>
            <img src="{{ asset('img/products/Brownies/panggang box.jpg') }}" loading="lazy" class="product-img lazy-blur" alt="Fudgy Brownies Shiny Crust">
          </div>
          <div class="product-body">
            <span class="product-category category">Brownies & Bolu</span>
            <h3 class="product-title name">Fudgy Brownies Shiny Crust</h3>
            <p class="product-desc desc">Brownies coklat leleh padat dengan tekstur fudgy dan taburan almond gurih renyah di atasnya.</p>
            <div class="product-footer">
              <div>
                <div class="product-price price-display">Rp 35.000</div>
                <span class="d-none price">35000</span>
                <div class="product-price-note">box medium</div>
              </div>
              <button type="button" class="btn-sm-detail">Detail</button>
            </div>
          </div>
        </div>
      </div>

      <!-- 7. Bolu Gulung Topping Keju -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="product-card">
          <div class="product-img-box">
            <span class="product-badge badge-fresh">Fresh Daily</span>
            <img src="{{ asset('img/products/Bolu/gulung hias keju.jpg') }}" loading="lazy" class="product-img lazy-blur" alt="Bolu Gulung Topping Keju">
          </div>
          <div class="product-body">
            <span class="product-category category">Brownies & Bolu</span>
            <h3 class="product-title name">Bolu Gulung Topping Keju</h3>
            <p class="product-desc desc">Bolu gulung super empuk dilapisi cream lembut dan taburan keju gondrong di seluruh bagiannya.</p>
            <div class="product-footer">
              <div>
                <div class="product-price price-display">Rp 28.000</div>
                <span class="d-none price">28000</span>
                <div class="product-price-note">1 roll</div>
              </div>
              <button type="button" class="btn-sm-detail">Detail</button>
            </div>
          </div>
        </div>
      </div>

      <!-- 8. Bolen Pisang Keju Super -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="product-card">
          <div class="product-img-box">
            <span class="product-badge badge-bestseller">Best Seller</span>
            <img src="{{ asset('img/products/Bolen/bolen box.png') }}" loading="lazy" class="product-img lazy-blur" alt="Bolen Pisang Keju Super">
          </div>
          <div class="product-body">
            <span class="product-category category">Aneka Bolen</span>
            <h3 class="product-title name">Bolen Pisang Keju Super</h3>
            <p class="product-desc desc">Pastry berlapis renyah dipadu isian pisang manis raja dan keju gurih melimpah.</p>
            <div class="product-footer">
              <div>
                <div class="product-price price-display">Rp 32.000</div>
                <span class="d-none price">32000</span>
                <div class="product-price-note">isi 10 pcs</div>
              </div>
              <button type="button" class="btn-sm-detail">Detail</button>
            </div>
          </div>
        </div>
      </div>

      <!-- 9. Bolen Coklat Melted -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="product-card">
          <div class="product-img-box">
            <span class="product-badge badge-bestseller">Lumer</span>
            <img src="{{ asset('img/products/Bolen/bolen S.jpg') }}" loading="lazy" class="product-img lazy-blur" alt="Bolen Coklat Melted Pastry">
          </div>
          <div class="product-body">
            <span class="product-category category">Aneka Bolen</span>
            <h3 class="product-title name">Bolen Coklat Melted Pastry</h3>
            <p class="product-desc desc">Kulit pastry renyah khas 99 Bakery dengan isian coklat lumer manis legit saat digigit.</p>
            <div class="product-footer">
              <div>
                <div class="product-price price-display">Rp 30.000</div>
                <span class="d-none price">30000</span>
                <div class="product-price-note">isi 10 pcs</div>
              </div>
              <button type="button" class="btn-sm-detail">Detail</button>
            </div>
          </div>
        </div>
      </div>

      <!-- 10. Donat Kentang Glaze Assorted -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="product-card">
          <div class="product-img-box">
            <span class="product-badge badge-fresh">Soft & Fluffy</span>
            <img src="{{ asset('img/products/Donat/donat topping.jpg') }}" loading="lazy" class="product-img lazy-blur" alt="Donat Kentang Glaze Assorted">
          </div>
          <div class="product-body">
            <span class="product-category category">Donat & Dessert</span>
            <h3 class="product-title name">Donat Kentang Glaze Assorted</h3>
            <p class="product-desc desc">Donat kentang empuk dengan varian topping mesis coklat, matcha, keju, dan glaze manis.</p>
            <div class="product-footer">
              <div>
                <div class="product-price price-display">Rp 6.000</div>
                <span class="d-none price">6000</span>
                <div class="product-price-note">per pcs</div>
              </div>
              <button type="button" class="btn-sm-detail">Detail</button>
            </div>
          </div>
        </div>
      </div>

      <!-- 11. Dessert Box Red Velvet -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="product-card">
          <div class="product-img-box">
            <span class="product-badge badge-bestseller">Lumer</span>
            <img src="{{ asset('img/products/Brownies/kukus coklat S cokju.jpg') }}" loading="lazy" class="product-img lazy-blur" alt="Dessert Box Red Velvet Cream">
          </div>
          <div class="product-body">
            <span class="product-category category">Donat & Dessert</span>
            <h3 class="product-title name">Dessert Box Red Velvet Cream</h3>
            <p class="product-desc desc">Lapisan cake red velvet lembut dilapisi cream cheese lumer dan taburan remahan gurih.</p>
            <div class="product-footer">
              <div>
                <div class="product-price price-display">Rp 22.000</div>
                <span class="d-none price">22000</span>
                <div class="product-price-note">box 250ml</div>
              </div>
              <button type="button" class="btn-sm-detail">Detail</button>
            </div>
          </div>
        </div>
      </div>

      <!-- 12. Kue Basah Nampan Premium -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="product-card">
          <div class="product-img-box">
            <span class="product-badge badge-hajatan">Tradisional</span>
            <img src="{{ asset('img/products/Kue Basah/Pie Buah.png') }}" loading="lazy" class="product-img lazy-blur" alt="Kue Basah Nampan Premium">
          </div>
          <div class="product-body">
            <span class="product-category category">Kue Basah</span>
            <h3 class="product-title name">Kue Basah Nampan Premium</h3>
            <p class="product-desc desc">Aneka pilihan kue basah tradisional dan modern higienis (Lemper, Pastel, Risoles, Pie Buah).</p>
            <div class="product-footer">
              <div>
                <div class="product-price price-display">Rp 10.000</div>
                <span class="d-none price">10000</span>
                <div class="product-price-note">mulai paket 3 kue</div>
              </div>
              <button type="button" class="btn-sm-detail">Detail</button>
            </div>
          </div>
        </div>
      </div>

      <!-- 13. Kue Tart Birthday Classic -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="product-card">
          <div class="product-img-box">
            <span class="product-badge badge-bestseller">Customable</span>
            <img src="{{ asset('img/products/tart/378d5ea7-0433-4872-90ed-b7cc7e646d16.jpg') }}" loading="lazy" class="product-img lazy-blur" alt="Kue Tart Birthday Classic">
          </div>
          <div class="product-body">
            <span class="product-category category">Kue Tart</span>
            <h3 class="product-title name">Kue Tart Birthday Classic</h3>
            <p class="product-desc desc">Kue ulang tahun dengan hiasan butter cream lembut, spiku lezat, dan hiasan custom cantik.</p>
            <div class="product-footer">
              <div>
                <div class="product-price price-display">Rp 85.000</div>
                <span class="d-none price">85000</span>
                <div class="product-price-note">ukuran 16cm</div>
              </div>
              <button type="button" class="btn-sm-detail">Detail</button>
            </div>
          </div>
        </div>
      </div>

      <!-- 14. Kue Tart Spiku Custom -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="product-card">
          <div class="product-img-box">
            <span class="product-badge badge-bestseller">Premium</span>
            <i class="bi bi-gift-fill product-img-icon"></i>
            <small class="text-muted position-absolute bottom-0 mb-2 fs-7" style="font-size:0.7rem;">[Slot Foto Spiku]</small>
          </div>
          <div class="product-body">
            <span class="product-category category">Kue Tart</span>
            <h3 class="product-title name">Kue Tart Spiku Lapis Custom</h3>
            <p class="product-desc desc">Spiku lapis khas dengan selai nanas/coklat harum bertekstur lembut untuk kado ulang tahun & anniversary.</p>
            <div class="product-footer">
              <div>
                <div class="product-price price-display">Rp 110.000</div>
                <span class="d-none price">110000</span>
                <div class="product-price-note">ukuran 20cm</div>
              </div>
              <button type="button" class="btn-sm-detail">Detail</button>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('vendor/listjs/list.min.js') }}"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var options = {
      valueNames: [ 'name', 'category', 'desc', 'price' ],
      listClass: 'list'
    };

    var productList = new List('productListApp', options);

    // Category filter buttons logic
    $('.filter-category-btn').on('click', function() {
      var cat = $(this).attr('data-cat');
      $('.filter-category-btn').removeClass('active');
      $(this).addClass('active');

      if (cat === 'all') {
        productList.filter();
      } else {
        productList.filter(function(item) {
          return item.values().category.toLowerCase().indexOf(cat.toLowerCase()) !== -1;
        });
      }
    });

    // Auto-filter based on URL query parameter ?cat=...
    var urlParams = new URLSearchParams(window.location.search);
    var initialCat = urlParams.get('cat');
    if (initialCat) {
      var $targetBtn = $('.filter-category-btn').filter(function() {
        return $(this).attr('data-cat').toLowerCase() === initialCat.toLowerCase();
      });
      if ($targetBtn.length) {
        $targetBtn.trigger('click');
      }
    }
  });
</script>
@endpush
