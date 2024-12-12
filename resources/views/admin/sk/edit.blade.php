@extends('admin.layout.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Surat Keterangan</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Surat Keterangan</h5>

                <!-- Form Edit Surat Keterangan -->
                <form action="{{ route('admin.sk.update', $sk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Surat</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $sk->nama) }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_guru" class="form-label">Nama Guru</label>
                        <select class="form-select @error('id_guru') is-invalid @enderror" id="id_guru" name="id_guru" required>
                            @foreach ($gurus as $guru)
                                <option value="{{ $guru->id }}" {{ $guru->id == $sk->id_guru ? 'selected' : '' }}>
                                    {{ $guru->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_guru')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">File Surat</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                <!-- End Form Edit Surat Keterangan -->

            </div>
          </div>
        </div>
      </div>
    </section>

</main>
@endsection
