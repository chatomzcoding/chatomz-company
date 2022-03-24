<x-mazer-layout title="CHATOMZ - DETAIL GRUP" select="TRUE" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Grup" active="Grup {{ $grup->name}}">
                <li class="breadcrumb-item"><a href="{{ url('grup')}}">Daftar Grup</a></li>
            </x-header>
            <div class="section">
                <div class="row">
                    <div class="col-md-12">
                        <form id="data-{{ $grup->id }}" action="{{url('/grup/'.$grup->id)}}" method="post">
                            @csrf
                            @method('delete')
                            </form>
                        <div class="card">
                        <div class="card-header">
                            <a href="{{ url('/grup')}}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-angle-left"></i> kembali </a>
                            <a href="#" class="btn btn-outline-success btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#editgrup"><i class="fas fa-pen"></i> Edit</a>
                            <button onclick="deleteRow( {{ $grup->id }} )" class="btn btn-outline-danger btn-sm btn-flat pop-info" title="hapus grup"><i class="fas fa-trash-alt"></i> Hapus</button>
                            <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah Anggota</a>
                            @if ($main['tag'] <> NULL)
                            <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#anggotatag"><i class="fas fa-plus"></i> Tambah Anggota Ke Tag #{{ $main['tag'] }} </a>
                            @endif
                            <span class="float-end">Total Anggota {{ count($anggota) }}</span>
                        </div>
                        <div class="card-body">
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
                                            class="badge bg-primary"
                                        @endif>#semua</a>
                                        @forelse (c_showtag($grup->dtag) as $item)
                                            <a href="{{ url('grup/'.Crypt::encryptString($grup->id).'?tag='.$item) }}"  @if ($main['tag'] == $item)
                                                class="badge bg-primary"
                                            @endif>#{{ $item }}</a>
                                        @empty
                                            
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <hr>
                                <div class="row d-flex align-items-stretch">
                                    @forelse ($anggota as $item)
                                        <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
                                            <div class="card mb-3 w-100">
                                                <div class="row no-gutters">
                                                    <form id="data-{{ $item->id }}" action="{{url('/grupanggota',$item->id)}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                    <div class="col-md-4">
                                                        <a id="dropdownMenuButton" data-bs-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false" class="w-100">
                                                            <img src="{{ asset('/img/chatomz/orang/'.$item->photo)}}" class="card-img" alt="...">
                                                        </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="{{ url('/orang/'.Crypt::encryptString($item->orang_id))}}"><i class="fa fa-user text-primary" style="width: 25px"></i> DETAIL</a>
                                                                @if (is_null($main['tag']))
                                                                    <button type="button" data-bs-toggle="modal"  data-information="{{ $item->information }}" data-nama="{{ fullname($item) }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item" data-original-title="Edit Task">
                                                                        <i class="fa fa-edit text-success" style="width: 25px"></i> EDIT</i>
                                                                    </button>
                                                                    
                                                                @else
                                                                    <button type="button" data-bs-toggle="modal"  data-information="{{ $item->information }}" data-nama="{{ fullname($item) }}" data-isi="{{ showpertag($item->tag,$main['tag']) }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item" data-original-title="Edit Task">
                                                                        <i class="fa fa-edit text-success" style="width: 25px"></i> EDIT</i>
                                                                    </button>
                                                                @endif
                                                                <a onclick="deleteRow( {{ $item->id }} )" type="button" class="dropdown-item"><i class="fa fa-trash-alt text-danger" style="width: 25px"></i> HAPUS</a>
                                                            </div>
                                                    </div>
                                                <div class="col-md-8">
                                                    <div class="card-body p-2">
                                                    <h6 class="card-title">
                                                        {{ fullname($item)}} 
                                                        @if ($item->gender == 'laki-laki')
                                                                <sup><i class="fas fa-mars text-primary"></i></sup>  
                                                            @else
                                                                <sup><i class="fas fa-venus text-danger"></i></sup>  
                                                            @endif
                                                    </h6>
                                                        @if (is_null($main['tag']))
                                                            <small class="text-muted">{{ $item->information }} <br>
                                                                <i>{{ c_listtag($item->tag) }}</i>
                                                            </small>
                                                            @else
                                                            <small>
                                                                #{{ $main['tag'] }} <br>
                                                                <i>{{ showpertag($item->tag,$main['tag']) }}</i>
                                                            </small>
                                                            @endif
                                                    </div>
                                                </div>
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
        </div>
        <x-modalsimpan judul="Tambah Anggota Grup" link="grupanggota">
            <section class="p-3">
                <input type="hidden" name="grup_id" value="{{ $grup->id }}">
               <div class="form-group">
                <label for="">Nama Anggota</label>
                <select name="orang_id" id="orang_id" class="form-control select2bs4" data-width="100%">
                    @foreach ($orang as $item)
                        @if (!DbChatomz::cekstatusgrup($grup->id,$item->id))
                            <option value="{{ $item->id}}">{{ fullname($item)}}</option>
                        @endif
                    @endforeach
                </select>
                </div>
               <div class="form-group">
                    <label for="">Keterangan</label>
                    <input type="text" name="information" id="information" class="form-control">
               </div>
               <div class="form-group">
                    <label for="">Tag</label>
                    <select name="tag[]" id=""  data-placeholder="pilih tag" class="select2bs4" style="width: 100%;" multiple>
                        @foreach (c_showtag($grup->dtag) as $item)
                            <option value="{{ $item }}">#{{ $item }}</option>
                        @endforeach
                    </select>
               </div>
            </section>
        </x-modalsimpan>
        <x-modalubah judul="Edit Anggota" link="grupanggota">
            <section class="p-3">
                <div class="form-group">
                     <label for="">Nama</label>
                     <input type="text" name="nama" id="nama" class="form-control" readonly>
                </div>
                @if (is_null($main['tag']))
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <input type="text" name="information" id="information" class="form-control">
                    </div>
                    <input type="hidden" name="sesitag" value="ya">
                    <div class="form-group">
                        <label for="">Tag</label>
                        <select name="tag[]" id=""  data-placeholder="pilih tag" class="select2bs4" style="width: 100%;" multiple>
                            @foreach (c_showtag($grup->dtag) as $item)
                                <option value="{{ $item }}">#{{ $item }}</option>
                            @endforeach
                        </select>
                        <input type="checkbox" name="hapustag" value="TRUE"> Hapus Tag
                     </div>
                     @else
                    <input type="hidden" name="sesitag" value="tidak">
                    <input type="hidden" name="dtag" value="#{{ $main['tag'] }}">
                    <div class="form-group">
                        <label for="">Keterangan Tag</label>
                        <input type="text" name="isi" id="isi" class="form-control">
                        <input type="checkbox" name="hapusdtag" value="TRUE"> Hapus Tag
                    </div>
                @endif
             </section>
        </x-modalubah>
        @if (!is_null($main['danggota']))
            <x-modalsimpan judul="Tambahkan anggota ke tag #{{ $main['tag'] }}" link="grupanggota" id="anggotatag">
                <section class="p-3">
                    <input type="hidden" name="tag" id="id" value="#{{ $main['tag'] }}">
                    <input type="hidden" name="sesi" value="taganggota">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN DATA</button>
                    <table class="table" id="example1">
                        <thead>
                            <tr>
                                <th  width="20%"></th>
                                <th>Nama</th>
                                <th class="text-center">Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($main['danggota'] as $item)
                            @if (DbChatomz::cekanggotagruptag($item->id,$main['tag']))
                                <tr>
                                    <td><img src="{{ asset('/img/chatomz/orang/'.$item->photo)}}" class="w-100" alt="..."></td>
                                    <td>{{ fullname($item)}} 
                                        @if ($item->gender == 'laki-laki')
                                            <sup><i class="fas fa-mars text-primary"></i></sup>  
                                        @else
                                            <sup><i class="fas fa-venus text-danger"></i></sup>  
                                        @endif
                                        <br>
                                        <input type="text" name="isi[{{ $item->id }}]" class="form-control form-control-sm" placeholder="keterangan" value="">
                                    </td>
                                    <td> <br>
                                        <input type="checkbox" name="id[]" value="{{ $item->id }}">
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </section>
            </x-modalsimpan>
        @endif
        <x-modalubah judul="Edit Grup" link="grup" id="editgrup">
            <section class="p-3">
                <input type="hidden" name="id" value="{{ $grup->id }}">
                <div class="form-group">
                     <label for="">Nama Grup {!! ireq() !!}</label>
                     <input type="text" name="name" id="name" value="{{ $grup->name }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <textarea name="keterangan" id="" cols="30" rows="4" class="form-control" required>{{ $grup->keterangan }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Data Tag</label>
                    <textarea name="dtag" id="" cols="30" rows="5" class="form-control">{{ $grup->dtag }}</textarea>
                </div>
                <div class="form-group">
                     <label for="">Gambar Grup {!! ireq() !!}</label>
                     <input type="file" name="photo" id="photo" class="form-control">
                </div>
            </section>
        </x-modalubah>
    </x-slot>

    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var information = button.data('information')
                var nama = button.data('nama')
                var isi = button.data('isi')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #information').val(information);
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #isi').val(isi);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>
</x-mazer-layout>
