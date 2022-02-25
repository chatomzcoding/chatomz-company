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
                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Bot </a>
                <a href="{{ url('chatomzbot?cek=true') }}" class="btn btn-outline-dark btn-flat btn-sm"><i class="fas fa-file"></i> Test Bot </a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                            <option value="valid" @if ($main['filter']['status'] == 'valid')
                                                selected
                                            @endif>VALID</option>
                                            <option value="proses" @if ($main['filter']['status'] == 'proses')
                                                selected
                                            @endif>PROSES</option>
                                            <option value="filter" @if ($main['filter']['status'] == 'filter')
                                                selected
                                            @endif>KATA FILTER</option>
                                            <option value="default" @if ($main['filter']['status'] == 'default')
                                                selected
                                            @endif>KATA DEFAULT</option>
                                    </select>
                                </div>
                            </div>    
                        </div>
                    </form>  
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Aksi</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @forelse ($bots as $item)
                            <tr>
                                    <td class="text-center">{{ $loop->iteration}}</td>
                                    <td class="text-center">
                                        <form id="data-{{ $item->id }}" action="{{url('/chatomzbot',$item->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            </form>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-sm btn-flat">Aksi</button>
                                                <button type="button" class="btn btn-info btn-sm btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <button type="button" data-toggle="modal"  data-pertanyaan="{{ $item->pertanyaan }}"  data-jawaban="{{ $item->jawaban }}"  data-status="{{ $item->status }}"  data-id="{{ $item->id }}" data-target="#ubah" title="" class="dropdown-item text-success" data-original-title="Edit Task">
                                                        <i class="fa fa-edit" style="width: 20px;"></i> EDIT
                                                    </button>
                                                <div class="dropdown-divider"></div>
                                                <button onclick="deleteRow( {{ $item->id }} )" class="dropdown-item text-danger"><i class="fas fa-trash-alt w20p"></i> HAPUS</button>
                                                </div>
                                            </div>
                                    </td>
                                    <td>
                                        @if ($item->status == 'valid')
                                            <ul>
                                                @foreach (json_decode($item->pertanyaan) as $k)
                                                    <li>{{ $k }}?</li>
                                                @endforeach
                                            </ul>
                                            
                                        @else
                                            {{ $item->pertanyaan }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->jawaban}}
                                    </td>
                                    <td class="text-center">{{ $item->status}}</td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">tidak ada data</td>
                                </tr>
                            @endforelse
                    </table>
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
            <form action="{{ url('/chatomzbot')}}" method="post">
                @csrf
                <input type="hidden" name="status" value="{{ $main['filter']['status'] }}">
            <div class="modal-header">
            <h4 class="modal-title">Tambah Pertanyaan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama Pertanyaan {!! ireq() !!}</label>
                        <textarea name="pertanyaan" id="pertanyaan" cols="30" rows="5" class="form-control col-md-8" required></textarea>
                   </div>
                   <div class="form-group row">
                       <label for="" class="col-md-4">Jawaban {!! ireq() !!}</label>
                       <textarea name="jawaban" id="jawaban" cols="30" rows="4" class="form-control col-md-8" required></textarea>
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
            <form action="{{ route('chatomzbot.update','test')}}" method="post">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Bot</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" id="id">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4">Nama Pertanyaan {!! ireq() !!}</label>
                        <textarea name="pertanyaan" id="pertanyaan" cols="30" rows="5" class="form-control col-md-8" required></textarea>
                   </div>
                   <div class="form-group row">
                       <label for="" class="col-md-4">Arahkan ke jawaban</label>
                       <div class="col-md-8 p-0">
                           <select name="datajawaban" id="datajawaban" class="form-control select2bs4" data-width="100%" required>
                               <option value="tidak">tidak ada</option>
                               @foreach ($botvalid as $item)
                                   <option value="{{ $item->id }}">{{ $item->jawaban }}</option>
                               @endforeach
                           </select>
                       </div>
                    </div>
                   <div class="form-group row">
                       <label for="" class="col-md-4">Jawaban</label>
                       <textarea name="jawaban" id="jawaban" cols="30" rows="4" class="form-control col-md-8"></textarea>
                    </div>
                   <div class="form-group row">
                       <label for="" class="col-md-4">Status {!! ireq() !!}</label>
                       <select name="status" id="status" class="form-control col-md-8" required>
                           <option value="valid">Valid</option>
                           <option value="proses">Proses</option>
                           <option value="filter">Kata Filter</option>
                           <option value="default">Kata Default</option>
                       </select>
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
                var pertanyaan = button.data('pertanyaan')
                var jawaban = button.data('jawaban')
                var status = button.data('status')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #pertanyaan').val(pertanyaan);
                modal.find('.modal-body #jawaban').val(jawaban);
                modal.find('.modal-body #status').val(status);
                modal.find('.modal-body #id').val(id);
            })
        </script>
        <script>
            $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
