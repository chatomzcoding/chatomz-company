@section('title')
    CHATOMZ - Daftar Barang
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Barang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item active">Daftar Barang</li>
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
                <a href="{{ url('/orang/create')}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="fas fa-plus"></i> Tambah Barang Baru </a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                    <div class="row">
                        @forelse ($barang as $item)
                        <div class="col-md-2">
                            <div class="card w-100">
                                <a href="{{ url('/barang/'.Crypt::encryptString($item->id))}}" target="_blank"><img src="{{ asset('img/chatomz/barang/'.$item->mg_barang)}}" class="card-img-top" alt="{{ $item->photo_barang }}"></a>
                                <div class="card-body p-1 text-center">
                                <small class="text-capitalize">{{ $item->nama_barang}}</small>
                                {{-- <p class="card-text">{{ $item->home_address}}</p> --}}
                              </div>
                              <div class="card-footer p-1">
                                <form id="data-{{ $item->id }}" action="{{url('/barang',$item->id)}}" method="post">
                                  @csrf
                                  @method('delete')
                                  </form>   
                                  <button type="button" data-toggle="modal"  data-nama_barang="{{ $item->nama_barang }}"  data-id="{{ $item->id }}" data-target="#ubah" title="" class="btn btn-success btn-sm" data-original-title="Edit Task">
                                    <i class="fa fa-edit"></i>
                                    <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>

                                </button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col">
                            <p>tidak ada data</p>
                        </div>
                        @endforelse
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        {{-- modal edit --}}
        <div class="modal fade" id="ubah">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form action="{{ route('barang.update','test')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('patch')
              <div class="modal-header">
              <h4 class="modal-title">Edit Barang</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body p-3">
                  <input type="hidden" name="id" id="id">
                  <section class="p-3">
                      <div class="form-group row">
                          <label for="" class="col-md-4">Nama Barang</label>
                          <input type="text" name="nama_barang" id="nama_barang" class="form-control col-md-8" required>
                     </div>
                     <div class="form-group row">
                          <label for="" class="col-md-4">Photo</label>
                          <input type="file" name="photo_barang" class="form-control col-md-8">
                     </div>
                  </section>
              </div>
              <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
              <button type="submit" class="btn btn-success"><i class="fas fa-pen"></i> SIMPAN PERUBAHAN</button>
              </div>
              </form>
          </div>
          </div>
      </div>
      <!-- /.modal -->

    @section('script')
        
        <script>
            $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                "buttons": ["pdf"]
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

  <script>
      $('#ubah').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget)
          var nama_barang = button.data('nama_barang')
          var id = button.data('id')

          var modal = $(this)

          modal.find('.modal-body #nama_barang').val(nama_barang);
          modal.find('.modal-body #id').val(id);
      })
  </script>
    @endsection

</x-app-layout>
