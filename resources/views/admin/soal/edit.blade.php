@extends('admin.layout.app')

@section('content')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Soal</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.soal.index') }}">Bank Soal</a></li>
            <li class="breadcrumb-item active">Edit Soal</li>
        </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
              <h5 class="card-title">Form Edit Soal</h5>

              <!-- Form Edit Soal -->
              <form action="{{ route('admin.soal.update', $soal->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="row g-3">
                      <div class="col-md-12">
                          <label for="nama" class="form-label">nama File</label>
                          <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $soal->nama) }}" required>
                      </div>
                      <div class="col-md-12">
                          <label for="file" class="form-label">Upload File (Opsional)</label>
                          <input type="file" class="form-control" id="file" name="file">
                          <small class="form-text text-muted">Jika tidak ingin mengganti file, biarkan kosong.</small>
                      </div>
                  </div>

                  <div class="text-center mt-3">
                      <button type="submit" class="btn btn-primary">Update</button>
                      <a href="{{ route('admin.soal.index') }}" class="btn btn-secondary">Kembali</a>
                  </div>
              </form>
              <!-- End Form Edit Soal -->
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
