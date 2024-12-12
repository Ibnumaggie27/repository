@extends('user.layout.app')

@section('content')
<main id="main" class="main">

    <!-- Page Title -->
    <div class="pagetitle">
        <h1 class="fw-bold">Detail Data Guru</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pribadi.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('data.index') }}">Data Guru</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <!-- Card -->
                <div class="card shadow rounded-3 border-0">
                    <div class="card-header bg-primary text-white text-center rounded-top">
                        <h4 class="mb-0 fw-semibold">Informasi Detail Guru</h4>
                    </div>
                    <div class="card-body">
                        <div class="row gy-4 px-3">
                            <!-- Nama -->
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase">Nama:</h6>
                                <p class="text-muted mb-0">{{ $dataGurus->nama }}</p>
                            </div>
    
                            <!-- NIP -->
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase">NIP:</h6>
                                <p class="text-muted mb-0">{{ $dataGurus->nip }}</p>
                            </div>
    
                            <!-- Tempat Lahir -->
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase">Tempat Lahir:</h6>
                                <p class="text-muted mb-0">{{ $dataGurus->tempat_lahir }}</p>
                            </div>
    
                            <!-- Tanggal Lahir -->
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase">Tanggal Lahir:</h6>
                                <p class="text-muted mb-0">{{ $dataGurus->tanggal_lahir }}</p>
                            </div>
    
                            <!-- Jenis Kelamin -->
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase">Jenis Kelamin:</h6>
                                <p class="text-muted mb-0">{{ $dataGurus->jk == 'l' ? 'Laki-Laki' : 'Perempuan' }}</p>
                            </div>
    
                            <!-- Agama -->
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase">Agama:</h6>
                                <p class="text-muted mb-0">{{ ucfirst($dataGurus->agama) }}</p>
                            </div>
    
                            <!-- Alamat -->
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase">Alamat:</h6>
                                <p class="text-muted mb-0">{{ $dataGurus->alamat }}</p>
                            </div>
    
                            <!-- No HP -->
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase">No HP:</h6>
                                <p class="text-muted mb-0">{{ $dataGurus->no_hp ?? 'Tidak tersedia' }}</p>
                            </div>
    
                            <!-- Email -->
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase">Email:</h6>
                                <p class="text-muted mb-0">{{ $dataGurus->email ?? 'Tidak tersedia' }}</p>
                            </div>
    
                            <!-- Tahun Masuk -->
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase">Tahun Masuk:</h6>
                                <p class="text-muted mb-0">{{ $dataGurus->tahun_masuk }}</p>
                            </div>
    
                            <!-- Status -->
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase">Status:</h6>
                                <p class="text-muted mb-0">{{ ucfirst($dataGurus->status) }}</p>
                            </div>
    
                            <!-- Gambar Ijazah -->
                            <div class="d-flex justify-content-center flex-wrap gap-4 mt-4">
                                <!-- Gambar Ijazah -->
                                <div class="text-center">
                                    <h6 class="fw-bold text-uppercase">Gambar Ijazah:</h6>
                                    @if($dataGurus->gambar_ijazah)
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#ijazahModal">
                                            <img src="{{ asset('storage/' . $dataGurus->gambar_ijazah) }}" 
                                                 alt="Ijazah" 
                                                 class="img-thumbnail mt-2 shadow-sm"
                                                 style="width: 200px; height: auto; object-fit: contain; border-radius: 12px;">
                                        </a>
                                        <!-- Modal Gambar Ijazah -->
                                        <div class="modal fade" id="ijazahModal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Gambar Ijazah</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/' . $dataGurus->gambar_ijazah) }}" 
                                                             alt="Ijazah" 
                                                             class="img-fluid rounded">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ asset('storage/' . $dataGurus->gambar_ijazah) }}" download class="btn btn-primary">Download Gambar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <p class="text-muted mt-2">Tidak ada gambar.</p>
                                    @endif
                                </div>
                        
                                <!-- Gambar KTP -->
                                <div class="text-center">
                                    <h6 class="fw-bold text-uppercase">Gambar KTP:</h6>
                                    @if($dataGurus->gambar_ktp)
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#ktpModal">
                                            <img src="{{ asset('storage/' . $dataGurus->gambar_ktp) }}" 
                                                 alt="KTP" 
                                                 class="img-thumbnail mt-2 shadow-sm"
                                                 style="width: 200px; height: auto; object-fit: contain; border-radius: 12px;">
                                        </a>
                                        <!-- Modal Gambar KTP -->
                                        <div class="modal fade" id="ktpModal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Gambar KTP</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/' . $dataGurus->gambar_ktp) }}" 
                                                             alt="KTP" 
                                                             class="img-fluid rounded">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ asset('storage/' . $dataGurus->gambar_ktp) }}" download class="btn btn-primary">Download Gambar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <p class="text-muted mt-2">Tidak ada gambar.</p>
                                    @endif
                                </div>
                        </div>
                    </div>
                    <div class="card-footer text-end bg-light border-top-0 rounded-bottom">
                        <a href="{{ route('data.index') }}" class="btn btn-secondary btn-sm shadow-sm">Kembali</a>
                    </div>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </section>
    

</main>
@endsection
