@extends('user.layout.app')

@section('content')
<main id="main" class="main">
  <div class="pagetitle">
      <div class="row align-items-center">
        <div class="col-12 col-md-8 mb-3 mb-md-0">
          <div class="search-bar">
            <form class="search-form d-flex" method="GET" action="{{ route('user.soal.index') }}">
              <input type="text" name="query" placeholder="Cari..." value="{{ request('query') }}" class="form-control">
              <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
            </form>
          </div>
    <div>
        <h1>Data Tabel Soal</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pribadi.index') }}">Home</a></li>
                <li class="breadcrumb-item">Bank Soal</li>
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
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
              <h5 class="card-title">Daftar Soal</h5>

              <!-- Tabel Daftar Soal -->
              <div class="table-responsive">
                <table class="table text-center align-middle">
                  <thead>
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nama File</th>
                          <th scope="col">File</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($soals as $soal)
                          <tr>
                              <th scope="row">{{ $loop->iteration }}</th>
                              <td><b>{{ $soal->id }}</b>_{{ $soal->nama }}</td>
                              <td>
                                @if(Storage::exists('public/' . $soal->file_path))
                                    <a href="{{ asset('storage/' . $soal->file_path) }}" 
                                       class="btn btn-success btn-sm" 
                                       download="{{ $soal->nama }}.{{ pathinfo($soal->file_path, PATHINFO_EXTENSION) }}">
                                        Download
                                    </a>
                                @else
                                    <span class="badge bg-danger">File Tidak Ditemukan</span>
                                @endif
                            </td> 
                          </tr>
                      @endforeach
                  </tbody>
              </table>
              </div>
            <nav class="d-flex justify-content-center mt-3">
              {{ $soals->links('pagination::bootstrap-4') }}
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
@endsection
