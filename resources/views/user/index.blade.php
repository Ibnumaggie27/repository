@extends('user.layout.app')

@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard Halaman User</h1>
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
            <h5 class="card-title">Selamat Datang</h5>
            <p>Halo, {{ Auth::user()->role }}! Selamat datang di dashboard user. Silakan gunakan fitur yang tersedia untuk kemudahan aktivitas Anda.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
@endsection
