/* ==========================================================================
   99 BAKERY - INTERACTIVE JQUERY & VANILLA JS SCRIPT
   ========================================================================== */

$(document).ready(function () {
  console.log("99 Bakery Script Initialized.");

  // 1. Sticky Navbar Shadow on Scroll
  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 50) {
      $(".navbar-99").addClass("scrolled");
    } else {
      $(".navbar-99").removeClass("scrolled");
    }
  });

  // 2. Fast & Smooth Native Scrolling for Anchor Links (No lag)
  $('a[href^="#"]').on("click", function (e) {
    var href = $(this).attr("href");
    if (href.length > 1) {
      var target = $(href);
      if (target.length) {
        e.preventDefault();
        var targetPosition = target.offset().top - 80;
        window.scrollTo({
          top: targetPosition,
          behavior: "smooth"
        });
        // Close mobile menu if open
        $(".navbar-collapse").collapse("hide");
      }
    }
  });

  // 3. Quick View Product Modal & Dynamic WA Message Generator
  var currentProductData = {
    title: "",
    price: "",
    category: "",
    desc: ""
  };

  $(document).on("click", ".btn-sm-detail, .open-quickview", function (e) {
    e.preventDefault();
    var btn = $(this);
    var card = btn.closest(".product-card");

    currentProductData.title = btn.attr("data-title") || card.find(".product-title, .name").text().trim();
    currentProductData.price = btn.attr("data-price") || card.find(".product-price, .price-display").text().trim();
    currentProductData.category = btn.attr("data-category") || card.find(".product-category, .category").text().trim();
    currentProductData.desc = btn.attr("data-desc") || card.find(".product-desc, .desc").text().trim();
    var imgSrc = btn.attr("data-img") || card.find("img.product-img").attr("src");

    // Set Modal Fields
    $("#modalProductTitle").text(currentProductData.title);
    $("#modalProductCategory").text(currentProductData.category);
    $("#modalProductPrice").text(currentProductData.price);
    $("#modalProductDesc").text(currentProductData.desc);
    if (imgSrc) {
      $("#modalProductImage").attr("src", imgSrc).show();
    } else {
      $("#modalProductImage").hide();
    }
    $("#modalProductQty").val(1);

    updateModalWaLink();

    // Show Modal via Bootstrap
    var modalElem = document.getElementById("quickViewModal");
    if (modalElem) {
      var productModal = bootstrap.Modal.getOrCreateInstance(modalElem);
      productModal.show();
    }
  });

  // Listener for Qty or Outlet change inside modal
  $("#modalProductQty, #modalOutletSelect").on("change input", function () {
    updateModalWaLink();
  });

  function updateModalWaLink() {
    var qty = $("#modalProductQty").val() || 1;
    var selectedOutlet = $("#modalOutletSelect").val(); // 'tawangalun' or 'kampus'

    var phone = selectedOutlet === "kampus" ? "6285284911654" : "6285257220335";
    var outletName = selectedOutlet === "kampus" ? "Outlet Kampus (Jl. Danau Toba 8)" : "Outlet Tawang Alun (Pusat)";

    var message = "Halo 99 Bakery, saya ingin memesan produk:\n\n" +
      "📌 *Produk*: " + currentProductData.title + "\n" +
      "📦 *Jumlah*: " + qty + " paket/pcs\n" +
      "🏬 *Pilihan Outlet*: " + outletName + "\n\n" +
      "Mohon info ketersediaan & konfirmasi total pembayarannya. Terima kasih!";

    var waUrl = "https://wa.me/" + phone + "?text=" + encodeURIComponent(message);
    $("#btnSendModalWa").attr("href", waUrl);
  }

  // 4. Dynamic Outlet Status Calculator (Check current time against operational hours)
  function checkOutletStatus() {
    var now = new Date();
    var currentMinutes = now.getHours() * 60 + now.getMinutes();

    // Tawang Alun: 07:00 (420 mins) - 21:00 (1260 mins)
    var tawangOpen = 420;
    var tawangClose = 1260;

    // Kampus: 06:30 (390 mins) - 21:00 (1260 mins)
    var kampusOpen = 390;
    var kampusClose = 1260;

    // Update Tawang Alun UI
    if ($("#statusTawangAlun").length) {
      if (currentMinutes >= tawangOpen && currentMinutes < tawangClose) {
        $("#statusTawangAlun")
          .removeClass("closed")
          .addClass("open")
          .html('<span class="status-pulse"></span> Buka Sekarang (07.00 - 21.00)');
      } else {
        $("#statusTawangAlun")
          .removeClass("open")
          .addClass("closed")
          .html('<span class="status-pulse"></span> Tutup • Buka Besok 07.00');
      }
    }

    // Update Kampus UI
    if ($("#statusKampus").length) {
      if (currentMinutes >= kampusOpen && currentMinutes < kampusClose) {
        $("#statusKampus")
          .removeClass("closed")
          .addClass("open")
          .html('<span class="status-pulse"></span> Buka Sekarang (06.30 - 21.00)');
      } else {
        $("#statusKampus")
          .removeClass("open")
          .addClass("closed")
          .html('<span class="status-pulse"></span> Tutup • Buka Besok 06.30');
      }
    }
  }

    // Run status check initially
    checkOutletStatus();

    // 5. Progressive Blur-Up Lazy Load Handler
    function initLazyBlurImages() {
      var lazyImages = document.querySelectorAll("img.lazy-blur");

      if ("IntersectionObserver" in window) {
        var imageObserver = new IntersectionObserver(function (entries, observer) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              var img = entry.target;
              if (img.complete) {
                img.classList.add("loaded");
              } else {
                img.addEventListener("load", function () {
                  img.classList.add("loaded");
                });
              }
              observer.unobserve(img);
            }
          });
        });

        lazyImages.forEach(function (img) {
          imageObserver.observe(img);
        });
      } else {
        lazyImages.forEach(function (img) {
          img.classList.add("loaded");
        });
      }
    }

    initLazyBlurImages();

    // 6. Scroll To Top Button Handler
    var $scrollTopBtn = $("#scrollTopBtn");
    $(window).on("scroll", function () {
      if ($(this).scrollTop() > 300) {
        $scrollTopBtn.addClass("show");
      } else {
        $scrollTopBtn.removeClass("show");
      }
    });

    $scrollTopBtn.on("click", function (e) {
      e.preventDefault();
      $("html, body").animate({ scrollTop: 0 }, 400);
    });

    // 7. Testimonial Carousel Continuous Slider (3 cards desktop, 1 card mobile, 4+ testimonials)
    function initTestimonialSlider() {
      var $track = $("#testimonialTrack");
      if (!$track.length) return;

      var $items = $track.children(".testimonial-slide-item");
      var totalItems = $items.length;
      var currentIndex = 0;
      var autoSlideInterval = null;

      function getVisibleCount() {
        return window.innerWidth >= 768 ? 3 : 1;
      }

      function getMaxIndex() {
        var visible = getVisibleCount();
        return Math.max(0, totalItems - visible);
      }

      function updateSlider() {
        var visible = getVisibleCount();
        var maxIndex = getMaxIndex();

        if (currentIndex > maxIndex) {
          currentIndex = 0;
        }
        if (currentIndex < 0) {
          currentIndex = maxIndex;
        }

        var shiftPercentage = (currentIndex * (100 / visible));
        $track.css("transform", "translateX(-" + shiftPercentage + "%)");

        // Update dots active state
        $("#testimonialDots .testimonial-dot-item").removeClass("active");
        $("#testimonialDots .testimonial-dot-item[data-index='" + currentIndex + "']").addClass("active");
      }

      function buildDots() {
        var maxIndex = getMaxIndex();
        var dotsHtml = "";
        for (var i = 0; i <= maxIndex; i++) {
          dotsHtml += '<button class="testimonial-dot-item' + (i === currentIndex ? ' active' : '') + '" data-index="' + i + '" aria-label="Go to slide ' + (i + 1) + '"></button>';
        }
        $("#testimonialDots").html(dotsHtml);
      }

      function startAutoSlide() {
        stopAutoSlide();
        autoSlideInterval = setInterval(function () {
          var maxIndex = getMaxIndex();
          currentIndex = (currentIndex >= maxIndex) ? 0 : currentIndex + 1;
          updateSlider();
        }, 3500);
      }

      function stopAutoSlide() {
        if (autoSlideInterval) {
          clearInterval(autoSlideInterval);
        }
      }

      buildDots();
      updateSlider();
      startAutoSlide();

      $(document).off("click", "#testimonialDots .testimonial-dot-item").on("click", "#testimonialDots .testimonial-dot-item", function () {
        stopAutoSlide();
        currentIndex = parseInt($(this).attr("data-index"), 10);
        updateSlider();
        startAutoSlide();
      });

      // Pause on hover
      $(".testimonial-slider-wrapper").on("mouseenter", stopAutoSlide).on("mouseleave", startAutoSlide);

      // Responsive recalibration
      $(window).on("resize", function () {
        buildDots();
        updateSlider();
      });
    }

    initTestimonialSlider();
  });
