@extends('admin.layout.app')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <div class="row align-items-center">

        <div class="col-12 col-md-8 mb-3 mb-md-0">
          <div class="search-bar">
            <form class="search-form d-flex" method="GET" action="{{ route('admin.absen.index') }}">
                <input type="text" name="query" placeholder="Cari..." value="{{ request('query') }}" class="form-control">
                <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
            </form>
          </div>
        <div>
            <h1>Data Tabel Absensi</h1>
            <h1>done</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item">Absensi</li>
                </ol>
            </nav>
        </div>
    </div>
        <div class="col-12 col-md-4 d-flex justify-content-md-end gap-1 flex-wrap">
            <a href="{{ route('admin.absen.create') }}" class="btn btn-success me-3">Tambah</a>
        </div>

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
        <!-- Modal Import Absensi -->
        <div class="modal fade" id="importAbsensiModal" tabindex="-1" aria-labelledby="importAbsensiModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importAbsensiModalLabel">Import Absensi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('import.absensi') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file" class="form-label">Pilih File Excel</label>
                                <input type="file" class="form-control" id="file" name="file" required accept=".xlsx,.xls">
                            </div>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div><!-- End Page Title -->

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
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">file</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensis as $absensi)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td><b>{{ $absensi->id }}</b>_{{ $absensi->nama }}</td>
                                        <td>
                                            @if(Storage::exists('public/' . $absensi->file_path))
                                                <a href="{{ asset('storage/' . $absensi->file_path) }}" 
                                                   class="btn btn-success btn-sm" 
                                                   download="{{ $absensi->nama }}.{{ pathinfo($absensi->file_path, PATHINFO_EXTENSION) }}">
                                                    Download
                                                </a>
                                            @else
                                                <span class="badge bg-danger">File Tidak Ditemukan</span>
                                            @endif
                                        </td>  
                                        <td>
                                            <div class="btn-group" role="group">
                                            <a href="{{ route('admin.absen.edit', $absensi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('admin.absen.destroy', $absensi->id) }}" method="POST" style="display:inline;">
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
                            {{ $absensis->links('pagination::bootstrap-4') }}
                          </nav>
                        <!-- End Default Table Example -->
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
@endsection
