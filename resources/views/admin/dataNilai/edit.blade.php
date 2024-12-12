@extends('admin.layout.app')

@section('content')
<main id="main" class="main">

  <div class="pagetitle d-flex justify-content-between align-items-center">
    <div>
        <h1>Edit Data Nilai</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dataNilai.index') }}">Data Nilai</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Form Edit Data Nilai</h5>

            <!-- Form Edit -->
            <form action="{{ route('admin.dataNilai.update', $nilais->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama', $nilais->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">File Nilai</label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" id="file">
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if($nilais->file_path)
                        <small class="form-text text-muted">File saat ini: <a href="{{ asset('storage/' . $nilais->file_path) }}" target="_blank">Lihat File</a></small>
                    @endif
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('admin.dataNilai.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
            <!-- End Form Edit -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main>
@endsection
