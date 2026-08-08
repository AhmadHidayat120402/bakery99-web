@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('style')
    <style>
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header" style="display: flex; justify-content: space-between; align-items: center">
                <h1>Dashboard</h1>
                <span class="time">Time</span>
            </div>
            <div class="row" style="display: flex; justify-content: start;">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Produk</h4>
                            </div>
                            <div class="card-body totalSuara">
                                {{-- {{ $data }} --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Kategori</h4>
                            </div>
                            <div class="card-body totalSuara">
                                {{-- {{ $data }} --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Suara Digunakan</h4>
                            </div>
                            <div class="card-body totalSuaraDigunakan">
                                00
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-circle-xmark"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tidak Memilih</h4>
                            </div>
                            <div class="card-body totalSuaraTidakSah">
                                00
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            {{-- <div class="row">
                <div class="col-lg-6 col-md-12 col-12 order-md-3 order-lg-2 order-3 mt-md-3 mt-lg-0 mt-3">
                    <div class="card" style="height: 100%; display: flex; justify-content: center; align-items: center;">
                        <canvas id="myChart4" style="height: 100%"></canvas>
                    </div>
                </div>
            </div> --}}
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        function getWaktuJakarta() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                timeZone: 'Asia/Jakarta'
            };

            const tanggal = now.toLocaleDateString('id-ID', options);
            const jam = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false,
                timeZone: 'Asia/Jakarta'
            }).replace(/:/g, '.');

            return `${tanggal} ${jam}`;
        }

        document.querySelector('.time').innerHTML = getWaktuJakarta();

        setInterval(() => {
            document.querySelector('.time').innerHTML = getWaktuJakarta();
        }, 1000);
    </script>


    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script>
        function fetchDataAndUpdateChart() {
            $.ajax({
                url: '/admin/getdashboardata',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    myChart.data.datasets[0].data = [
                        data.suara_calon2,
                        data.suara_calon1
                    ];
                    myChart.update();

                    $('.totalSuara').text(data.total_suara);
                    $('.totalSuaraDigunakan').text(data.suara_digunakan);
                    $('.totalSuaraTidakSah').text(data.suara_tidaksah);
                    $('.perolehansuaraurut1').text(`${data.suara_calon1} Suara`);
                    $('.perolehansuaraurut2').text(`${data.suara_calon2} Suara`);
                }
            });
        }

        setInterval(fetchDataAndUpdateChart, 1000);

        // Inisialisasi chart
        var ctx = document.getElementById("myChart4").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        50,
                        50,
                    ],
                    backgroundColor: [
                        '#937AFF',
                        '#F8DB46',
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    'JUMLAH SUARA BUDI SANTOSO',
                    'JUMLAH SUARA GIANTORO',
                ],
            },
            options: {
                responsive: true,
                legend: {
                    display: false
                },
            }
        });
    </script>
@endpush
