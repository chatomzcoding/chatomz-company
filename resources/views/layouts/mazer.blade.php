<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? ''}}</title>

    <link rel="shortcut icon" href="{{ asset('img/admin/info/'.$info->logo_brand)}}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template/mazer/css/bootstrap.css')}}">

    @if ($datatables)
        <link rel="stylesheet" href="{{ asset('template/mazer/vendors/simple-datatables/style.css')}}">
    @endif

    <link rel="stylesheet" href="{{ asset('template/mazer/vendors/iconly/bold.css')}}">

    <link rel="stylesheet" href="{{ asset('template/mazer/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    {{-- font --}}
    {{-- <link rel="stylesheet" href="{{ asset('template/mazer/vendors/bootstrap-icons/bootstrap-icons.css')}}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('template/mazer/vendors/fontawesome/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('template/mazer/css/app.css')}}">

    @if ($alert)
        <script src="{{ asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
        <script src="{{ asset('vendor/sweetalert/sweetalert2.css')}}"></script>
    @endif

    @if ($select)
        <link rel="stylesheet" href="{{ asset('template/admin/lte/plugins/select2/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{ asset('template/admin/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    @endif

    {{ $head ?? '' }}

</head>

<body style="font-family: Arial, Helvetica, sans-serif">
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header py-0">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ url('/dashboard') }}"><img src="{{ asset('img/admin/info/'.$info->bg_produk)}}" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="{{ url('/dashboard') }}" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
               <x-menu/>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            {{ $content ?? ''}}
           

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>{{ ambil_tahun() }} &copy; Chatomz Company</p>
                    </div>
                    <div class="float-end">
                        <p>Created by Firman Chatomz</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('template/mazer/vendors/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('template/mazer/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('template/mazer/js/bootstrap.bundle.min.js')}}"></script>
    

    <script src="{{ asset('template/mazer/vendors/fontawesome/all.min.js')}}"></script>

    <script src="{{ asset('template/mazer/js/main.js')}}"></script>

    @if ($datatables)
        <script src="{{ asset('template/mazer/vendors/simple-datatables/simple-datatables.js')}}"></script>
        <script>
            // Simple Datatable
            let table1 = document.querySelector('#example1');
            let dataTable = new simpleDatatables.DataTable(table1);
        </script>
    @endif

    {{-- js chatomz custom --}}
    <script src="{{ asset('js/chatomz.js')}}"></script>

    @if ($select)
        <script src="{{ asset('template/admin/lte/plugins/select2/js/select2.full.min.js')}}"></script>
        <script>
            $(function () {
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            });
        </script>
    @endif
    {{ $kodejs ?? '' }}
   
</body>

</html>