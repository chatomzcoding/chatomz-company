@section('title')
    Company - Informasi {{ $kategori->nama_kategori }}
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Informasi {{ $kategori->nama_kategori }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item active">Daftar {{ $kategori->nama_kategori }}</li>
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
                <a href="{{ url('informasi/create?k='.Crypt::encrypt($kategori->id)) }}" class="btn btn-outline-primary btn-flat btn-sm pop-info" title="Tambah Data Baru {{ $kategori->nama_kategori }}"><i class="fas fa-plus"></i> Tambah</a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                    <div class="row d-flex align-items-stretch">
                        @forelse ($data as $item)
                            <div class="col-12 col-sm-4 col-md-3 d-flex align-items-stretch">
                                <div class="card bg-light">
                                    <div class="card-header text-muted border-bottom-0 font-weight-bold">
                                    {{ ucwords($item->nama)}}
                                    </div>
                                    <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                        <a href="{{ asset('img/company/informasi/'.$item->gambar)}}" target="_blank"><img src="{{ asset('img/company/informasi/'.$item->gambar)}}" alt="gambar" class="img-fluid img-rounded"></a>
                                        </div>
                                        <div class="col-md-12">
                                        <p class="small"><b>0</b></p>
                                        <p class="text-muted text-sm text-justify">. . . </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"></li>
                                        </ul>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="card-footer bg-secondary">
                                    <div class="text-right">
                                        {{-- <a href="#" class="btn btn-sm bg-teal">
                                        <i class="fas fa-comments"></i>
                                        </a> --}}
                                        <form id="data-{{ $item->id }}" action="{{url('/informasi',$item->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        <a href="{{ url('/informasi/'.Crypt::encryptString($item->id))}}" class="btn btn-sm btn-outline-light">
                                            <i class="fas fa-list"></i>
                                        </a>
                                        <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-outline-light btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        <div class="col">
                            <div class="alert alert-info text-center">
                                <i>Belum ada Data</i>
                            </div>
                        </div>
                        @endforelse
                    </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    @section('script')
        <script>
            $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            });
        </script>
    @endsection

</x-app-layout>
