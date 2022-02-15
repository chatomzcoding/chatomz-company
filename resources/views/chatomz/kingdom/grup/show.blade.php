@section('title')
    CHATOMZ - Daftar Grup {{ $grup->name}}
@endsection
<x-app-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Grup</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url('grup')}}">Daftar Grup</a></li>
                <li class="breadcrumb-item active">Grup {{ $grup->name}}</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
    </x-slot>
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <form id="data-{{ $grup->id }}" action="{{url('/grup/'.$grup->id)}}" method="post">
                @csrf
                @method('delete')
                </form>
            <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title">Daftar Unit</h3> --}}
                <a href="{{ url('/grup')}}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-angle-left"></i> kembali </a>
                <a href="#" class="btn btn-outline-success btn-flat btn-sm" data-toggle="modal" data-target="#editgrup"><i class="fas fa-pen"></i> Edit</a>
                <button onclick="deleteRow( {{ $grup->id }} )" class="btn btn-outline-danger btn-sm btn-flat pop-info" title="hapus grup"><i class="fas fa-trash-alt"></i> Hapus</button>
                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Anggota</a>
                @if ($main['tag'] <> NULL)
                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#anggotatag"><i class="fas fa-plus"></i> Tambah Anggota Ke Tag #{{ $main['tag'] }} </a>
                @endif
                <span class="float-right">Total Anggota {{ count($anggota) }}</span>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <div class="row mb-2">
                      <div class="col-md-6">
                          <img src="{{ asset('/img/chatomz/grup/'.$grup->photo)}}" alt="" class="img-fluid img-rounded">
                      </div>
                    <div class="col-md-6">
                        <h2>{{ ucwords($grup->name) }}</h2><hr>
                        <h5 class="text-capitalize">{{ $grup->keterangan }}</h5>
                        <small>Tahun Dibentuk {{ $grup->created_year }}</small>
                        <div class="my-3">
                            <a href="{{ url('grup/'.Crypt::encryptString($grup->id)) }}" @if ($main['tag'] == NULL)
                                class="badge badge-primary"
                            @endif>#semua</a>
                            @forelse (c_showtag($grup->dtag) as $item)
                                <a href="{{ url('grup/'.Crypt::encryptString($grup->id).'?tag='.$item) }}"  @if ($main['tag'] == $item)
                                    class="badge badge-primary"
                                @endif>#{{ $item }}</a>
                            @empty
                                
                            @endforelse
                        </div>
                    </div>
                  </div>
                  <hr>
                    <div class="row d-flex align-items-stretch">
                        @forelse ($anggota as $item)
                            <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch">
                            <div class="card bg-light">
                                <div class="card-header text-muted border-bottom-0 text-capitalize">
                                {{ fullname($item)}}
                                </div>
                                <div class="card-body pt-0 pb-0">
                                <div class="row">
                                    <div class="col-7">
                                    <h2 class="lead"><b>{{ $item->gender}}</b></h2>
                                  
                                    <i class="small">{{ c_listtag($item->tag) }}</i>
                                    </div>
                                    <div class="col-5 text-center">
                                        <a href="{{ url('/orang/'.Crypt::encryptString($item->orang_id))}}"><img src="{{ asset('/img/chatomz/orang/'.$item->photo)}}" alt="user-avatar" class="img-fluid img-circle"></a>
                                    </div>
                                    <div class="col-md-12">
                                        <span class="small">{{ $item->information }}</span>
                                    </div>
                                </div>
                                </div>
                                <div class="card-footer p-2">
                                    <form id="data-{{ $item->id }}" action="{{url('/grupanggota',$item->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <span class="text-muted text-sm text-justify"><i class="fas fa-calendar-alt"></i> {{ $item->created_at }} </span>
                                    <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-outline-danger btn-sm float-right mx-1"><i class="fas fa-trash-alt"></i></button>
                                    <button type="button" data-toggle="modal"  data-information="{{ $item->information }}" data-nama="{{ fullname($item) }}" data-id="{{ $item->id }}" data-target="#ubah" title="" class="btn btn-outline-success btn-sm float-right" data-original-title="Edit Task">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                        
                                </div>
                            </div>
                            </div>
                            @empty
                                <div class="col text-center">
                                    <i>Data tidak ada</i>
                                </div>
                            @endforelse
                    </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    {{-- modal --}}
    {{-- modal tambah --}}
    <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url('/grupanggota')}}" method="post">
                @csrf
                <input type="hidden" name="grup_id" value="{{ $grup->id }}">
            <div class="modal-header">
            <h4 class="modal-title">Tambah Anggota Grup</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                   <div class="form-group row">
                    <label for="" class="col-md-4">Nama Anggota</label>
                    <div class="col-md-8 p-0">
                        <select name="orang_id" id="orang_id" class="form-control select2bs4" data-width="100%">
                            @foreach ($orang as $item)
                                @if (!DbChatomz::cekstatusgrup($grup->id,$item->id))
                                    <option value="{{ $item->id}}">{{ fullname($item)}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan</label>
                        <input type="text" name="information" id="information" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Tag</label>
                        <div class="col-md-8 p-0">
                            <select name="tag[]" id=""  data-placeholder="pilih tag" class="select2bs4" style="width: 100%;" multiple>
                                @foreach (c_showtag($grup->dtag) as $item)
                                    <option value="{{ $item }}">#{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                   </div>
                </section>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN</button>
            </div>
        </form>
        </div>
        </div>
    </div>
    <!-- /.modal -->

    {{-- modal edit --}}
    <div class="modal fade" id="ubah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ route('grupanggota.update','test')}}" method="post">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Anggota</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" id="id">
                <section class="p-3">
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control col-md-8" readonly>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan</label>
                        <input type="text" name="information" id="information" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Tag</label>
                        <div class="col-md-8 p-0">
                            <select name="tag[]" id=""  data-placeholder="pilih tag" class="select2bs4" style="width: 100%;" multiple>
                                @foreach (c_showtag($grup->dtag) as $item)
                                    <option value="{{ $item }}">#{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
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
    {{-- modal edit --}}
    @if (!is_null($main['danggota']))
        <div class="modal fade" id="anggotatag">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ url('grupanggota')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="sesi" value="taganggota">
                <div class="modal-header">
                <h4 class="modal-title">Tambahkan anggota ke tag #{{ $main['tag'] }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body p-3">
                    <input type="hidden" name="tag[]" id="id" value="{{ $main['tag'] }}">
                    <section class="p-3">
                        <label for="">Nama Anggota</label>
                        <div class="form-group row">
                            @foreach ($main['danggota'] as $item)
                                @if (DbChatomz::cekanggotagruptag($item->id,$main['tag']))
                                    <div class="col-md-6 p-0">
                                        <input type="checkbox" name="id[]"  value="{{ $item->id }}">
                                        <label>{{ fullname($item)}}</label> <br>
                                    </div>
                                @endif
                            @endforeach
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
    @endif
    <div class="modal fade" id="editgrup">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ route('grup.update','test')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Grup</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" id="id" value="{{ $grup->id }}">
                <section class="p-3">
                    <div class="form-group row">
                         <label for="" class="col-md-4">Nama Grup {!! ireq() !!}</label>
                         <input type="text" name="name" id="name" value="{{ $grup->name }}" class="form-control col-md-8">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan</label>
                        <textarea name="keterangan" id="" cols="30" rows="5" class="form-control col-md-8" required>{{ $grup->keterangan }}</textarea>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4">Data Tag</label>
                        <textarea name="dtag" id="" cols="30" rows="5" class="form-control col-md-8">{{ $grup->dtag }}</textarea>
                    </div>
                    <div class="form-group row">
                         <label for="" class="col-md-4">Gambar Grup {!! ireq() !!}</label>
                         <input type="file" name="photo" id="photo" class="form-control col-md-8">
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
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var information = button.data('information')
                var nama = button.data('nama')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #information').val(information);
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #id').val(id);
            })
        </script>
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
