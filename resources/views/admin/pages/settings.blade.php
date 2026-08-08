@extends('admin.layouts.app')

@section('title', 'Settings')

@push('style')
    <style>
        .edit{
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
@endpush

@section('main')
    <div class="modal fade" id="EditTimer" tabindex="-1" aria-labelledby="TimerModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importPegawaiModalLabel">Atur Timer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.settings.countdown') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="fileInput">Masukkan timer disini</label>
                            <input type="text" class="form-control" id="countdown" name="countdown" value="{{ $data->countdown }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="EditPengacakan" tabindex="-1" aria-labelledby="TimerModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importPegawaiModalLabel">Atur Jenis Urutan Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.settings.randomset') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="random-set">Pilih jenis urutan</label>
                            <select class="form-control" name="random" id="random-set">
                                @if($data->random == 0)
                                    <option value="{{ $data->random }}">Tidak Acak Soal</option>
                                    <option value="1">Acak Soal</option>
                                @elseif($data->random == 0)
                                    <option value="{{ $data->random }}">Acak Soal</option>
                                    <option value="0">Tidak Acak Soal</option>
                                @else
                                    <option value="1">Acak Soal</option>
                                    <option value="0">Tidak Acak Soal</option>
                                @endif

                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <section class="section">
            <div class="section-header" style="display: flex; justify-content: space-between; align-items: center">
                <h1>Pengaturan</h1>
                <span class="time">Waktu</span>
            </div>
            <div class="row" style="display: flex; justify-content: start;">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 position-relative">
                        <button class="btn btn-success edit" type="button" data-toggle="modal" data-target="#EditTimer"><i class="fa-solid fa-gear"></i></button>
                        <div class="card-icon bg-success">
                            <i class="far fa-clock"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pengaturan Waktu Tes</h4>
                            </div>
                            <div class="card-body">
                                {{ $data->countdown }} Menit
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 position-relative">
                        <button class="btn btn-secondary edit" type="button" data-toggle="modal" data-target="#EditPengacakan"><i class="fa-solid fa-gear"></i></button>
                        <div class="card-icon bg-secondary">
                            <i class="far fa-clock"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pengaturan Urutan Soal</h4>
                            </div>
                            <div class="card-body">
                                @if($data->random === 0)
                                    Soal Tidak Diacak
                                @elseif($data->random === 1)
                                    Soal Diacak
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 position-relative">
                        <button class="btn btn-success edit" type="button"><i class="fa-solid fa-gear"></i></button>
                        <div class="card-icon bg-success">
                            <i class="far fa-calendar-plus"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Set Pengerjaan Dibuka</h4>
                            </div>
                            <div class="card-body totalSuaraDigunakan">
                                {{ $data->session_start ?? 'fitur belum tersedia' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 position-relative">
                        <button class="btn btn-warning edit" type="button"><i class="fa-solid fa-gear"></i></button>
                        <div class="card-icon bg-warning">
                            <i class="far fa-calendar-check"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Set Pengerjaan Ditutup</h4>
                            </div>
                            <div class="card-body totalSuaraTidakSah">
                                {{ $data->session_start ?? 'fitur belum tersedia' }}
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
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
    </script>
@endpush
