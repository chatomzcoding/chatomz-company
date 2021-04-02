@section('title')
    CHATOMZ - Detail Orang
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Orang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url('orang')}}">Daftar Orang</a></li>
                <li class="breadcrumb-item active">Detail {{ $orang->first_name.' '.$orang->last_name}}</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div> --}}
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h4 class="card-title text-capitalize">{{ fullname($orang)}} 
                    @if ($orang->gender == 'male')
                        <sup><i class="fas fa-mars text-primary"></i></sup>  
                    @else
                        <sup><i class="fas fa-venus text-danger"></i></sup>  
                    @endif
                    
                    @if (!is_null($tombol['next']))
                        <span class="float-right"><a href="{{ url('orang',Crypt::encryptString($tombol['next']->id))}}">
                        <i class="fas fa-angle-right"></i></a></span><span class="float-right">&nbsp;&nbsp;&nbsp;</span>
                    @endif 
                    @if (!is_null($tombol['back']))
                    <span class="float-right"><a href="{{ url('orang',Crypt::encryptString($tombol['back']->id))}}"><i class="fas fa-angle-left"></i></a></span>
                    @endif
                </h4>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                    <section>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card card-post card-round">
                                    <a href="#" data-target="#ubahphoto" data-toggle="modal"><img class="card-img-top" src="{{ asset('/img/chatomz/orang/'.$orang->photo)}}" alt="Card image cap"></a>
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="avatar">
                                                <a href="{{ asset('/img/chatomz/orang/'.$orang->photo)}}" target="_blank"><img src="{{ asset('/img/chatomz/orang/'.$orang->photo)}}" width="50px" alt="..." class="avatar-img rounded-circle"></a>
                                            </div>
                                            <div class="info-post ml-2">
                                                <p class="username text-capitalize">{{ $orang->job_status}}</p>
                                                <p class="date text-muted">{{ age($orang->date_birth,'Bulan')}}</p>
                                            </div>
                                        </div>
                                        <div class="separator-solid"></div>
                                        {{-- <p class="card-category text-info mb-1">Quick Access</p> --}}
                                        <h3 class="card-title">
                                            <p class="demo">
                                                <form id="data-{{ $orang->id }}" action="{{url('/orang',Crypt::encryptString($orang->id))}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    </form>
                                                    <button onclick="deleteRow( {{ $orang->id }} )" class="btn btn-icon btn-round btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                <a href="{{ url('orang/'.Crypt::encryptString($orang->id).'/edit')}}" style="display: inline;">
                                                    <button type="button" class="btn btn-icon btn-round btn-success">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                </a>
                                                @if (Auth::user()->level == 'admin')
                                                    {{-- <a href="#" data-toggle="modal" data-target="#addRowModal" class=" notif-block">
                                                        <button type="button" class="btn btn-icon btn-round btn-success">
                                                            <i class="fas fa-address-book"></i>
                                                        </button>
                                                        <span class="{{ bgaddgroupicon($orang->status_group)}}">{{ count($groups) }}</span>
                                                    </a> --}}
                                                    <a href="#" data-toggle="modal" data-target="#addreminder">
                                                        <button type="button" class="btn btn-icon btn-round btn-success">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                                <a href="#" data-toggle="modal" data-target="#addfamily">
                                                    <button type="button" class="btn btn-icon btn-round btn-secondary">
                                                        <i class="fas fa-sitemap"></i>
                                                    </button>
                                                </a>
                                            </p>
                                        </h3>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab-nobd" data-toggle="pill" href="#pills-home-nobd" role="tab" aria-controls="pills-home-nobd" aria-selected="true"><i class="far fa-user"></i><strong> | PROFIL</strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false"><i class="fas fa-phone"></i> | <strong>KONTAK</strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-contact-tab-nobd" data-toggle="pill" href="#pills-contact-nobd" role="tab" aria-controls="pills-contact-nobd" aria-selected="false"><i class="fas fa-user-graduate"></i> | <strong>PENDIDIKAN</strong> </a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
                                        <table class="table mt-3">
                                            <tbody class="text-capitalize">
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>{{ $orang->home_address}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tempat Lahir</th>
                                                    <td>{{ $orang->place_birth.', '.$orang->date_birth}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Agama</th>
                                                    <td>{{ $orang->religion}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status Perkawinan</th>
                                                    <td>{{ $orang->marital_status}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Golongan Darah</th>
                                                    <td>{{ $orang->blood_type}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Kebangsaan</th>
                                                    <td>{{ $orang->nasionality}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
                                        {{-- @if (is_null($contact))
                                            <div class="text-center m-3 p-3">
                                                <p><i> Data kontak belum ada </i></p>
                                                <a href="#" class="btn btn-secondary btn-sm" data-target="#addcontact" data-toggle="modal"><i class="fa fa-plus bg-white rounded-circle text-secondary p-1"></i> tambahkan</a>
                                            </div>
                                        @else
                                            <table class="table mt-3">
                                                <tbody class="text-capitalize">
                                                    <tr>
                                                        <th>No. Handphone</th>
                                                        <td>{{ $contact->no_hp}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>No. Telepon</th>
                                                        <td>{{ $contact->no_tel}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>No. Whatsapp</th>
                                                        <td>{{ $contact->no_wa}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>E-mail</th>
                                                        <td class="text-lowercase">{{ $contact->email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>E-mail Office</th>
                                                        <td class="text-lowercase">{{ $contact->office_email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Social Media</th>
                                                        <td>
                                                            <a href="{{ $contact->fb}}" target="_blank" class="{{ linkDisabled($contact->fb) }}"><i class="fab fa-facebook-square fa-2x"></i></a>&nbsp;
                                                            <a href="{{ $contact->tw}}" target="_blank" class="{{ linkDisabled($contact->tw) }}"><i class="fab fa-twitter-square fa-2x"></i></a>&nbsp;
                                                            <a href="{{ $contact->ig}}" target="_blank" class="{{ linkDisabled($contact->ig) }}"><i class="fab fa-instagram fa-2x"></i></a> &nbsp;
                                                            <a href="{{ $contact->line}}" target="_blank" class="{{ linkDisabled($contact->link) }}"><i class="fab fa-line fa-2x"></i></a> 
                                                         </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Website</th>
                                                        <td><a href="{{ '/'.$contact->web}}" target="_blank">{{ $contact->web}}</a> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @endif --}}
                                    </div>
                                    <div class="tab-pane fade" id="pills-contact-nobd" role="tabpanel" aria-labelledby="pills-contact-tab-nobd">
                                        {{-- @if (is_null($education))
                                            <div class="text-center m-3 p-3">
                                                <p class="font-italic">Data pendidikan belum tersedia</p>
                                                <a href="#" class="btn btn-secondary btn-sm" data-target="#addeducation" data-toggle="modal"><i class="fa fa-plus bg-white rounded-circle text-secondary p-1"></i>  tambahkan</a>
                                            </div>
                                        @else
                                            <table class="table mt-3">
                                                <tbody class="text-capitalize">
                                                    @if (!is_null($education->tk))
                                                        <tr>
                                                            <th>TA / TPA</th>
                                                            <td class="text-uppercase">{{ $education->tk}}</td>
                                                        </tr>
                                                    @endif
                                                    @if (!is_null($education->sd))
                                                    <tr>
                                                        <th>SD</th>
                                                        <td class="text-uppercase">{{ $education->sd}}</td>
                                                    </tr>
                                                    @endif
                                                    @if (!is_null($education->smp))
                                                    <tr>
                                                        <th>SMP/MTS</th>
                                                        <td  class="text-uppercase">{{ $education->smp}}</td>
                                                    </tr>
                                                    @endif
                                                    @if (!is_null($education->sma))
                                                    <tr>
                                                        <th>SMA/SMK/MA</th>
                                                        <td  class="text-uppercase">{{ $education->sma}}</td>
                                                    </tr>
                                                    @endif
                                                    @if (!is_null($education->d))
                                                    <tr>
                                                        <th>Diploma</th>
                                                        <td  class="text-uppercase">{{ $education->d}}</td>
                                                    </tr>
                                                    @endif
                                                    @if (!is_null($education->s1))
                                                    <tr>
                                                        <th>S1</th>
                                                        <td  class="text-uppercase">{{ $education->s1}}</td>
                                                    </tr>
                                                    @endif
                                                    @if (!is_null($education->s2))
                                                    <tr>
                                                        <th>S2</th>
                                                        <td  class="text-uppercase">{{ $education->s2}}</td>
                                                    </tr>
                                                    @endif
                                                    @if (!is_null($education->s3))
                                                    <tr>
                                                        <th>S3</th>
                                                        <td  class="text-uppercase">{{ $education->s3}}</td>
                                                    </tr>
                                                    @endif
                                                    @if (!is_null($education->pesantren))
                                                    <tr>
                                                        <th>Pesantren</th>
                                                        <td  class="text-uppercase">{{ $education->pesantren}}</td>
                                                    </tr>
                                                    @endif
                                                    @if (!is_null($education->homescholl))
                                                    <tr>
                                                        <th>Home Scholling</th>
                                                        <td class="text-lowercase">{{ $education->homescholl}}</td>
                                                    </tr>
                                                    @endif
                                                    @if (!is_null($education->boardingscholl))
                                                    <tr>
                                                        <th>Boarding Scholling</th>
                                                        <td class="text-lowercase">{{ $education->boardingscholl}}</td>
                                                    </tr>
                                                    @endif
                                                    @if (!is_null($education->bimbel))
                                                    <tr>
                                                        <th>Bimbel</th>
                                                        <td class="text-lowercase">{{ $education->bimbel}}</td>
                                                    </tr>
                                                    @endif
                                                    @if (!is_null($education->kursus))
                                                    <tr>
                                                        <th>Kursus</th>
                                                        <td class="text-lowercase">{{ $education->kursus}}</td>
                                                    </tr>
                                                    @endif
                                                    @if (!is_null($education->information))
                                                    <tr>
                                                        <th>Information</th>
                                                        <td class="text-lowercase">{{ $education->information}}</td>
                                                    </tr>
                                                    @endif
                                                   
                                                   
                                                </tbody>
                                            </table>
                                        @endif --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
              </div>
            </div>
          </div>
        </div>
    </div>
    {{-- modal --}}
    {{-- modal tambah --}}
    {{-- <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url('/orang')}}" method="post">
                @csrf
            <div class="modal-header">
            <h4 class="modal-title">Tambah Data Klasifikasi Surat</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                   <div class="form-group row">
                        <label for="" class="col-md-4">Kode</label>
                        <input type="text" name="kode" id="kode" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control col-md-8" required>
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
    </div> --}}
    <!-- /.modal -->

    {{-- modal edit --}}
    {{-- <div class="modal fade" id="ubah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ route('orang.update','test')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Klasifikasi Surat</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" id="id">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4">Kode</label>
                        <input type="text" name="kode" id="kode" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Status</label>
                        <select name="status" id="status" class="form-control col-md-8">
                            @foreach (list_status() as $item)
                                <option value="{{ $item}}">{{ $item}}</option>
                            @endforeach
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
    </div> --}}
    <!-- /.modal -->

    @section('script')
        
        {{-- <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama = button.data('nama')
                var kode = button.data('kode')
                var keterangan = button.data('keterangan')
                var status = button.data('status')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #kode').val(kode);
                modal.find('.modal-body #keterangan').val(keterangan);
                modal.find('.modal-body #status').val(status);
                modal.find('.modal-body #id').val(id);
            })
        </script> --}}
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
