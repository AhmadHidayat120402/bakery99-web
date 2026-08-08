@extends('admin.layouts.app')

@section('title', 'Hasil Tes')

@push('style')
    <!-- Tambahkan CSS untuk DataTables -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <div class="modal fade" id="chartModal" tabindex="-1" aria-labelledby="chartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="chartModalLabel">Download Hasil Test</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <canvas id="myChart"></canvas>
                </div>
                <div class="modal-footer">
                    <form method="POST" id="formDownloadPDF" action="report/2/download">
                        @csrf
                        <input type="text" name="chartBase64" id="chartBase64" hidden>
                        <span class="mr-2" id="status-download" style="font-size: .8em"><i
                                class='fa-solid fa-circle-xmark' style="color: #fc544b"></i> Sedang Menyiapkan PDF</span>
                        <button type="submit" id="modal-download-pdf" class="btn btn-success">Download PDF</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tabel Hasil Tes</h1>
                <div class="section-header-breadcrumb mb-3 mb-md-0">
                    <div class="ml-lg-3 ml-md-3 ml-0">
                        <a href="{{ route('export.hasil.tes') }}" class="btn btn-primary">Export Hasil Tes</a>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table-md table" id="pegawaiTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>NIP</th>
                                                <th>Hasil Tes</th>
                                                <th>Skoring</th>
                                                <th>Report</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataAll as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->user->name }}</td>
                                                    <td>{{ $data->user->nip }}</td>
                                                    <td>
                                                        <button class="btn btn-success" data-toggle="modal"
                                                            data-target="#modalHasilTes-{{ $data->user_id }}">
                                                            Lihat Hasil
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success" data-toggle="modal"
                                                            data-target="#modalSkoring-{{ $data->user_id }}">
                                                            Lihat Skoring
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success download-pdf" data-toggle="modal"
                                                            data-target="#chartModal"
                                                            data-id="{{ $data->user->id }}">Download PDF</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    @foreach ($dataAll as $data)
        <!-- Modal untuk User -->
        <div class="modal fade" id="modalHasilTes-{{ $data->user_id }}" tabindex="-1"
            aria-labelledby="modalLabel-{{ $data->user_id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel-{{ $data->user_id }}">Hasil Tes {{ $data->user->name }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <h5 class="ml-4" id="modalLabel-{{ $data->user_id }}">Tanggal Tes :
                        {{ \Carbon\Carbon::parse($data->user->start_test)->format('d-m-Y') }}</h5>
                    <div class="modal-body">
                        @php
                            $groupedResults = $dataResultTest
                                ->where('user_id', $data->user_id)
                                ->groupBy('question.sheet');

                            $kodeSoalNamaLengkap = [
                                'R' => 'REALISTIC',
                                'I' => 'INVESTIGATIVE',
                                'A' => 'ARTISTIC',
                                'S' => 'SOCIAL',
                                'E' => 'ENTERPRISING',
                                'C' => 'CONVENTIONAL',
                            ];

                        @endphp

                        @foreach ($groupedResults as $sheet => $results)
                            <h5 class="mt-3">Sheet {{ $sheet }}</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Soal</th>
                                        <th>Pertanyaan</th>
                                        <th>Jawaban</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $loopIndex => $result)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td> <!-- Nomor soal -->
                                            <td>{{ $kodeSoalNamaLengkap[$result->question->code] ?? $result->question->code }}
                                                ({{ $result->question->code }})</td>
                                            <td>{{ $result->question->question }}</td>
                                            <td>{{ $result->multiple_choice }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($dataAll as $data)
        <!-- Modal untuk User -->
        <div class="modal fade" id="modalSkoring-{{ $data->user_id }}" tabindex="-1"
            aria-labelledby="modalLabel-{{ $data->user_id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel-{{ $data->user_id }}">Hasil Skoring {{ $data->user->name }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle; text-align: center;" rowspan="2">Sheet</th>
                                    @foreach (['R' => 'REALISTIC', 'I' => 'INVESTIGATIVE', 'A' => 'ARTISTIC', 'S' => 'SOCIAL', 'E' => 'ENTERPRISING', 'C' => 'CONVENTIONAL'] as $kode => $nama)
                                        <th colspan="2" style="text-align: center;">{{ $nama }}
                                            ({{ $kode }})
                                        </th>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach (['R', 'I', 'A', 'S', 'E', 'C'] as $kode)
                                        <th style="text-align: center;">Ya</th>
                                        <th style="text-align: center;">Tidak</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // Filter berdasarkan user_id
                                    $userResults = $dataResultTest->where('user_id', $data->user_id);

                                    // Inisialisasi grand total
                                    $grandTotalYa = 0;
                                    $grandTotalTidak = 0;
                                    $grandTotalKodeYa = ['R' => 0, 'I' => 0, 'A' => 0, 'S' => 0, 'E' => 0, 'C' => 0];
                                    $grandTotalKodeTidak = ['R' => 0, 'I' => 0, 'A' => 0, 'S' => 0, 'E' => 0, 'C' => 0];
                                @endphp

                                @foreach ($userResults->groupBy('question.sheet') as $sheet => $results)
                                    @php
                                        // Inisialisasi total untuk masing-masing kode
                                        $totalPerKodeYa = ['R' => 0, 'I' => 0, 'A' => 0, 'S' => 0, 'E' => 0, 'C' => 0];
                                        $totalPerKodeTidak = [
                                            'R' => 0,
                                            'I' => 0,
                                            'A' => 0,
                                            'S' => 0,
                                            'E' => 0,
                                            'C' => 0,
                                        ];

                                        foreach ($results as $result) {
                                            $kode = $result->question->code;

                                            if (isset($totalPerKodeYa[$kode]) && !is_null($result->multiple_choice)) {
                                                if (strtolower($result->multiple_choice) === 'ya') {
                                                    $totalPerKodeYa[$kode] += 1;
                                                } elseif (strtolower($result->multiple_choice) === 'tidak') {
                                                    $totalPerKodeTidak[$kode] += 1;
                                                }
                                            }
                                        }

                                        // Update Grand Total
                                        foreach (['R', 'I', 'A', 'S', 'E', 'C'] as $kode) {
                                            $grandTotalYa += $totalPerKodeYa[$kode];
                                            $grandTotalTidak += $totalPerKodeTidak[$kode];
                                            $grandTotalKodeYa[$kode] += $totalPerKodeYa[$kode];
                                            $grandTotalKodeTidak[$kode] += $totalPerKodeTidak[$kode];
                                        }
                                    @endphp

                                    <tr>
                                        <td style="vertical-align: middle; text-align: center;">Sheet {{ $sheet }}
                                        </td>
                                        @foreach (['R', 'I', 'A', 'S', 'E', 'C'] as $kode)
                                            <td style="text-align: center;">{{ $totalPerKodeYa[$kode] }}</td>
                                            <td style="text-align: center;">{{ $totalPerKodeTidak[$kode] }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach

                                <!-- Baris Total -->
                                <tr class="font-weight-bold">
                                    <td style="text-align: center;">Total per Kode</td>
                                    @foreach (['R', 'I', 'A', 'S', 'E', 'C'] as $kode)
                                        <td style="text-align: center;">{{ $grandTotalKodeYa[$kode] }}</td>
                                        <td style="text-align: center;">{{ $grandTotalKodeTidak[$kode] }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>

                        @php
                            // Urutkan kode berdasarkan jumlah "Ya" terbanyak
                            $sortedYa = collect($grandTotalKodeYa)->sortDesc();
                            $top3Ya = $sortedYa
                                ->filter(function ($value, $key) use ($sortedYa) {
                                    return $value >= $sortedYa->values()->take(3)->last();
                                })
                                ->keys();

                            // Urutkan kode berdasarkan jumlah "Tidak" terbanyak
                            $sortedTidak = collect($grandTotalKodeTidak)->sortDesc();
                            $top3Tidak = $sortedTidak
                                ->filter(function ($value, $key) use ($sortedTidak) {
                                    return $value >= $sortedTidak->values()->take(3)->last();
                                })
                                ->keys();
                        @endphp

                        @php
                            $kodeNames = [
                                'R' => 'REALISTIC',
                                'I' => 'INVESTIGATIVE',
                                'A' => 'ARTISTIC',
                                'S' => 'SOCIAL',
                                'E' => 'ENTERPRISING',
                                'C' => 'CONVENTIONAL',
                            ];
                        @endphp
                        <!-- Menampilkan Ranking 3 Tertinggi (Ya) -->
                        <div class="mt-3">
                            <h5>Pilihlah Rangking 3 Nilai Tertinggi (Jawaban Ya)</h5>
                            <ol>
                                @foreach ($top3Ya as $index => $kode)
                                    @if ($index >= 3)
                                    @break
                                @endif
                                <li>{{ $kodeNames[$kode] }} ({{ $kode }}) - {{ $grandTotalKodeYa[$kode] }}
                                </li>
                            @endforeach
                        </ol>
                    </div>

                    <!-- Menampilkan Ranking 3 Terendah (Tidak) -->
                    <div class="mt-3">
                        <h5>Pilihlah Rangking 3 Nilai Terendah (Jawaban Tidak)</h5>
                        <ol>
                            @foreach ($top3Tidak as $index => $kode)
                                @if ($index >= 3)
                                @break
                            @endif
                            <li>{{ $kodeNames[$kode] }} ({{ $kode }}) - {{ $grandTotalKodeTidak[$kode] }}
                            </li>
                        @endforeach
                    </ol>
                </div>

            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
@push('scripts')
<script>
    var ctx = document.getElementById("myChart").getContext("2d");

    const data = {
        labels: ['Realistic', 'Investigative', 'Artistic', 'Social', 'Enterprising', 'Conventional'],
        datasets: [{
            data: [50, 50, 50, 50, 50, 50], // Pastikan data ini dinamis jika diperlukan
            backgroundColor: 'rgba(180,239,194,0.53)',
            borderColor: '#47c363',
            borderWidth: 2
        }]
    };

    const options = {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    min: 0,
                    max: 100,
                    stepSize: 10,
                    fontSize: 14,
                    fontColor: "#333"
                }
            }],
            xAxes: [{
                ticks: {
                    fontSize: 14,
                    fontStyle: 'bold'
                }
            }]
        },
        legend: {
            display: false // Menyembunyikan legend
        }
    };

    Chart.plugins.register({
        afterDraw: function(chart) {
            let ctx = chart.ctx;
            chart.data.datasets.forEach((dataset, i) => {
                let meta = chart.getDatasetMeta(i);
                if (!meta.hidden) {
                    meta.data.forEach((element, index) => {
                        let data = dataset.data[index]; // Nilai dari dataset
                        ctx.fillStyle = '#333'; // Warna teks
                        ctx.font = 'bold 14px Arial'; // Gaya teks
                        ctx.textAlign = 'center';

                        // Ambil posisi koordinat tiap batang
                        let x = element._model.x;
                        let y = element._model.y - 5; // Atur posisi teks di atas batang

                        ctx.fillText(data, x, y);
                    });
                }
            });
        }
    });

    const barChart = new Chart(ctx, {
        type: 'bar',
        data,
        options,
    });

    function fetchDataAndUpdateChart(idpeserta) {
        $.ajax({
            url: "{{ route('admin.hasilTes.data', ':peserta') }}".replace(':peserta', idpeserta),
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                let newData = [data.R, data.I, data.A, data.S, data.E, data.C];

                // console.log("Data baru:", newData);

                // Update data di chart
                barChart.data.datasets[0].data = newData;

                // Pastikan grafik diupdate ulang
                barChart.update();
            },
            error: function(xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
    }


    $(document).on('click', '.download-pdf', function(e) {
        let id = $(this).data('id');
        // console.info('id ' + id)
        $("#formDownloadPDF").attr('action', `report/${id}/download`);

        fetchDataAndUpdateChart(id);
        setInterval(() => {
            let inputcheck = $('#chartBase64').val();
            if (inputcheck === "") {
                $('#status-download').html(
                    "<i class='fa-solid fa-circle-xmark' style='color: #fc544b'></i></i> Sedang Menyiapkan PDF"
                );
            } else {
                $('#status-download').html(
                    "<i class='fa-solid fa-circle-check' style='color: #47c363'></i> PDF Siap Diprint"
                );
            }
        }, 500)

        let inputchartBase64 = document.getElementById('chartBase64');
        inputchartBase64.value = '';
        setTimeout(() => {
            let image = barChart.toBase64Image();
            inputchartBase64.value = image.split(',')[1];
        }, 1500);
    });
</script>
@endpush
