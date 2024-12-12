<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('pribadi.index') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('user.sk.index') }}">
          <i class="bi bi-question-circle"></i>
          <span>Surat Keterangan</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('data.index') }}">
          <i class="bi bi-person"></i>
          <span>Data Pribadi</span>
        </a>
      </li>
      <!-- End Profile Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('user.soal.index') }}">
          <i class="bi bi-envelope"></i>
          <span>Bank Soal</span>
        </a>
      </li><!-- End Contact Page Nav -->
<!-- End Login Page Nav -->

    </ul>

  </aside