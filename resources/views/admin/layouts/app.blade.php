<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') &mdash; 99 Bakery</title>
    <link rel="shortcut icon" href="{{ asset('img/shortcut.png') }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('style')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">

    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <style>
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 50px;
            height: 30px;
            border: 1px solid #e4e6fc;
            background: #fdfdff;
            padding: 0px 15px;
        }

        .dataTables_wrapper .dataTables_filter input::focus {
            border-radius: 50px;
            height: 30px;
            border: 1px solid #e4e6fc;
            background: #fdfdff;
        }

        .dataTables_wrapper select {
            width: max-content;
            height: 30px;
            border-radius: 8px;
            padding-inline: 5px;
            /* background-color: #6777ef; */
            border: 2px solid #6777efab;
            /* color: #fff; */
        }

        .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_info {
            display: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: #6777ef;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff !important;
        }


        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #6777efaf;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.previous,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next {
            width: max-content !important;
            padding-inline: 5px !important;
        }

        .dataTables_wrapper .dataTables_paginate a.paginate_button {
            margin-right: 5px !important;
        }

        .dataTables_wrapper .dataTables_paginate .ellipsis {
            padding: 0 1em;
            display: none;
        }

        @media screen and (max-width: 480px) {
            .dataTables_wrapper .dataTables_length {
                display: none;
            }
        }

        .box-loader {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 10000;
            background-color: #00000024;
            display: none;
            justify-content: center;
            align-items: center
        }

        .loader {
            width: 70px;
            aspect-ratio: 1;
            border-radius: 50%;
            border: 8px solid #0000;
            border-right-color: #6777ef;
            position: relative;
            animation: l24 1s infinite linear;
        }

        .loader:before,
        .loader:after {
            content: "";
            position: absolute;
            inset: -8px;
            border-radius: 50%;
            border: inherit;
            animation: inherit;
            animation-duration: 2s;
        }

        .loader:after {
            animation-duration: 4s;
        }

        @keyframes l24 {
            100% {
                transform: rotate(1turn)
            }
        }
    </style>

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->
</head>
</head>

<body>
    {{-- Delete Modal --}}
    <div class="modal fade" id="logoutmodal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah kamu yakin ingin logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                    <button type="button" class="btn btn-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
                </div>

            </div>
        </div>
    </div>
    {{-- Akhir modal --}}

    <div id="app">
        <div class="main-wrapper">
            <!-- Header -->
            @include('admin.components.header')

            <!-- Sidebar -->
            @include('admin.components.sidebar')

            <!-- Content -->
            @yield('main')

            <!-- Footer -->
            @include('admin.components.footer')
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>

    @stack('scripts')

    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
