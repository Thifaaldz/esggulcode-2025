<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ route ('home') }}" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset ('front/assets/img/LogoEC-Trans.png') }}" alt=""> 
        <h1 class="sitename">bootcamp</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
            <li><a href="{{ route('course') }}" class="{{ request()->routeIs('course') ? 'active' : '' }}">Course</a></li>
            <li><a href="{{ route('pengajar') }}" class="{{ request()->routeIs('pengajar') ? 'active' : '' }}">Pengajar</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{ route ('course') }}">Get Started</a>

    </div>
  </header>