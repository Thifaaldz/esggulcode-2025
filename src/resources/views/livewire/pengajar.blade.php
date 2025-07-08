<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Esggul Code Bootcamp</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset ('front/assets/img/LogoEC.png') }}" rel="icon">
  <link href="{{ asset ('front/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset ('front/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset ('front/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset ('front/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset ('front/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset ('front/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset ('front/assets/css/main.css') }}" rel="stylesheet">
  @livewireScripts
  <!-- =======================================================
  * Template Name: Mentor
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">



  <main class="main">

    <div class="page-title" data-aos="fade">
        <div class="heading">
          <div class="container">
            <div class="row d-flex justify-content-center text-center">
              <div class="col-lg-8">
                <h1>Courses</h1>
                <p class="mb-0">
                    Temukan berbagai pilihan kursus dan bootcamp yang dirancang untuk membekali Anda dengan keterampilan nyata, relevan dengan kebutuhan industri saat ini. Dari pembelajaran mandiri hingga program pelatihan intensif, setiap course kami disusun berdasarkan kurikulum terstandarisasi dan dilengkapi dengan sertifikasi digital yang kredibel.
                  </p>
                  
              </div>
            </div>
          </div>
        </div>
        <nav class="breadcrumbs">
          <div class="container">
            <ol>
              <li><a href="index.html">Home</a></li>
              <li class="current">Courses</li>
            </ol>
          </div>
        </nav>
      </div><!-- End Page Title -->

    @include('livewire.components.header')
    @livewire('trainers-index')
    @include('livewire.components.footer')
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset ('front/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset ('front/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset ('front/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset ('front/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset ('front/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset ('front/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset ('front/assets/js/main.js') }}"></script>
  @livewireStyles

</body>

</html>