<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn"></i>
      <a href="{{ route('admin.index') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/tut.png') }}" alt="">
        <span class="d-none d-lg-block">CIKUL2</span>
      </a>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <!-- Menampilkan foto profil -->
              <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
              
              <!-- Menampilkan nama pengguna yang sedang login -->
              <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->nama }}</span>
          </a><!-- End Profile Image Icon -->
      
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                  <!-- Menampilkan nama lengkap pengguna yang login -->
                  <h6>{{ Auth::user()->username }}</h6>
                  <span>{{ Auth::user()->role ?? 'User' }}</span> <!-- Menampilkan role jika ada -->
              </li>
              <li>
                  <hr class="dropdown-divider">
              </li>
              <li>
                  <!-- Link Ganti Password -->
                  <a class="dropdown-item d-flex align-items-center" href="{{ route('password.change') }}">
                      <i class="bi bi-key"></i>
                      <span>Ganti Password</span>
                  </a>
              </li>
              <li>
                  <hr class="dropdown-divider">
              </li>
              <li>
                  <!-- Form logout -->
                  <form action="{{ route('logout') }}" method="POST" class="d-inline">
                      @csrf <!-- CSRF token untuk mencegah serangan CSRF -->
                      <button type="submit" class="dropdown-item d-flex align-items-center">
                          <i class="bi bi-box-arrow-right"></i>
                          <span>Sign Out</span>
                      </button>
                  </form>
              </li>
          </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->
      <!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header>