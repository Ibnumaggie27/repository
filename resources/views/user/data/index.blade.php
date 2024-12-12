@extends('user.layout.app')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <div class="row align-items-center">

          <div class="col-12 col-md-8 mb-3 mb-md-0">
            <div class="search-bar">
              <form class="search-form d-flex" method="GET" action="{{ route('data.index') }}">
                <input type="text" name="query" placeholder="Cari..." value="{{ request('query') }}" class="form-control">
                <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
              </form>
            </div>
        <div>
            <h1>Data Tabel Data Guru</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pribadi.index') }}">Home</a></li>
                    <li class="breadcrumb-item">data Guru</li>
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
                <h5 class="card-title">Daftar Guru</h5>
        
                <!-- Tabel Responsif -->
                <div class="table-responsive">
                    <table class="table text-center align-middle">
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
                                        <a href="{{ route('user.data.detail', $dataGuru->id) }}" class="btn btn-info btn-sm">Detail</a>
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
