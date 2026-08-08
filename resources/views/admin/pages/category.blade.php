@extends('admin.layouts.app')

@section('title', 'Kategori')

@push('style')
    <!-- Tambahkan CSS untuk DataTables -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tabel Kategori</h1>
                <div class="section-header-breadcrumb mb-3 mb-md-0">
                    <!-- Tombol untuk membuka modal -->
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#createCategoryModal">Tambah
                        Kategori</a>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table-md table" id="categoryTable">
                                        <thead>
                                            <tr>
                                                {{-- <th><input type="checkbox" id="selectAll"></th> --}}
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataAll as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->description }}</td>
                                                    <td>
                                                        @if ($data->is_active)
                                                            <span class="badge badge-success">Aktif</span>
                                                        @else
                                                            <span class="badge badge-secondary">Nonaktif</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning btn-edit"
                                                            data-toggle="modal" data-target="#editCategory"
                                                            data-id="{{ $data->id }}"><i
                                                                class="fas fa-edit"></i></button>
                                                        @if ($data->sheet1 != 'selesai' && $data->sheet2 != 'selesai' && $data->sheet3 != 'selesai')
                                                            <a href="#" class="btn btn-danger btn-delete"
                                                                data-id="{{ $data->id }}" data-toggle="modal"
                                                                data-target="#deleteCategoryModal"><i
                                                                    class="fas fa-trash"></i></a>
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

    <!-- Modal untuk create data kategori -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog"
        aria-labelledby="createCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryModalLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCreateCategory" action="{{ route('admin.kategori.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Kategori</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                placeholder="contoh. Bolu">
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" required rows="5"
                                placeholder="contoh. Bolu coklat"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status Kategori</label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                                    value="1" checked>

                                <label class="custom-control-label" for="is_active">
                                    Aktif
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" form="formCreateCategory">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit kategori -->
    <div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit
                        Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditCategory" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="edit_nama">Nama Kategori</label>
                            <input type="text" class="form-control" id="edit_nama" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_description">Deskripsi</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status Kategori</label>

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="edit_is_active" name="is_active"
                                    value="1">

                                <label class="custom-control-label" for="edit_is_active">
                                    Aktif
                                </label>
                            </div>
                        </div>
                        <input type="hidden" id="edit_id">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Hapus Kategori -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategoryModalLabel">Hapus Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus kategori ini?</p>
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
            $('#categoryTable').DataTable({
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
                var actionUrl = "{{ route('admin.kategori.destroy', ':id') }}".replace(':id', id);

                $('#deleteForm').attr('action', actionUrl); // Set form action
            });

            // Edit
            $(document).on("click", ".btn-edit", function() {
                let id = $(this).data("id"); // Ambil ID kategori dari atribut data-id
                $("#edit_id").val(id); // Set ID ke input hidden

                // Atur URL form edit
                $("#formEditCategory").attr("action", "{{ route('admin.kategori.update', ':id') }}"
                    .replace(':id', id));

                // Ambil data kategori dari backend
                $.ajax({
                    url: "{{ route('admin.kategori.edit', ':id') }}".replace(':id', id),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Isi nilai form dengan data dari backend
                        $("#edit_nama").val(data.name);
                        $("#edit_description").val(data.description);
                        $("#edit_is_active").prop("checked", data.is_active);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert("Terjadi kesalahan saat mengambil data kategori.");
                    }
                });
            });



        });
    </script>
@endpush
