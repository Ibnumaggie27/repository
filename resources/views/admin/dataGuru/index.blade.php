@extends('admin.layout.app')


@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <div class="row align-items-center">

          <div class="col-12 col-md-8 mb-3 mb-md-0">
            <div class="search-bar">
              <form class="search-form d-flex" method="GET" action="{{ route('admin.dataGuru.index') }}">
                <input type="text" name="query" placeholder="Cari..." value="{{ request('query') }}" class="form-control">
                <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
              </form>
            </div>
        <div>
            <h1>Data Tabel Data Guru</h1>
            <h1>Done</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item">data Guru</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="col-12 col-md-4 d-flex justify-content-md-end align-items-center gap-3 flex-wrap">
        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">Import</a>        
        <a href="{{ route('admin.dataGuru.create') }}" class="btn btn-success me-3">Tambah</a>
      </div>
    </div>
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

    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="importModalLabel">Import Data Guru</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.dataGuru.import') }}" method="POST" enctype="multipart/form-data">
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
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
    
          <div class="card">
            <div class="card-body">
                <h5 class="card-title">Daftar Guru</h5>
        
                <!-- Tabel Daftar Guru -->
                <div class="table-responsive">
                  <table class="table table-striped table-bordered text-center">
                      <thead>
                          <tr>
                              <th scope="col">#</th>
                              <th scope="col">Nama</th>
                              <th scope="col">NIP</th>
                              <th scope="col">Gambar Ijazah</th>
                              <th scope="col">Gambar KTP</th>
                              <th scope="col">Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($dataGurus as $dataGuru)
                              <tr>
                                  <th scope="row">{{ $loop->iteration }}</th>
                                  <td>{{ $dataGuru->nama }}</td>
                                  <td>{{ $dataGuru->nip }}</td>
                                  <td>
                                      @if($dataGuru->gambar_ijazah)
                                          <img src="{{ asset('storage/' . $dataGuru->gambar_ijazah) }}" alt="Ijazah" style="width: 100px; height: 100px; object-fit: contain;">
                                      @else
                                          <span>No Image</span>
                                      @endif
                                  </td>
                                  <td>
                                      @if($dataGuru->gambar_ktp)
                                          <img src="{{ asset('storage/' . $dataGuru->gambar_ktp) }}" alt="KTP" style="width: 100px; height: 100px; object-fit: contain;">
                                      @else
                                          <span>No Image</span>
                                      @endif
                                  </td>
                                  <td>
                                      <div class="btn-group" role="group">
                                          <!-- Edit Button -->
                                          <a href="{{ route('admin.dataGuru.edit', $dataGuru->id) }}" class="btn btn-warning btn-sm" title="Edit Data Guru">
                                              Edit
                                          </a>
                                          
                                          <!-- Delete Button -->
                                          <form action="{{ route('admin.dataGuru.destroy', $dataGuru->id) }}" method="POST" style="display:inline;">
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
                {{ $dataGurus->links('pagination::bootstrap-4') }}
              </nav>
            </div>
        </div>
    
        </div>
      </div>
    </section>

</main>
  @endsection