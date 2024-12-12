@extends('admin.layout.app')

@section('content')
<main id="main" class="main">
  <!-- Page Title -->
  <div class="pagetitle">
    <div class="row align-items-center">
      <div class="col-12 col-md-8 mb-3 mb-md-0">
        <div class="search-bar">
          <form class="search-form d-flex" method="GET" action="{{ route('admin.siswa.index') }}">
            <input type="text" name="query" placeholder="Cari..." value="{{ request('query') }}" class="form-control">
            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
          </form>
        </div>
        <h1 class="mt-3 text-center text-md-start">Data Tabel Mutasi Siswa</h1>
        <h1 class="mt-3 text-center text-md-start">Done</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Mutasi Siswa</li>
          </ol>
        </nav>
      </div>
      <div class="col-12 col-md-4 d-flex justify-content-md-end gap-2 flex-wrap">
        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">Import</a>
        <a href="{{ route('admin.siswa.export') }}" class="btn btn-primary">Export</a>
        <a href="{{ route('admin.siswa.create') }}" class="btn btn-success">Tambah</a>
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

  <!-- Import Modal -->
  <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="importModalLabel">Import Data Siswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="file" class="form-label">Pilih File</label>
              <input type="file" class="form-control" id="file" name="file" accept=".xlsx,.csv" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Data Table -->
  <section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Daftar Siswa</h5>
            <div class="table-responsive">
              <table class="table table-striped table-bordered text-center">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($siswas as $siswa)
                  <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->nisn }}</td>
                    <td>{{ $siswa->kelas }}</td>
                    <td>
                      <div class="btn-group" role="group">
                        <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" class="d-inline">
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
              {{ $siswas->links('pagination::bootstrap-4') }}
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
