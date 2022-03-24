<x-mazer-layout title="CHATOMZ - Daftar Keluarga">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Grup" active="Daftar Grup"></x-header>
            <div class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah Grup </a>
                            </div>
                            <div class="card-body">
                                    <div class="row d-flex align-items-stretch">
                                        @foreach ($grup as $item)
                                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                                <div class="card bg-primary text-white">
                                                    <div class="card-header bg-primary text-white border-bottom-0 text-uppercase text-center p-3">
                                                    {{ $item->name}}
                                                    </div>
                                                    <div class="card-body pb-0">
                                                        <div class="row">
                                                            <div class="col-md-12 text-center">
                                                                <a href="{{ url('/grup/'.Crypt::encryptString($item->id))}}"><img src="{{ asset('/img/chatomz/grup/'.$item->photo)}}" alt="user-avatar" class="img-fluid rounded border border-4"></a>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <p class="small"><b>{{ DbChatomz::countData('grup_anggota',['grup_id',$item->id])}} Anggota | {{ $item->created_year}}</b></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-modalsimpan judul="Tambah Grup Baru" link="grup">
            <section class="p-3">
                <div class="form-group">
                     <label for="">Nama Grup {!! ireq() !!}</label>
                     <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                </div>
                <div class="form-group">
                     <label for="">Tahun Dibuat {!! ireq() !!}</label>
                     <input type="text" name="created_year" id="created_year" value="{{ old('created_year') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <textarea name="keterangan" id="" cols="30" rows="3" class="form-control" required>{{ old('keterangan') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Data Tag</label>
                    <textarea name="dtag" id="" cols="30" rows="3" class="form-control">{{ old('dtag') }}</textarea>
                </div>
                <div class="form-group">
                     <label for="">Gambar Grup {!! ireq() !!}</label>
                     <input type="file" name="photo" id="photo" class="form-control" required>
                </div>
            </section>
        </x-modalsimpan>
    </x-slot>
</x-mazer-layout>
