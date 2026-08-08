@extends('layouts.app')

@section('title', 'Pegawai')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pengaturan Pemilihan</h1>
                <div class="section-header-breadcrumb mb-3 mb-md-0">
                    <!-- Tombol untuk membuka modal -->
                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editPemilhan">Edit Waktu
                        Pemilihan</a>
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
                                                <th>Waktu Pemilihan Dimulai</th>
                                                <th>Waktu Pemilihan Ditutup</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataAll as $data)
                                                <tr>
                                                    <td>{{ $data->awal_pemilihan }}</td>
                                                    <td>{{ $data->akhir_pemilihan }}</td>
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


    <!-- Modal Edit Pegawai -->
    <div class="modal fade" id="editPemilhan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPegawaiModalLabel">Edit Pelaksanaan Pemilihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach ($dataAll as $data)
                        <form id="formEditPegawai" method="POST" action="set-pemilihan/{{ $data->id }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="awalpemilihan">Waktu Pemilhan</label>
                                <input type="text" class="form-control" id="awalpemilihan" name="awal_pemilihan" required
                                    maxlength="19" placeholder="YYYY-MM-DD HH:MM:SS" value="{{ $data->awal_pemilihan }}">
                            </div>
                            <div class="form-group">
                                <label for="akhirpemilihan">Akhir Pemilhan</label>
                                <input type="text" class="form-control" id="akhirpemilihan" name="akhir_pemilihan"
                                    required maxlength="19" placeholder="YYYY-MM-DD HH:MM:SS"
                                    value="{{ $data->akhir_pemilihan }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan
                                Perubahan</button>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('#awalpemilihan').on('input', function() {
                let input = $(this).val().replace(/\D/g, ''); // Hanya angka
                if (input.length > 14) {
                    input = input.substring(0, 14); // Batasi maksimal 14 karakter (YYYYMMDDHHMMSS)
                }

                // Format ulang menjadi YYYY-MM-DD HH:MM:SS
                let formattedDateTime = input;
                if (input.length >= 4) {
                    formattedDateTime = input.substring(0, 4) + '-' + input.substring(4);
                }
                if (input.length >= 6) {
                    formattedDateTime = formattedDateTime.substring(0, 7) + '-' + formattedDateTime
                        .substring(7);
                }
                if (input.length >= 8) {
                    formattedDateTime = formattedDateTime.substring(0, 10) + ' ' + formattedDateTime
                        .substring(10);
                }
                if (input.length >= 10) {
                    formattedDateTime = formattedDateTime.substring(0, 13) + ':' + formattedDateTime
                        .substring(13);
                }
                if (input.length >= 12) {
                    formattedDateTime = formattedDateTime.substring(0, 16) + ':' + formattedDateTime
                        .substring(16);
                }

                $(this).val(formattedDateTime);
            });
            $('#akhirpemilihan').on('input', function() {
                let input = $(this).val().replace(/\D/g, ''); // Hanya angka
                if (input.length > 14) {
                    input = input.substring(0, 14); // Batasi maksimal 14 karakter (YYYYMMDDHHMMSS)
                }

                // Format ulang menjadi YYYY-MM-DD HH:MM:SS
                let formattedDateTime = input;
                if (input.length >= 4) {
                    formattedDateTime = input.substring(0, 4) + '-' + input.substring(4);
                }
                if (input.length >= 6) {
                    formattedDateTime = formattedDateTime.substring(0, 7) + '-' + formattedDateTime
                        .substring(7);
                }
                if (input.length >= 8) {
                    formattedDateTime = formattedDateTime.substring(0, 10) + ' ' + formattedDateTime
                        .substring(10);
                }
                if (input.length >= 10) {
                    formattedDateTime = formattedDateTime.substring(0, 13) + ':' + formattedDateTime
                        .substring(13);
                }
                if (input.length >= 12) {
                    formattedDateTime = formattedDateTime.substring(0, 16) + ':' + formattedDateTime
                        .substring(16);
                }

                $(this).val(formattedDateTime);
            });
        });
    </script>
@endpush
