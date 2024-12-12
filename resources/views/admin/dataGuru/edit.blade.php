@extends('admin.layout.app')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Data Guru</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dataGuru.index') }}">Data Guru</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Edit Guru</h5>

                        <form action="{{ route('admin.dataGuru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Guru</label>
                                <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama', $guru->nama) }}" required>
                                @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" name="nip" class="form-control" id="nip" value="{{ old('nip', $guru->nip) }}" required>
                                @error('nip') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="{{ old('tempat_lahir', $guru->tempat_lahir) }}" required>
                                @error('tempat_lahir') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="{{ old('tanggal_lahir', $guru->tanggal_lahir) }}" required>
                                @error('tanggal_lahir') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jk" class="form-label">Jenis Kelamin</label>
                                <select name="jk" id="jk" class="form-control" required>
                                    <option value="l" {{ old('jk', $guru->jk) == 'l' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="p" {{ old('jk', $guru->jk) == 'p' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jk') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="agama" class="form-label">Agama</label>
                                <select name="agama" id="agama" class="form-control" required>
                                    <option value="islam" {{ old('agama', $guru->agama) == 'islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="kristen" {{ old('agama', $guru->agama) == 'kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="katolik" {{ old('agama', $guru->agama) == 'katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="hindu" {{ old('agama', $guru->agama) == 'hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="buddha" {{ old('agama', $guru->agama) == 'buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="konghucu" {{ old('agama', $guru->agama) == 'konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                                @error('agama') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" id="alamat" rows="3" required>{{ old('alamat', $guru->alamat) }}</textarea>
                                @error('alamat') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="no_hp" class="form-label">Nomor HP</label>
                                <input type="text" name="no_hp" class="form-control" id="no_hp" value="{{ old('no_hp', $guru->no_hp) }}">
                                @error('no_hp') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $guru->email) }}">
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                                <input type="number" name="tahun_masuk" class="form-control" id="tahun_masuk" value="{{ old('tahun_masuk', $guru->tahun_masuk) }}" required>
                                @error('tahun_masuk') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status Kepegawaian</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="aktif" {{ old('status', $guru->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status', $guru->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    <option value="pensiun" {{ old('status', $guru->status) == 'pensiun' ? 'selected' : '' }}>Pensiun</option>
                                </select>
                                @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="gambar_ijazah" class="form-label">Gambar Ijazah</label>
                                <input type="file" name="gambar_ijazah" class="form-control" id="gambar_ijazah">
                                @error('gambar_ijazah') <div class="text-danger">{{ $message }}</div> @enderror
                                @if($guru->gambar_ijazah)
                                    <p>Current Image: <a href="{{ asset('storage/' . $guru->gambar_ijazah) }}" target="_blank">View Image</a></p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="gambar_ktp" class="form-label">Gambar KTP</label>
                                <input type="file" name="gambar_ktp" class="form-control" id="gambar_ktp">
                                @error('gambar_ktp') <div class="text-danger">{{ $message }}</div> @enderror
                                @if($guru->gambar_ktp)
                                    <p>Current Image: <a href="{{ asset('storage/' . $guru->gambar_ktp) }}" target="_blank">View Image</a></p>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
