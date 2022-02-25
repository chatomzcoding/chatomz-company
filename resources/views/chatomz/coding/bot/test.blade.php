@section('title')
    CHATOMZ - Bot
@endsection
<x-app-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Chatomz Bot</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item active">Daftar Chatomz Bot</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
    </x-slot>

    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title">Daftar Unit</h3> --}}
                <a href="{{ url('chatomzbot') }}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-angle-double-left"></i> kembali </a>
              </div>
              <div class="card-body">
                    @include('sistem.notifikasi')
                    <div class="container">
                        <header class="text-center">
                            <h3>SELAMAT DATANG DI CHATOMZ BOT</h3>
                            <p>versi 1.1</p>
                        </header>
                      
                        <form action="" method="get">
                            <input type="hidden" name="cek">
                            <div class="form-group">
                                <input type="text" name="pertanyaan" class="form-control" placeholder="ketik pertanyaan disini!" autocomplete="off" autofocus required>
                            </div>
                            @if (!is_null($jawaban))
                                <div class="alert alert-info">
                                    {!! $jawaban !!}
                                </div>
                            @endif
                            <div class="form-group mt-3 text-center">
                                <button type="submit" class="btn btn-outline-primary">KIRIM PERTANYAAN</button>
                            </div>
                        </form>
                        <div class="callout callout-warning">
                            <strong>Catatan !</strong> <br>
                            <small>bot ini masih belajar kosa kata dan pertanyaan, bot akan belajar dari pertanyan yang belum dia kuasai <br> terima kasih orang baik :) </small>
                        </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
    </div>

</x-app-layout>
