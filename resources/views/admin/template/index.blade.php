@extends('admin.layout.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard Halaman Admin</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
  
    <section class="section dashboard">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
                <div class="container mt-5">
                    <h1 class="text-center mb-4">Download Template Data</h1>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('template.download', 'siswa') }}" class="btn btn-primary">
                            Download Template Siswa
                        </a>
                        <a href="{{ route('template.download', 'guru') }}" class="btn btn-success">
                            Download Template Guru
                        </a>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  
  </main>
@endsection
