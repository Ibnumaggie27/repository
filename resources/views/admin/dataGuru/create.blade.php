@extends('admin.layout.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle d-flex justify-content-between align-items-center">
        <div>
            <h1>Input Data Guru</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href=" {{ route('admin.dataGuru.index') }}">Data Guru</a></li>
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
                        <h5 class="card-title">Form Input Data Guru</h5>

                        <!-- Multi Columns Form -->
                        <form method="POST" action="{{ route('admin.dataGuru.store') }}" enctype="multipart/form-data" class="row g-3">
                            @csrf

                            <div class="col-md-6">
                                <label for="nama" class="form-label">Nama Guru</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                                @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip') }}" required>
                                @error('nip') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                                @error('tempat_lahir') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                @error('tanggal_lahir') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="jk" class="form-label">Jenis Kelamin</label>
                                <select class="form-control" id="jk" name="jk" required>
                                    <option value="l" {{ old('jk') == 'l' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="p" {{ old('jk') == 'p' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jk') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="agama" class="form-label">Agama</label>
                                <select class="form-control" id="agama" name="agama" required>
                                    <option value="islam" {{ old('agama') == 'islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="kristen" {{ old('agama') == 'kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="katolik" {{ old('agama') == 'katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="hindu" {{ old('agama') == 'hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="buddha" {{ old('agama') == 'buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="konghucu" {{ old('agama') == 'konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                                @error('agama') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="no_hp" class="form-label">Nomor HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                                @error('no_hp') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                                <input type="number" class="form-control" id="tahun_masuk" name="tahun_masuk" value="{{ old('tahun_masuk') }}" required>
                                @error('tahun_masuk') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">Status Kepegawaian</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    <option value="pensiun" {{ old('status') == 'pensiun' ? 'selected' : '' }}>Pensiun</option>
                                </select>
                                @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                                @error('alamat') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="gambar_ijazah" class="form-label">Gambar Ijazah</label>
                                <input type="file" class="form-control" id="gambar_ijazah" name="gambar_ijazah">
                                @error('gambar_ijazah') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="gambar_ktp" class="form-label">Gambar KTP</label>
                                <input type="file" class="form-control" id="gambar_ktp" name="gambar_ktp">
                                @error('gambar_ktp') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="text-center col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- End Multi Columns Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection
