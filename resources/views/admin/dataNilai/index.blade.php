@extends('admin.layout.app')


@section('content')
<main id="main" class="main">
  <div class="pagetitle">
    <div class="row align-items-center">
      <!-- Kolom Kiri -->
      <div class="col-12 col-md-8 mb-3 mb-md-0">
        <div class="search-bar">
          <form class="search-form d-flex" method="GET" action="{{ route('admin.dataNilai.index') }}">
            <input type="text" name="query" placeholder="Cari..." value="{{ request('query') }}" class="form-control">
            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
          </form>
        </div>
        <div>
          <h1 class="mt-3">Data Tabel Data Nilai</h1>
          <h1 class="mt-3">done</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item">Data Nilai</li>
            </ol>
          </nav>
        </div>
      </div>
  
      <!-- Kolom Kanan (Tombol Sebelah Kanan) -->
      <div class="col-12 col-md-4 d-flex justify-content-md-end align-items-center gap-3 flex-wrap">
        <a href="{{ route('admin.dataNilai.create') }}" class="btn btn-success me-3">Tambah</a>
      </div>
    </div>
  </div>
  
 <!-- Alert Messages -->
 @if (session('success'))
 <div class="alert alert-success alert-dismissible fade show" role="alert">
   {{ session('success') }}
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>
 @endif

 @if (session('error'))
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
   {{ session('error') }}
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>
 @endif
    <section class="section">
      <div class="row">
          <div class="col-lg-12">

              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Daftar Absensi Siswa</h5>

                      <!-- Tabel Daftar Absensi -->
                <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                          <thead>
                              <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Nama File</th>
                                  <th scope="col">File</th>
                                  <th scope="col">Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($nilais as $nilai)
                                  <tr>
                                      <th scope="row">{{ $loop->iteration }}</th>
                                      <td><b>{{ $nilai->id }}</b>_{{ $nilai->nama }}</td>
                                      <td>
                                        @if(Storage::exists('public/' . $nilai->file_path))
                                            <a href="{{ asset('storage/' . $nilai->file_path) }}" 
                                               class="btn btn-success btn-sm" 
                                               download="{{ $nilai->nama }}.{{ pathinfo($nilai->file_path, PATHINFO_EXTENSION) }}">
                                                Download
                                            </a>
                                        @else
                                            <span class="badge bg-danger">File Tidak Ditemukan</span>
                                        @endif
                                    </td>  
                                      <td>
                                        <div class="btn-group" role="group">
                                          <a href="{{ route('admin.dataNilai.edit', $nilai->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                          <form action="{{ route('admin.dataNilai.destroy', $nilai->id) }}" method="POST" style="display:inline;">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                          </form>
                                        </div>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                </div>
                      <nav class="d-flex justify-content-center mt-3">
                        {{ $nilais->links('pagination::bootstrap-4') }}
                      </nav>
                  </div>
              </div>

          </div>
      </div>
  </section>

</main>
  @endsection