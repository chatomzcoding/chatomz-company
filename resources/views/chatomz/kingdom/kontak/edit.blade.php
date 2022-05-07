<x-mazer-layout title="CHATOMZ - edit kontak">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Kontak" active="Edit Kontak">
                <li class="breadcrumb-item"><a href="{{ url('orang')}}">Daftar Orang</a></li>
                <li class="breadcrumb-item text-capitalize"><a href="{{ url('orang/'.Crypt::encryptString($orang->id))}}">{{ $orang->first_name.' '.$orang->last_name}}</a></li>
            </x-header>
            <div class="section">
                <div class="row">
                    <div class="col-md-12">
                            <div class="card">
                            <div class="card-header">
                                <x-sistem.kembali url="orang/{{ Crypt::encryptString($orang->id)}}"></x-sistem.kembali>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ url('/kontak/'.$kontak->id)}}">
                                    @csrf
                                    @method('patch')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-4 pt-2">No Telepon Seluler</label>
                                                <input type="text" class="form-control" name="no_hp" placeholder="input number phone celluler" value="{{ $kontak->no_hp }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 pt-2">No Telepon Rumah</label>
                                                <input type="text" class="form-control" name="no_tel" placeholder="input number phone home" value="{{ $kontak->no_tel }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 pt-2">No Whatsapp</label>
                                                <input type="text" class="form-control" name="no_wa" placeholder="input number whatsapp" value="{{ $kontak->no_wa }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 pt-2">No Telepon Kantor</label>
                                                <input type="text" class="form-control" name="no_office" placeholder="input number office phone" value="{{ $kontak->no_office }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 pt-2">Alamat E-mail</label>
                                                <input type="text" class="form-control" name="email" placeholder="input email address" value="{{ $kontak->email }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 pt-2">Alamat E-mail Kantor</label>
                                                <input type="text" class="form-control" name="office_email" placeholder="input email office address" value="{{ $kontak->office_email }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-4 pt-2">Link Facebook</label>
                                                <input type="text" class="form-control" name="fb" placeholder="input link facebook" value="{{ $kontak->fb }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 pt-2">Link Twitter</label>
                                                <input type="text" class="form-control" name="tw" placeholder="input link twitter" value="{{ $kontak->tw }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 pt-2">Link Instagram</label>
                                                <input type="text" class="form-control" name="ig" placeholder="input link instagram" value="{{ $kontak->ig }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 pt-2">Website</label>
                                                <input type="text" class="form-control" name="web" placeholder="input website" value="{{ $kontak->web }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 pt-2">Line</label>
                                                <input type="text" class="form-control" name="line" placeholder="input account line" value="{{ $kontak->line }}">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-sm float-end"><i class="bi bi-save"></i> SIMPAN PERUBAHAN</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-mazer-layout>
