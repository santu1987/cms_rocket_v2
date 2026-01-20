<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Panel AdminLTE')</title>

  <!-- Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">

  <!-- AdminLTE -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

  <!-- Estilos propios opcionales -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('layouts.navbar')

  <!-- Sidebar -->
  @include('layouts.sidebar')

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <section class="content p-3">
      @yield('content')
    </section>
  </div>

  <!-- Footer -->
  @include('layouts.footer')

</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- Scripts propios -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>