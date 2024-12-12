@extends('admin.layout.app')

@section('content')
<main id="main" class="main">
  <!-- Page Title -->
  <div class="pagetitle">
    <div class="row align-items-center">
      <div class="col-12 col-md-8 mb-3 mb-md-0"> 
        <div class="search-bar">
        <form class="search-form d-flex" method="GET" action="{{ route('admin.sk.index') }}">
          <input type="text" name="query" placeholder="Cari..." value="{{ request('query') }}" class="form-control">
          <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
        </form>
      </div>
        <h1 class="mt-3 text-center text-md-start">Data Tabel Surat Keterangan</h1>
        <h1 class="mt-3 text-center text-md-start">done</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">SK</li>
          </ol>
        </nav>
      </div>
      <div class="col-12 col-md-4 d-flex justify-content-md-end gap-2 flex-wrap">
        <a href="{{ route('admin.sk.create') }}" class="btn btn-success me-3">Tambah</a>
      </div>
    </div>
  </div>
  <!-- End Page Title -->

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

  <!-- Data Table -->
  <section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Daftar Surat Keterangan</h5>
            <div class="table-responsive">
              <table class="table table-striped table-bordered text-center">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Nama Surat</th>
                          <th>Nama Guru</th>
                          <th>File</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($sks as $sk)
                          <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td><b>{{ $sk->id }}</b>_{{ $sk->nama }}</td>
                              <td>
                                  <span data-bs-toggle="tooltip" title="Guru: {{ $sk->guru->nama ?? 'Tidak Ditemukan' }}">
                                      {{ $sk->guru->nama ?? 'Guru Tidak Ditemukan' }}
                                  </span>
                              </td>
                              <td>
                                @if(Storage::exists('public/' . $sk->file_path))
                                    <a href="{{ asset('storage/' . $sk->file_path) }}" 
                                       class="btn btn-success btn-sm" 
                                       download="{{ $sk->nama }}.{{ pathinfo($sk->file_path, PATHINFO_EXTENSION) }}">
                                        Download
                                    </a>
                                @else
                                    <span class="badge bg-danger">File Tidak Ditemukan</span>
                                @endif
                            </td>                            
                              <td>
                                  <div class="btn-group" role="group">
                                      <a href="{{ route('admin.sk.edit', $sk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                      <form action="{{ route('admin.sk.destroy', $sk->id) }}" method="POST" class="d-inline">
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
              {{ $sks->links('pagination::bootstrap-4') }}
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
