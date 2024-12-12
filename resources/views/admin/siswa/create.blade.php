@extends('admin.layout.app')

@section('content')
<main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between align-items-center">
        <div>
            <h1>Input Data Mutasi Siswa</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href=" {{ route('admin.siswa.index') }}">Data Siswa</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Formulir Input Data Siswa</h5>

                        <!-- Form Input Data Siswa -->
                        <form action="{{ route('admin.siswa.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nisn" class="form-label">NISN</label>
                                    <input type="text" name="nisn" id="nisn" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nis" class="form-label">NIS</label>
                                    <input type="text" name="nis" id="nis" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" name="tempatLahir" id="tempatLahir" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggalLahir" id="tanggalLahir" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="jk" class="form-label">Jenis Kelamin</label>
                                    <select name="jk" id="jk" class="form-select" required>
                                        <option value="l">Laki-laki</option>
                                        <option value="p">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="agama" class="form-label">Agama</label>
                                    <select name="agama" id="agama" class="form-select" required>
                                        <option value="islam">Islam</option>
                                        <option value="kristen">Kristen</option>
                                        <option value="katolik">Katolik</option>
                                        <option value="hindu">Hindu</option>
                                        <option value="buddha">Buddha</option>
                                        <option value="konghucu">Konghucu</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="noHp" class="form-label">No HP</label>
                                    <input type="text" name="noHp" id="noHp" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="namaOrangTua" class="form-label">Nama Orang Tua</label>
                                    <input type="text" name="namaOrangTua" id="namaOrangTua" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="pekerjaanOrangTua" class="form-label">Pekerjaan Orang Tua</label>
                                    <input type="text" name="pekerjaanOrangTua" id="pekerjaanOrangTua" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <select name="kelas" id="kelas" class="form-select" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tahunMasuk" class="form-label">Tahun Masuk</label>
                                    <input type="number" name="tahunMasuk" id="tahunMasuk" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="masuk">Masuk</option>
                                        <option value="keluar">Keluar</option>
                                        <option value="lulus">Lulus</option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                        <!-- End Form Input Data Siswa -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
