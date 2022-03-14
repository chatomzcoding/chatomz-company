<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Chatomz Company' }}</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template/mazer/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('template/mazer/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('template/mazer/css/app.css')}}">
</head>

<body>
    <nav class="navbar navbar-light">
        <div class="container d-block">
            <a href="javascript:history.back()"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="{{ url('dashboard') }}">
                <img src="{{ asset('template/mazer/images/logo/logo.png')}}">
            </a>
        </div>
    </nav>
    <div class="container">
        {{ $content ?? '' }}
    </div>

    <script src="{{ asset('template/mazer/js/bootstrap.bundle.min.js')}}"></script>

</body>
</html>