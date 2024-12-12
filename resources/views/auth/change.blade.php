@extends('user.layout.app')

@section('content')

<main id="main" class="main">
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
              <h5 class="card-title">Ganti Password</h5>

              <!-- Form Ganti Password -->
              <form action="{{ route('password.update') }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="row g-3">
                      <div class="col-md-12">
                        <label for="new_password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                      </div>
                      <div class="col-md-12">
                        <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                      </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Ganti Password</button>
              </form>
              <!-- End Form Ganti Password -->
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

@endsection
