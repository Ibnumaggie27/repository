@extends('admin.layout.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <div class="row align-items-center">
          <div class="col-12 col-md-8 mb-3 mb-md-0">
    <div>
        <div class="search-bar">
            <form class="search-form d-flex" method="GET" action="{{ route('admin.mutasiSiswa.index') }}">
              <input type="text" name="query" placeholder="Cari..." value="{{ request('query') }}" class="form-control">
              <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
            </form>
          </div>
        <h1>Data Tabel Mutasi Siswa</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="i{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item">Mutasi Siswa</li>
            </ol>
        </nav>
    </div>
  </div><!-- End Page Title -->
  </div><!-- End Page Title -->
  </div><!-- End Page Title -->
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
      <div class="col-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Daftar Siswa</h5>
            
            <!-- Card untuk Mutasi Masuk -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Siswa Masuk</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $masuk }}</h5>
                            <p class="card-text">Jumlah siswa yang baru masuk.</p>
                        </div>
                    </div>
                </div>

                <!-- Card untuk Mutasi Keluar -->
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-header">Siswa Keluar</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $keluar }}</h5>
                            <p class="card-text">Jumlah siswa yang keluar.</p>
                        </div>
                    </div>
                </div>

                <!-- Card untuk Mutasi Lulus -->
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Siswa Lulus</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $lulus }}</h5>
                            <p class="card-text">Jumlah siswa yang lulus.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Daftar Siswa -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswas as $siswa)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->nisn }}</td>
                            <td>{{ $siswa->kelas }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" style="display:inline;">
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
