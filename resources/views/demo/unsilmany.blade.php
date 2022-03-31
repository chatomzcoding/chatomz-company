<x-mazer-layout title="API UNSIL">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Mahasiswa" active="Get Data"></x-header>
            <div class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-body">
                            <form action="{{ url('unsil') }}" method="get">
                                <input type="hidden" name="s" value="many">
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <input type="number" name="npm" value="{{ $npm}}" class="form-control" autofocus>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" value="{{ $batas}}" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="angka" value="{{ $angka}}" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary btn-block">CARI</button>
                                    </div>
                                </div>
                            </form>
                            @foreach ($list as $item)
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{  $item['unsil']['FotoUrl']}}" alt="" class="img-fluid" width="100%">
                                </div>
                                <div class="col-md-8">
                                    <h3 class="p-2 pb-0">{{ $item['unsil']['Nama'].' - '.$item['unsil']['MhswID']}}</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <form action="{{ url('simpanmahasiswa') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="poto" value="{{ $item['unsil']['FotoUrl']}}">
                                                    <input type="hidden" name="nama" value="{{ $item['unsil']['Nama']}}">
                                                <tr>
                                                    <td colspan="4"><input type="text" name="home_address" class="form-control" value="{{ $item['unsil']['Alamat']}}"> </td>
                                                </tr>
                                                @php
                                                    $gender = ($item['unsil']['Kelamin'] == 1) ? 'laki-laki' : 'perempuan';
                                                @endphp
                                                <tr>
                                                    <td><input type="date" name="date_birth" class="form-control" value="{{ $item['unsil']['TanggalLahir']}}"></td>
                                                    <td colspan="3">
                                                        <select name="gender" id="" class="form-control">
                                                            <option value="laki-laki">Laki - laki</option>
                                                            <option value="perempuan">Perempuan</option>
                                                            <option value="lainnya">Lainnya</option>
                                                        </select>    
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <select name="religion" id="" class="form-control">
                                                            @foreach (kingdom_agama() as $key)
                                                                <option value="{{ $key }}">{{ strtoupper($key) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td colspan="3">
                                                        <select name="marital_status" id="" class="form-control">
                                                            <option value="belum" >Belum Kawin</option>
                                                            <option value="sudah">Sudah Kawin</option>
                                                            <option value="pernah">Pernah Kawin</option>
                                                        </select>
                                                        <input type="hidden" name="note" class="form-control" value="{{ $item['unsil']['Handphone']}}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"><button type="submit" class="btn btn-primary float-end">SIMPAN </button></td>
                                                </tr>
                                                </form>
                                                @forelse ($item['orang'] as $key)
                                                <tr>
                                                    <th>
                                                        <img src="{{ asset('img/chatomz/orang/'.orang_photo($key->photo)) }}" alt="" width="70px">
                                                    </th>
                                                    <td class="small"><a href="{{ url('orang/'.Crypt::encryptString($key->id).'/edit') }}" target="_blank">{{ fullname($key) }}</a><span class="float-end">{{ $key->date_birth }}</span> <br> {{ $key->home_address }} <br> </td>
                                                </tr>
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  
                            </div>
                            <hr>
                            @endforeach
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

</x-mazer-layout>
