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
                        @if (!is_null($jawaban))
                            <div class="callout callout-success">
                                {{ $jawaban }}
                            </div>
                        @endif
                        <form action="" method="get">
                            <input type="hidden" name="cek">
                            <div class="form-group">
                                <label for="">tanyakan pada bot</label>
                                <input type="text" name="pertanyaan" class="form-control">
                                <button type="submit" class="btn btn-primary mt-3">KIRIM PERTANYAAN</button>
                            </div>
                        </form>
                    </div>
              </div>
            </div>
          </div>
        </div>
    </div>

</x-app-layout>
