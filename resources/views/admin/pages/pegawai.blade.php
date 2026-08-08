@extends('admin.layouts.app')

@section('title', 'Pegawai')

@push('style')
    <!-- Tambahkan CSS untuk DataTables -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tabel Peserta</h1>
                <div class="section-header-breadcrumb mb-3 mb-md-0">
                    <!-- Tombol untuk membuka modal -->
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#createPegawaiModal">Tambah
                        Peserta</a>
                </div>
                <div class="ml-lg-3 ml-md-3 ml-0">
                    <a href="{{ route('pegawai.downloadFormat') }}" class="btn btn-success">
                        Download Format
                    </a>
                </div>
                <div class="ml-lg-3 ml-md-3 ml-0">
                    <button type="button" class="btn btn-success" data-toggle="modal"
                        data-target="#importPegawaiModal">Import Peserta</button>
                </div>
                {{-- <div class="ml-lg-3 ml-md-3 ml-0">
                    <button type="button" class="btn btn-primary" id="sendEmailsButton">Kirim Email ke Peserta
                        Terpilih</button>
                </div> --}}
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
                                                {{-- <th><input type="checkbox" id="selectAll"></th> --}}
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>NIP</th>
                                                <th>Username</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataAll as $data)
                                                <tr>
                                                    {{-- <td>
                                                        @if ($data->sheet1 != 'selesai' && $data->sheet2 != 'selesai' && $data->sheet3 != 'selesai')
                                                            <input type="checkbox" class="selectItem"
                                                                value="{{ $data->email }}">
                                                        @endif
                                                    </td> --}}
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->email }}</td>
                                                    <td>{{ $data->nip }}</td>
                                                    <td>{{ $data->username }}</td>
                                                    <td>
                                                        @if ($data->gender == 'L')
                                                            Laki-Laki
                                                        @elseif ($data->gender == 'P')
                                                            Perempuan
                                                        @else
                                                            Tidak Diketahui
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($data->sheet1 == 'selesai' && $data->sheet2 == 'selesai' && $data->sheet3 == 'selesai')
                                                            Selesai Test
                                                        @elseif ($data->status == 'terkirim')
                                                            Terkirim
                                                        @else
                                                            Belum Selesai
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning btn-edit"
                                                            data-toggle="modal" data-target="#editPegawai"
                                                            data-id="{{ $data->id }}"><i
                                                                class="fas fa-edit"></i></button>
                                                        @if ($data->sheet1 != 'selesai' && $data->sheet2 != 'selesai' && $data->sheet3 != 'selesai')
                                                            <a href="#" class="btn btn-danger btn-delete"
                                                                data-id="{{ $data->id }}" data-toggle="modal"
                                                                data-target="#deletePegawaiModal"><i
                                                                    class="fas fa-trash"></i></a>
                                                            {{-- <button type="button" class="btn btn-success btn-send-email"
                                                                data-id="{{ $data->id }}"
                                                                data-email="{{ $data->email }}">
                                                                <i class="fas fa-envelope"></i> Kirim Email
                                                            </button> --}}
                                                        @endif
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

    <div class="modal fade" id="importPegawaiModal" tabindex="-1" aria-labelledby="importPegawaiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importPegawaiModalLabel">Import Pegawai dari Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.pegawai.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="fileInput">Pilih File Excel</label>
                            <input type="file" class="form-control" id="fileInput" name="file" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk create data pegawai -->
    <div class="modal fade" id="createPegawaiModal" tabindex="-1" role="dialog" aria-labelledby="createPegawaiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPegawaiModalLabel">Tambah Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCreatePegawai" action="{{ route('admin.pegawai.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Pegawai</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                placeholder="contoh. Nama Pegawai BKD Sidoarjo">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                placeholder="contoh. contoh@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" required
                                placeholder="contoh. 99170024">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required
                                placeholder="contoh. Username BKD Sidoarjo">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required
                                placeholder="contoh. Password BKD Sidoarjo">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                            <input type="text" class="form-control" id="pendidikan_terakhir"
                                name="pendidikan_terakhir" required placeholder="contoh. S1 Teknik Informatika">
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" required
                                placeholder="contoh. Staff IT">
                        </div>
                        <div class="form-group">
                            <label for="instansi">Instansi</label>
                            <input type="text" class="form-control" id="instansi" name="instansi" required
                                placeholder="contoh. BKD Sidoarjo">
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="" disabled selected>Pilih Jenis Role</option>
                                <option value="admin">Admin</option>
                                <option value="peserta">Peserta</option>
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="no_whatsapp">Nomor Whatsapp</label>
                            <input type="text" class="form-control" id="no_whatsapp" name="no_whatsapp" required
                                placeholder="contoh. 086765654345">
                        </div> --}}
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea class="form-control" id="address" name="address" required rows="5"
                                placeholder="Jl 1 Imam Bonjol, Sidoarjo"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" form="formCreatePegawai">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pegawai -->
    <div class="modal fade" id="editPegawai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPegawaiModalLabel">Edit
                        Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditPegawai" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="edit_nama">Nama Pegawai</label>
                            <input type="text" class="form-control" id="edit_nama" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_email">Email</label>
                            <input type="text" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_nip">NIP</label>
                            <input type="text" class="form-control" id="edit_nip" name="nip" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_username">Username</label>
                            <input type="text" class="form-control" id="edit_username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="edit_password">Password</label>
                            <input type="password" class="form-control" id="edit_password" name="password">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
                        </div>
                        <div class="form-group">
                            <label for="edit_tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="edit_tanggal_lahir" name="tanggal_lahir">
                        </div>
                        <div class="form-group">
                            <label for="edit_pendidikan_terakhir">Pendidikan Terakhir</label>
                            <input type="text" class="form-control" id="edit_pendidikan_terakhir"
                                name="pendidikan_terakhir">
                        </div>
                        <div class="form-group">
                            <label for="edit_jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="edit_jabatan" name="jabatan">
                        </div>
                        <div class="form-group">
                            <label for="edit_instansi">Instansi</label>
                            <input type="text" class="form-control" id="edit_instansi" name="instansi">
                        </div>
                        <div class="form-group">
                            <label for="edit_gender">Jenis Kelamin</label>
                            <select class="form-control" id="edit_gender" name="gender" required>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_role">Role</label>
                            <select class="form-control" id="edit_role" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="peserta">Peserta</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_address">Alamat</label>
                            <textarea class="form-control" id="edit_address" name="address" rows="5"></textarea>
                        </div>
                        <input type="hidden" id="edit_id">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Hapus Pegawai -->
    <div class="modal fade" id="deletePegawaiModal" tabindex="-1" role="dialog"
        aria-labelledby="deletePegawaiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePegawaiModalLabel">Hapus Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus pegawai ini?</p>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- Tambahkan JS untuk DataTables -->
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            $('#pegawaiTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,

            });


            $(document).on('click', '.btn-delete', function() {
                var id = $(this).data('id'); // Ambil ID dari tombol
                var actionUrl = "{{ route('admin.pegawai.destroy', ':id') }}".replace(':id', id);

                $('#deleteForm').attr('action', actionUrl); // Set form action
            });





            $(document).ready(function() {

                $('#selectAll').on('click', function() {
                    $('.selectItem').prop('checked', this.checked);
                });

                // Jika ada checkbox yang di-uncheck, hapus centang dari "Pilih Semua"
                $('.selectItem').on('click', function() {
                    if ($('.selectItem:checked').length === $('.selectItem').length) {
                        $('#selectAll').prop('checked', true);
                    } else {
                        $('#selectAll').prop('checked', false);
                    }
                });


                $('#sendEmailsButton').on('click', function() {
                    let selectedEmails = [];
                    $('.selectItem:checked').each(function() {
                        selectedEmails.push($(this).val());
                    });

                    if (selectedEmails.length === 0) {
                        alert("Pilih setidaknya satu peserta untuk mengirim email.");
                        return;
                    }

                    $.ajax({
                        url: "{{ route('admin.sendEmails') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            emails: selectedEmails
                        },
                        success: function(response) {
                            alert('Email berhasil dikirim ke semua peserta!');
                            location.reload();

                            $('.selectItem:checked').each(function() {
                                let row = $(this).closest(
                                    'tr');
                                row.find('.statusText').text(
                                    'Undangan Terkirim');
                            });

                            // $('.selectItem').prop('checked', false);
                            // $('#selectAll').prop('checked', false);
                        },

                        error: function(xhr, status, error) {
                            alert('Terjadi kesalahan dalam mengirim email!');
                        }
                    });
                });
            });

            // send email to one user
            $(document).ready(function() {
                $('.btn-send-email').click(function() {
                    let userId = $(this).data('id');
                    let userEmail = $(this).data('email');

                    if (confirm(`Kirim email ke ${userEmail}?`)) {
                        $.ajax({
                            url: "{{ route('admin.pegawai.sendEmail', ':id') }}".replace(':id', userId),
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                alert(response.message);
                                location.reload();
                                row.find('.statusText').text(response.status);
                            },
                            error: function(xhr) {
                                alert('Terjadi kesalahan saat mengirim email!');
                            }
                        });
                    }
                });
            });

            // Edit
            $(document).on("click", ".btn-edit", function() {
                let id = $(this).data("id"); // Ambil ID Pegawai dari atribut data-id
                $("#edit_id").val(id); // Set ID ke input hidden

                // Atur URL form edit
                $("#formEditPegawai").attr("action", "{{ route('admin.pegawai.update', ':id') }}".replace(':id', id));

                // Ambil data pegawai dari backend
                $.ajax({
                    url: "{{ route('admin.pegawai.edit', ':id') }}".replace(':id', id),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi nilai form dengan data dari backend
                        $("#edit_nama").val(data.name);
                        $("#edit_email").val(data.email);
                        $("#edit_nip").val(data.nip);
                        $("#edit_username").val(data.username);
                        $("#edit_tanggal_lahir").val(data.tanggal_lahir);
                        $("#edit_pendidikan_terakhir").val(data.pendidikan_terakhir);
                        $("#edit_jabatan").val(data.jabatan);
                        $("#edit_instansi").val(data.instansi);
                        $("#edit_gender").val(data.gender);
                        $("#edit_role").val(data.role);
                        $("#edit_address").val(data.address);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert("Terjadi kesalahan saat mengambil data pegawai.");
                    }
                });
            });



        });
    </script>
@endpush
