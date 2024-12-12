<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('admin.index') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.sk.index') }}">
          <i class="bi bi-person"></i>
          <span>SK</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.dataNilai.index') }}">
          <i class="bi bi-question-circle"></i>
          <span>Data Nilai</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.absen.index') }}">
          <i class="bi bi-envelope"></i>
          <span>Absen</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.dataGuru.index') }}">
          <i class="bi bi-card-list"></i>
          <span>Data Guru</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.siswa.index') }}">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Siswa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.mutasiSiswa.index') }}">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Mutasi Siswa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.soal.index') }}">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Bank Soal</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('template.index') }}">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Template</span>
        </a>
      </li>
      <br>

    </ul>

  </aside