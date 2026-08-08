@extends('layouts.app-form')

<title>SP INKA</title>
@section('section')
    <style>
        .boxtimeout {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            background-color: #ffe0e0;
            padding: 25px 15px;
            border-radius: 8px;
        }

        .boxtimeout h1,
        .boxtimeout span {
            text-align: center;
            margin-block: 6px;
        }

        .boxtimeout i {
            margin-bottom: 14px;
            font-size: 40px;
        }
    </style>
    <section id="form1">
        <div class="container-fluid">
            <div class="jumbotron">
                <img src="{{ asset('form/img/jumbotron.png') }}" loading="lazy">
            </div>
            <div class="boxtimeout">
                <i class="fa-regular fa-circle-xmark"></i>
                <h1>Pemilihan Ketua Umum Serikat Pekerja Tahun 2024-2027</h1>
                <span>Waktu pemilihan adalah <b>{{ $formatawalpemilihan }}</b> sampai
                    <b>{{ $formatakhirpemilihan }}</b></span>
                <span>
                    <br>
                    <b>Tim KPU SP INKA</b>
                </span>
            </div>

        </div>
    </section>
    <script script script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script>
        @if (session('fail'))
            // swal('Perhatian', 'NIP dan Kode Pemilih tidak valid!', 'error');
            swal({
                title: 'Perhatian',
                text: '{{ session('fail') }}',
                icon: "error",
                timer: 3000,
                button: false,
            });
        @endif
    </script>
@endsection
