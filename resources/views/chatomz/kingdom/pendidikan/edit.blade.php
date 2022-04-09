<x-mazer-layout title="CHATOMZ - Edit Pendidikan">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Pendidikan" active="Edit Pendidikan">
                <li class="breadcrumb-item"><a href="{{ url('orang')}}">Daftar Orang</a></li>
                <li class="breadcrumb-item"><a href="{{ url('orang/'.Crypt::encryptString($orang->id))}}">{{ $orang->first_name.' '.$orang->last_name}}</a></li>
            </x-header>
            <div class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-header">
                            <a href="{{ url('/orang/'.Crypt::encryptString($orang->id))}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="fas fa-angle-left"></i> Kembali ke detail</a>
                            <a href="{{ url('/orang')}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="fas fa-angle-left"></i> Kembali ke daftar orang</a>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ url('/pendidikan/'.$pendidikan->id)}}">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">TK/TPA</label>
                                            <input type="text" class="form-control" name="tk" value="{{ $pendidikan->tk }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">SD</label>
                                            <input type="text" class="form-control" name="sd"  value="{{ $pendidikan->sd }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">SMP/MTS</label>
                                            <input type="text" class="form-control" name="smp"  value="{{ $pendidikan->smp }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">SMA/SMK/MA</label>
                                            <input type="text" class="form-control" name="sma"  value="{{ $pendidikan->sma }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenjang Diploma</label>
                                            <input type="text" class="form-control" name="d"  value="{{ $pendidikan->d }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenjang S1</label>
                                            <input type="text" class="form-control" name="s1"  value="{{ $pendidikan->s1 }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenjang S2</label>
                                            <input type="text" class="form-control" name="s2"  value="{{ $pendidikan->s2 }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenjang S3</label>
                                            <input type="text" class="form-control" name="s3" value="{{ $pendidikan->s3 }}" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Pesantren</label>
                                            <input type="text" class="form-control" name="pesantren"  value="{{ $pendidikan->pesantren }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Sekolah Dirumah</label>
                                            <input type="text" class="form-control" name="homescholl" value="{{ $pendidikan->homescholl }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Boarding Scholl</label>
                                            <input type="text" class="form-control" name="boardingscholl"  value="{{ $pendidikan->boardingscholl }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Bimbingan Belajar</label>
                                            <input type="text" class="form-control" name="bimbel"  value="{{ $pendidikan->bimbel }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kursus</label>
                                            <input type="text" class="form-control" name="kursus"  value="{{ $pendidikan->kursus }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Informasi Singkat</label>
                                            <textarea name="information" id="" cols="30" rows="4" class="form-control"> {{ $pendidikan->information }}</textarea>
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
