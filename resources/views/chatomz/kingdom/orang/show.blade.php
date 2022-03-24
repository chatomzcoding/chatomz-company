<x-mazer-layout alert="TRUE">
    <x-slot name="title">
        CHATOMZ - Detail Orang
    </x-slot>
    <x-slot name="content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Data Orang</h3>
                        <p class="text-subtitle text-muted">detail {{ fullname($orang) }}</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('orang')}}">Daftar Orang</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-content">
                                <a href="{{ asset('/img/chatomz/orang/'.orang_photo($orang->photo))}}" target="_blank">
                                    <img src="{{ asset('/img/chatomz/orang/'.orang_photo($orang->photo))}}" class="card-img-top img-fluid"
                                    alt="singleminded">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{ fullname($orang) }}  @if ($orang->gender == 'laki-laki')
                                        <sup><i class="fas fa-mars text-primary"></i></sup>  
                                    @else
                                        <sup><i class="fas fa-venus text-danger"></i></sup>  
                                    @endif <small class="float-end fst-italic">{{ age($orang->date_birth,'Bulan')}}</small></h5>
                                    <p class="card-text">
                                       {{ $orang->note }}
                                    </p>
                                    <p class="demo text-center">
                                        <form id="data-{{ $orang->id }}" action="{{url('/orang/'.$orang->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            </form>
                                            <button onclick="deleteRow( {{ $orang->id }} )" class="btn btn-icon btn-round btn-danger pop-info" title="hapus orang"><i class="fas fa-trash-alt"></i></button>
                                        <a href="{{ url('orang/'.Crypt::encryptString($orang->id).'/edit')}}" style="display: inline;">
                                            <button type="button" class="btn btn-icon btn-round btn-success pop-info" title="Edit Orang">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                        </a>
                                        @if (Auth::user()->level == 'admin')
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#grup">
                                                <button type="button" class="btn btn-icon btn-round btn-info pop-info" title="anggota grup">
                                                    <i class="far fa-id-card"></i>
                                                </button>
                                            </a>
                                        @endif
                                        @if ($orang->marital_status == 'sudah' || count($keluarga) > 0)
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#keluarga">
                                                <button type="button" class="btn btn-icon btn-round btn-secondary pop-info" title="lihat silsilah keluarga">
                                                    <i class="fas fa-sitemap"></i>
                                                </button>
                                            </a>
                                            @endif
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#linimasa">
                                            <button type="button" class="btn btn-icon btn-round bg-primary pop-info text-white" title="tambah lini masa">
                                                <i class="fas fa-stream"></i>
                                            </button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-end">
                                    @if (!is_null($tombol['back']))
                                    <span class="float-right"><a href="{{ url('orang',Crypt::encryptString($tombol['back']->id))}}"  data-bs-toggle="tooltip" title="sebelumnya"><i class="fas fa-angle-left"></i></a></span>
                                    @endif
                                    @if (!is_null($tombol['next']))
                                        <span class="float-right"><a href="{{ url('orang',Crypt::encryptString($tombol['next']->id))}}" data-bs-toggle="tooltip" title="selanjutnya">
                                        <i class="fas fa-angle-right"></i></a></span><span class="float-right">&nbsp;&nbsp;&nbsp;</span>
                                    @endif 
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">Tentang</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile"
                                            role="tab" aria-controls="profile" aria-selected="false">Kontak</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact"
                                            role="tab" aria-controls="contact" aria-selected="false">Pendidikan</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="p-3">
                                            <strong><i class="fas fa-address-book"></i> Alamat</strong>
                                            <div class="py-0 px-3">
                                                <p class="text-muted">
                                                  {{ $orang->home_address }}
                                                </p>
                                            </div>
                                            <hr>
                                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Tempat Lahir</strong>
                                            <div class="py-0 px-3">
                                                  <p class="text-muted">{{ $orang->place_birth.', '.date_indo($orang->date_birth)}}</p>
                                            </div>
                                            <hr>
                                            <strong><i class="fas fa-pray"></i> Agama</strong>
                                            <div class="py-0 px-3">
                                                <p class="text-muted">
                                                  {{ $orang->religion}}
                                                </p>
                                            </div>
                                            <hr>
                                            <strong><i class="bi-person mr-1"></i> Status Pekerjaan</strong>
                                            <div class="py-0 px-3">
                                                <p class="text-muted">
                                                  {{ $orang->job_status}}
                                                </p>
                                            </div>
                                            <hr>
                                            <strong><i class="bi-heart mr-1"></i> Status Perkawinan</strong>
                                            <div class="py-0 px-3">
                                                <p class="text-muted">
                                                  {{ $orang->marital_status}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        @if (is_null($kontak))
                                        <div class="text-center m-3 p-3">
                                            <p><i> Data kontak belum ada </i></p>
                                            <a href="#" class="btn btn-secondary btn-sm" data-bs-target="#tambahkontak" data-bs-toggle="modal"><i class="fa fa-plus bg-white rounded-circle text-secondary p-1"></i> tambahkan</a>
                                        </div>
                                    @else
                                        <table class="table mt-3">
                                            <tbody>
                                                @if (!is_null($kontak->no_hp))
                                                    <tr>
                                                        <th>No. Handphone</th>
                                                        <td>{{ $kontak->no_hp}}</td>
                                                    </tr>
                                                @endif
                                                @if (!is_null($kontak->no_tel))
                                                    <tr>
                                                        <th>No. Telepon</th>
                                                        <td>{{ $kontak->no_tel}}</td>
                                                    </tr>
                                                @endif
                                                @if (!is_null($kontak->no_wa))
                                                    <tr>
                                                        <th>No. Whatsapp</th>
                                                        <td>{{ $kontak->no_wa}}</td>
                                                    </tr>
                                                @endif
                                                @if (!is_null($kontak->email))
                                                    <tr>
                                                        <th>E-mail</th>
                                                        <td class="text-lowercase">{{ $kontak->email}}</td>
                                                    </tr>
                                                @endif
                                                @if (!is_null($kontak->office_email))
                                                    <tr>
                                                        <th>E-mail Office</th>
                                                        <td class="text-lowercase">{{ $kontak->office_email}}</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <th>Social Media</th>
                                                    <td>
                                                        @if (!is_null($kontak->fb))
                                                            <a href="{{ $kontak->fb}}" target="_blank" class="{{ linkDisabled($kontak->fb) }}"><i class="fab fa-facebook-square fa-2x"></i></a>&nbsp;
                                                        @endif
                                                        @if (!is_null($kontak->tw))
                                                            <a href="{{ $kontak->tw}}" target="_blank" class="{{ linkDisabled($kontak->tw) }}"><i class="fab fa-twitter-square fa-2x"></i></a>&nbsp;
                                                        @endif
                                                        @if (!is_null($kontak->ig))
                                                            <a href="{{ $kontak->ig}}" target="_blank" class="{{ linkDisabled($kontak->ig) }}"><i class="fab fa-instagram fa-2x"></i></a> &nbsp;
                                                        @endif
                                                        @if (!is_null($kontak->line))
                                                            <a href="{{ $kontak->line}}" target="_blank" class="{{ linkDisabled($kontak->link) }}"><i class="fab fa-line fa-2x"></i></a> 
                                                        @endif
                                                        </td>
                                                </tr>
                                                @if (!is_null($kontak->web))
                                                    <tr>
                                                        <th>Website</th>
                                                        <td><a href="{{ '/'.$kontak->web}}" target="_blank">{{ $kontak->web}}</a> </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td colspan="2">
                                                        <a href="{{ url('/kontak/'.Crypt::encryptString($kontak->id).'/edit')}}" class="btn btn-success btn-sm"><i class="fas fa-pen"></i> EDIT KONTAK</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                    </div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel"
                                        aria-labelledby="contact-tab">
                                        @if (is_null($pendidikan))
                                        <div class="text-center m-3 p-3">
                                            <p class="font-italic">Data pendidikan belum tersedia</p>
                                            <a href="#" class="btn btn-secondary btn-sm" data-bs-target="#tambahpendidikan" data-bs-toggle="modal"><i class="fa fa-plus bg-white rounded-circle text-secondary p-1"></i>  tambahkan</a>
                                        </div>
                                    @else
                                        <table class="table mt-3">
                                            <tbody class="text-capitalize">
                                                @if (!is_null($pendidikan->tk))
                                                    <tr>
                                                        <th>TA / TPA</th>
                                                        <td class="text-uppercase">{{ $pendidikan->tk}}</td>
                                                    </tr>
                                                @endif
                                                @if (!is_null($pendidikan->sd))
                                                <tr>
                                                    <th>SD</th>
                                                    <td class="text-uppercase">{{ $pendidikan->sd}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->smp))
                                                <tr>
                                                    <th>SMP/MTS</th>
                                                    <td  class="text-uppercase">{{ $pendidikan->smp}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->sma))
                                                <tr>
                                                    <th>SMA/SMK/MA</th>
                                                    <td  class="text-uppercase">{{ $pendidikan->sma}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->d))
                                                <tr>
                                                    <th>Diploma</th>
                                                    <td  class="text-uppercase">{{ $pendidikan->d}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->s1))
                                                <tr>
                                                    <th>S1</th>
                                                    <td  class="text-uppercase">{{ $pendidikan->s1}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->s2))
                                                <tr>
                                                    <th>S2</th>
                                                    <td  class="text-uppercase">{{ $pendidikan->s2}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->s3))
                                                <tr>
                                                    <th>S3</th>
                                                    <td  class="text-uppercase">{{ $pendidikan->s3}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->pesantren))
                                                <tr>
                                                    <th>Pesantren</th>
                                                    <td  class="text-uppercase">{{ $pendidikan->pesantren}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->homescholl))
                                                <tr>
                                                    <th>Home Scholling</th>
                                                    <td class="text-lowercase">{{ $pendidikan->homescholl}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->boardingscholl))
                                                <tr>
                                                    <th>Boarding Scholling</th>
                                                    <td class="text-lowercase">{{ $pendidikan->boardingscholl}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->bimbel))
                                                <tr>
                                                    <th>Bimbel</th>
                                                    <td class="text-lowercase">{{ $pendidikan->bimbel}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->kursus))
                                                <tr>
                                                    <th>Kursus</th>
                                                    <td class="text-lowercase">{{ $pendidikan->kursus}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->information))
                                                <tr>
                                                    <th>Information</th>
                                                    <td class="text-lowercase">{{ $pendidikan->information}}</td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <td colspan="2">
                                                        <a href="{{ url('/pendidikan/'.Crypt::encryptString($pendidikan->id).'/edit')}}" class="btn btn-success btn-sm"><i class="fas fa-pen"></i> EDIT PENDIDIKAN</a>
                                                    </td>
                                                </tr>
                                               
                                            </tbody>
                                        </table>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
        {{-- MODAL --}}
        <div class="modal fade" id="ubahlinimasa">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <form action="{{ route('linimasa.update','test')}}" method="post">
                    @csrf
                    @method('patch')
                <div class="modal-header">
                <h4 class="modal-title">Edit Lini Masa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body p-3">
                    <input type="hidden" id="id" name="id">
                    <section class="p-3">
                        <div class="form-group">
                            <label for="">Tanggal {!! ireq() !!}</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jam</label>
                            <input type="time" name="jam" id="jam" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Lini Masa {!! ireq() !!}</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan {!! ireq() !!}</label>
                            <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Icon</label>
                            <input type="text" name="icon" id="icon" value="calendar" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tag</label>
                            <input type="text" name="tag" id="tag" class="form-control">
                        </div>
                    </section>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <div class="modal fade" id="tambahgrup">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <form action="{{ url('/grupanggota')}}" method="post">
                    @csrf
                    <input type="hidden" name="orang_id" value="{{ $orang->id }}">
                    <input type="hidden" name="sesi" value="anggotalist">
                <div class="modal-header">
                <h4 class="modal-title">Tambah Grup</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body p-3">
                    <section class="p-3">
                        <p>ceklis bila ingin dimasukkan kedalam grup</p>
                        @foreach ($datagrup as $item)
                            @if (!DbChatomz::cekstatusgrup($item->id,$orang->id))
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <input type="checkbox" name="grup_id[]" value="{{ $item->id }}"> <span class="text-uppercase">{{ $item->name }}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="information[]" class="form-control" placeholder="masukkan informasi">
                                    </div>
                                </div>
                            @endif
                        @endforeach
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
        {{-- tambah pendidikan --}}
        <x-modalsimpan judul="tambah pendidikan" link="pendidikan" id="tambahpendidikan" size="modal-lg">
            <section class="p-3">
                <input type="hidden" name="orang_id" value="{{ $orang->id }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">TK/TPA</label>
                            <input type="text" class="form-control form-control-sm" name="tk">
                        </div>
                        <div class="form-group">
                            <label for="">SD</label>
                            <input type="text" class="form-control form-control-sm" name="sd">
                        </div>
                        <div class="form-group">
                            <label for="">SMP/MTS</label>
                            <input type="text" class="form-control form-control-sm" name="smp">
                        </div>
                        <div class="form-group">
                            <label for="">SMA/SMK/MA</label>
                            <input type="text" class="form-control form-control-sm" name="sma">
                        </div>
                        <div class="form-group">
                            <label for="">Jenjang Diploma</label>
                            <input type="text" class="form-control form-control-sm" name="d">
                        </div>
                        <div class="form-group">
                            <label for="">Jenjang S1</label>
                            <input type="text" class="form-control form-control-sm" name="s1">
                        </div>
                        <div class="form-group">
                            <label for="">Jenjang S2</label>
                            <input type="text" class="form-control form-control-sm" name="s2">
                        </div>
                        <div class="form-group">
                            <label for="">Jenjang S3</label>
                            <input type="text" class="form-control form-control-sm" name="s3">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Pesantren</label>
                            <input type="text" class="form-control form-control-sm" name="pesantren">
                        </div>
                        <div class="form-group">
                            <label for="">Sekolah Dirumah</label>
                            <input type="text" class="form-control form-control-sm" name="homescholl">
                        </div>
                        <div class="form-group">
                            <label for="">Boarding Scholl</label>
                            <input type="text" class="form-control form-control-sm" name="boardingscholl">
                        </div>
                        <div class="form-group">
                            <label for="">Bimbingan Belajar</label>
                            <input type="text" class="form-control form-control-sm" name="bimbel">
                        </div>
                        <div class="form-group">
                            <label for="">Kursus</label>
                            <input type="text" class="form-control form-control-sm" name="kursus">
                        </div>
                        <div class="form-group">
                            <label for="">Informasi Singkat</label>
                            <textarea name="information" id="" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </section>
        </x-modalsimpan>

        {{-- tambah kontak --}}
        <x-modalsimpan judul="tambah kontak" link="kontak" id="tambahkontak" size="modal-lg">
            <section class="p-3">
                <input type="hidden" name="orang_id" value="{{ $orang->id }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">No Telepon Seluler</label>
                            <input type="text" class="form-control form-control-sm" name="no_hp" placeholder="input number phone celluler">
                        </div>
                        <div class="form-group">
                            <label for="">No Telepon Rumah</label>
                            <input type="text" class="form-control form-control-sm" name="no_tel" placeholder="input number phone home">
                        </div>
                        <div class="form-group">
                            <label for="">No Whatsapp</label>
                            <input type="text" class="form-control form-control-sm" name="no_wa" placeholder="input number whatsapp">
                        </div>
                        <div class="form-group">
                            <label for="">No Telepon Kantor</label>
                            <input type="text" class="form-control form-control-sm" name="no_office" placeholder="input number office phone">
                        </div>
                        <div class="row form-group">
                            <label for="">Alamat E-mail</label>
                            <input type="text" class="form-control form-control-sm" name="email" placeholder="input email address">
                        </div>
                        <div class="row form-group">
                            <label for="">Alamat E-mail Kantor</label>
                            <input type="text" class="form-control form-control-sm" name="office_email" placeholder="input email office address">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row form-group">
                            <label for="">Link Facebook</label>
                            <input type="text" class="form-control form-control-sm" name="fb" placeholder="input link facebook">
                        </div>
                        <div class="row form-group">
                            <label for="">Link Twitter</label>
                            <input type="text" class="form-control form-control-sm" name="tw" placeholder="input link twitter">
                        </div>
                        <div class="row form-group">
                            <label for="">Link Instagram</label>
                            <input type="text" class="form-control form-control-sm" name="ig" placeholder="input link instagram">
                        </div>
                        <div class="row form-group">
                            <label for="">Website</label>
                            <input type="text" class="form-control form-control-sm" name="web" placeholder="input website">
                        </div>
                        <div class="row form-group">
                            <label for="">Line</label>
                            <input type="text" class="form-control form-control-sm" name="line" placeholder="input account line">
                        </div>
                    </div>
                </div>
            </section>
        </x-modalsimpan>

        {{-- tambah lini masa --}}
        <x-modalsimpan judul="tambah linimasa" link="linimasa" id="linimasa">
            <section class="p-3">
                <input type="hidden" name="orang_id" value="{{ $orang->id }}">
                <div class="form-group">
                    <label for="">Tanggal {!! ireq() !!}</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Jam</label>
                    <input type="time" name="jam" id="jam" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Nama Lini Masa {!! ireq() !!}</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Keterangan {!! ireq() !!}</label>
                    <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="">Icon</label>
                    <input type="text" name="icon" id="icon" value="calendar" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Tag</label>
                    <input type="text" name="tag" id="tag" class="form-control">
                </div>
            </section>
        </x-modalsimpan>

        {{-- modal keluarga --}}
        <x-modal judul="Riwayat Keluarga" id="keluarga">
            <section class="row p-3">
                @if (count($suami) > 0)
                    @foreach ($suami as $item)
                        <div class="col-md-12">
                            <div class="card bg-primary">
                                <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ asset('/img/chatomz/orang/'.orang_photo($orang->photo))}}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-2 text-white">
                                        <small class="text-capitalize">{{ fullname($orang)}}
                                        <a href="{{ url('/keluarga/'.Crypt::encryptString($item->id)) }}" class="float-end text-white p-2"><i class="bi bi-arrow-up-right"></i></a>
                                        <br>
                                        <i>Kepala Keluarga</i> <br> {{ $item->nama_keluarga }}</small>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    {{-- jika laki laki dan sudah kawin maka munculkan tambahkan keluarga --}}
                    @if ($orang->gender == 'laki-laki' AND $orang->marital_status == 'sudah')
                    <section class="col-md-12 text-center mb-3">
                        <small class="font-italic">Memenuhi syarat menjadi kepala keluarga</small> <br>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary btn-sm">Tambahkan keluarga baru</a>
                    </section>
                    @endif
                @endif

                @if (count($keluarga) == 0)
                    @if ($orang->gender == 'perempuan' AND $orang->marital_status == 'sudah' AND count($daftarkeluarga) > 0)
                        <section class="col-md-12 text-center">
                            <small class="font-italic">Memenuhi syarat menjadi seorang istri</small> <br>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tambahkeluarga" class="btn btn-primary btn-sm">Tambahkan keluarga</a>
                        </section>
                    @else
                        <section class="text-center">
                            <small class="font-italic">belum ada keluarga yang dibuat</small>
                        </section>
                    @endif
                @endif
                
                @foreach ($keluarga as $item)
                @if ($item->status == 'istri')
                    <div class="col-md-12">
                        <div class="card bg-info">
                            <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-2 text-white">
                                    <small class="text-capitalize">{{ fullname($item)}}
                                    <a href="{{ url('/keluarga/'.Crypt::encryptString($item->keluarga_id)) }}" class="float-end text-white p-2"><i class="bi bi-arrow-up-right"></i></a>
                                    <br>
                                <i>{{ $item->status }}</i> <br> {{ $item->nama_keluarga }}</small>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($item->status == 'anak')
                    <div class="col-md-12">
                        <div class="card bg-success">
                            <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-2 text-white">
                                    <small class="text-capitalize">{{ fullname($item)}}
                                    <a href="{{ url('/keluarga/'.Crypt::encryptString($item->keluarga_id)) }}" class="float-end text-white p-2"><i class="bi bi-arrow-up-right"></i></a>
                                    <br>
                                <i>{{ $item->status .' - '. $item->urutan }}</i> <br> {{ $item->nama_keluarga }}</small>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                @endif
                @endforeach
            </section>
        </x-modal>

        {{-- anggota grup --}}
        <x-modal judul="Anggota grup" id="grup" size="modal-lg">
            <section class="row p-2">
                @foreach ($anggotagrup as $item)
                <div class="col-md-4">
                <div class="card">
                    <a href="{{ url('grup/'.Crypt::encryptString($item->grup_id))}}"><img src="{{ asset('/img/chatomz/grup/'.$item->photo)}}" class="card-img-top" alt="..."></a>
                    <div class="card-body p-1 text-center">
                        <p class="small text-capitalize">{{ $item->name}}</p>
                        <small class="text-muted">{{ $item->information }}</small>
                    </div>
                    <div class="card-footer">
                        <form id="data-{{ $item->id }}" action="{{url('/grupanggota',$item->id)}}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                        <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-outline-danger btn-sm float-right mx-1"><i class="fas fa-trash-alt"></i></button>
                        <button type="button" data-bs-toggle="modal"  data-information="{{ $item->information }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="btn btn-outline-success btn-sm float-right" data-original-title="Edit Task">
                            <i class="fa fa-edit"></i>
                        </button>
                    </div>
                    </div>
                </div>
                @endforeach
            </section>
        </x-modal>

        {{-- ubah anggota grup --}}
        <x-modalubah judul="Edit Anggota" link="grupanggota">
            <input type="hidden" name="id" id="id">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <input type="text" name="information" id="information" class="form-control">
                </div>
            </section>
        </x-modalubah>

        {{-- tambah keluarga baru (suami) --}}
        <x-modalsimpan judul="Tambah Keluarga Baru" link="keluarga">
            <input type="hidden" name="orang_id" value="{{ $orang->id }}">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Keluarga</label>
                    <input type="text" name="nama_keluarga" id="nama_keluarga" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">No KK</label>
                    <input type="text" name="no_kk" id="no_kk" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Tanggal Pernikahan</label>
                    <input type="date" name="tgl_pernikahan" id="tgl_pernikahan" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Status Keluarga</label>
                    <select name="status_keluarga" id="status_keluarga" class="form-control">
                        @foreach (kingdom_statuskeluarga() as $item)
                            <option value="{{ $item}}">{{ $item}}</option>
                        @endforeach
                    </select>
                </div>
            </section>
        </x-modalsimpan>

        <x-modalsimpan judul="Tambah Keluarga" link="keluargahubungan" id="tambahkeluarga">
            <section class="p-3">
                <input type="hidden" name="orang_id" value="{{ $orang->id }}">
                <input type="hidden" name="status" value="istri">
                <input type="hidden" name="urutan" value="1">
                <div class="form-group">
                        <label for="">Daftar Keluarga</label>
                        <select name="keluarga_id" id="keluarga_id" class="form-control">
                            @foreach ($daftarkeluarga as $item)
                                <option value="{{ $item->id}}">{{ $item->nama_keluarga}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control">
                </div>
            </section>
        </x-modalsimpan>

    </x-slot>

    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var information = button.data('information')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #information').val(information);
                modal.find('.modal-body #id').val(id);
            })
        </script>
        <script>
            $('#ubahlinimasa').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama = button.data('nama')
                var keterangan = button.data('keterangan')
                var icon = button.data('icon')
                var tanggal = button.data('tanggal')
                var jam = button.data('jam')
                var tag = button.data('tag')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #keterangan').val(keterangan);
                modal.find('.modal-body #icon').val(icon);
                modal.find('.modal-body #tanggal').val(tanggal);
                modal.find('.modal-body #jam').val(jam);
                modal.find('.modal-body #tag').val(tag);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>
</x-mazer-layout>
