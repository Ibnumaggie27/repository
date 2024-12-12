@extends('admin.layout.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle d-flex justify-content-between align-items-center">
        <div>
            <h1>Input Data Absensi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href=" {{ route('admin.absen.index') }}">Data Abnsensi</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Absensi</h5>

                        <!-- Form Input -->
                        <form action="{{ route('admin.absen.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama File</label>
                                <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">File Absensi</label>
                                <input type="file" name="file" class="form-control" id="file" required>
                                @error('file') 
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- End Form Input -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection
