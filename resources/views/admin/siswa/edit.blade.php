@extends('admin.layout.app')

@section('content')
<main id="main" class="main">

  <div class="pagetitle d-flex justify-content-between align-items-center">
    <div>
        <h1>Edit Data Siswa</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.siswa.index') }}">Mutasi Siswa</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Edit Data Siswa</h5>

                    <!-- Form Edit Siswa -->
                    <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $siswa->nama) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="text" name="nisn" id="nisn" class="form-control" value="{{ old('nisn', $siswa->nisn) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="text" name="nis" id="nis" class="form-control" value="{{ old('nis', $siswa->nis) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempatLahir" id="tempatLahir" class="form-control" value="{{ old('tempatLahir', $siswa->tempatLahir) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggalLahir" id="tanggalLahir" class="form-control" value="{{ old('tanggalLahir', $siswa->tanggalLahir) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="jk" class="form-label">Jenis Kelamin</label>
                                <select name="jk" id="jk" class="form-select" required>
                                    <option value="l" {{ $siswa->jk == 'l' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="p" {{ $siswa->jk == 'p' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="agama" class="form-label">Agama</label>
                                <select name="agama" id="agama" class="form-select" required>
                                    <option value="islam" {{ $siswa->agama == 'islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="kristen" {{ $siswa->agama == 'kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="katolik" {{ $siswa->agama == 'katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="hindu" {{ $siswa->agama == 'hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="buddha" {{ $siswa->agama == 'buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="konghucu" {{ $siswa->agama == 'konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="noHp" class="form-label">No HP</label>
                                <input type="text" name="noHp" id="noHp" class="form-control" value="{{ old('noHp', $siswa->noHp) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="namaOrangTua" class="form-label">Nama Orang Tua</label>
                                <input type="text" name="namaOrangTua" id="namaOrangTua" class="form-control" value="{{ old('namaOrangTua', $siswa->namaOrangTua) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="pekerjaanOrangTua" class="form-label">Pekerjaan Orang Tua</label>
                                <input type="text" name="pekerjaanOrangTua" id="pekerjaanOrangTua" class="form-control" value="{{ old('pekerjaanOrangTua', $siswa->pekerjaanOrangTua) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select name="kelas" id="kelas" class="form-select" required>
                                    <option value="1" {{ $siswa->kelas == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ $siswa->kelas == 2 ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ $siswa->kelas == 3 ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ $siswa->kelas == 4 ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ $siswa->kelas == 5 ? 'selected' : '' }}>5</option>
                                    <option value="6" {{ $siswa->kelas == 6 ? 'selected' : '' }}>6</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tahunMasuk" class="form-label">Tahun Masuk</label>
                                <input type="number" name="tahunMasuk" id="tahunMasuk" class="form-control" value="{{ old('tahunMasuk', $siswa->tahunMasuk) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="masuk" {{ $siswa->status == 'masuk' ? 'selected' : '' }}>Masuk</option>
                                    <option value="keluar" {{ $siswa->status == 'keluar' ? 'selected' : '' }}>Keluar</option>
                                    <option value="lulus" {{ $siswa->status == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                    <!-- End Form Edit Siswa -->

                </div>
            </div>
        </div>
    </div>
</section>

</main>
@endsection
