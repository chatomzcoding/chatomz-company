<x-mazer-layout title="API UNSIL">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Mahasiswa - {{ $result['Nama']}}" active="Get Data"></x-header>
            <div class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{  $result['FotoUrl']}}" alt="" class="img-fluid" width="100%">
                                </div>
                                <div class="col-md-8">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <form action="{{ url('unsil') }}" method="get">
                                                    <tr>
                                                        <td colspan="4">
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    <input type="number" name="npm" value="{{ $result['MhswID']}}" class="form-control" autofocus>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="submit" class="btn btn-primary">CARI</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </form>
                                                <form action="{{ url('simpanmahasiswa') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="poto" value="{{ $result['FotoUrl']}}">
                                                    <input type="hidden" name="nama" value="{{ $result['Nama']}}">
                                                <tr>
                                                    <td colspan="4"><input type="text" name="home_address" class="form-control" value="{{ $result['Alamat']}}"> </td>
                                                </tr>
                                                @php
                                                    $gender = ($result['Kelamin'] == 1) ? 'laki-laki' : 'perempuan';
                                                @endphp
                                                <tr>
                                                    <td><input type="date" name="date_birth" class="form-control" value="{{ $result['TanggalLahir']}}"></td>
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
                                                            @foreach (kingdom_agama() as $item)
                                                                <option value="{{ $item }}">{{ strtoupper($item) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td colspan="3">
                                                        <select name="marital_status" id="" class="form-control">
                                                            <option value="belum" >Belum Kawin</option>
                                                            <option value="sudah">Sudah Kawin</option>
                                                            <option value="pernah">Pernah Kawin</option>
                                                        </select>
                                                        <input type="hidden" name="note" class="form-control" value="{{ $result['Handphone']}}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"><button type="submit" class="btn btn-primary float-end">SIMPAN</button></td>
                                                </tr>
                                                </form>
                                                @php
                                                    $nama  = explode(' ',$result['Nama']);
                                                    $orang = DbChatomz::showtable('orang',['first_name',$nama[0]]);
                                                @endphp
                                                @forelse ($orang as $item)
                                                <tr>
                                                    <th>
                                                        <img src="{{ asset('img/chatomz/orang/'.orang_photo($item->photo)) }}" alt="" width="70px">
                                                    </th>
                                                    <td class="small"><a href="{{ url('orang/'.Crypt::encryptString($item->id).'/edit') }}" target="_blank">{{ fullname($item) }}</a><span class="float-end">{{ $item->date_birth }}</span> <br> {{ $item->home_address }} <br> </td>
                                                </tr>
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

</x-mazer-layout>
