<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title}}</title>
    <link rel="shortcut icon" href="{{ asset('img/admin/info/'.$info->logo_brand)}}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('template/mazer/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('template/mazer/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('template/mazer/css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/custom.css')}}">

  <script src="{{ asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
  <script src="{{ asset('vendor/sweetalert/sweetalert2.css')}}"></script>

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('template/admin/lte/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('template/admin/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

{{ $head ?? '' }}
</head>

<body style="font-family: Arial, Helvetica, sans-serif">
    <nav class="navbar navbar-light">
        <div class="container d-block">
            <a href="{{ url($back) }}"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="{{ url('dashboard') }}">
                <img src="{{ asset('img/admin/info/'.$info->bg_produk)}}">
            </a>
        </div>
    </nav>
    <div class="container">
        <x-sistem.notifikasi/>
        {{ $content ?? '' }}
    </div>
    <script src="{{ asset('template/mazer/vendors/jquery/jquery.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{ asset('template/admin/lte/plugins/select2/js/select2.full.min.js')}}"></script>

    <script src="{{ asset('template/mazer/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/chatomz.js')}}"></script>

    {{ $kodejs ?? '' }}
    
    <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    });
    </script>

</body>
</html>