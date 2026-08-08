@extends('admin.layouts.auth')

@section('title', 'Login')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="card card-success">
        <div class="card-header">
            <h3>Login</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('loginPost') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                    <label for="name">name</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" required autofocus value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block" tabindex="4">
                        LOGIN
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
