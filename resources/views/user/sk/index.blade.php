@extends('user.layout.app')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <div class="row align-items-center">
          <div class="col-12 col-md-8 mb-3 mb-md-0"> 
            <div class="search-bar">
            <form class="search-form d-flex" method="GET" action="{{ route('user.sk.index') }}">
              <input type="text" name="query" placeholder="Cari..." value="{{ request('query') }}" class="form-control">
              <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
            </form>
          </div>
        <h1>Data Tabel Surat Keterangan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pribadi.index') }}">Home</a></li>
                <li class="breadcrumb-item">SK</li>
            </ol>
        </nav>
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

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Surat Keterangan</h5>
                        <div class="table-responsive">
                            <table class="table text-center align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Surat</th>
                                        <th scope="col">Nama Guru</th>
                                        <th scope="col">File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sks as $sk)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td><b>{{ $sk->id }}</b>_{{ $sk->nama }}</td>
                                            <td>{{ $sk->guru->nama ?? 'Guru Tidak Ditemukan' }}</td>
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
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-muted">Data tidak ditemukan</td>
                                        </tr>
                                    @endforelse
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
