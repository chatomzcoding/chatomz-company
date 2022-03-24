<x-mazer-layout title="API UNSIL">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Mahasiswa" active="Get Data"></x-header>
            <div class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{  $result['FotoUrl']}}" alt="" class="img-fluid">
                                </div>
                                <div class="col-md-8">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody>
                                                <form action="{{ url('unsil') }}" method="get">
                                                    <tr>
                                                        <th>NPM</th>
                                                        <td>
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
                                                <tr>
                                                    <th>Nama</th>
                                                    <td><input type="text" name="nama" class="form-control" value="{{ $result['Nama']}}"> </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <th>Tanggal lahir</th>
                                                    <td><input type="date" name="date_birth" class="form-control" value="{{ $result['TanggalLahir']}}"></td>
                                                </tr>
                                                @php
                                                    $gender = ($result['Kelamin'] == 1) ? 'laki-laki' : 'perempuan';
                                                @endphp
                                                <tr>
                                                    <th>Kelamin</th>
                                                    <td><input type="text" name="gender" class="form-control" value="{{ $gender}}"> </td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td><input type="text" name="home_address" class="form-control" value="{{ $result['Alamat']}}"> </td>
                                                </tr>
                                                <tr>
                                                    <th>Agama</th>
                                                    <td><input type="text" name="religion" class="form-control" value="islam"></td>
                                                </tr>
                                                <tr>
                                                    <th>Status Perkawinan</th>
                                                    <td><input type="text" name="marital_status" class="form-control" value="belum"></td>
                                                </tr>
                                                <tr>
                                                    <th>Handphone</th>
                                                    <td><input type="text" name="no_hp" class="form-control" value="{{ $result['Handphone']}}"> </td>
                                                </tr>
                                                {{-- <tr>
                                                    <th>Status</th>
                                                    <td><input type="text" name="" class="form-control"> {{ $result['StatusMhswID']}}</td>
                                                </tr> --}}
                                                <tr>
                                                    <th></th>
                                                    <td><button type="submit" class="btn btn-primary float-end">SIMPAN</button></td>
                                                </tr>
                                                </form>
                                                @php
                                                    $nama  = explode(' ',$result['Nama']);
                                                    $orang = DbChatomz::showtable('orang',['first_name',$nama[0]]);
                                                @endphp
                                                @forelse ($orang as $item)
                                                <tr>
                                                    <th>Nama</th>
                                                    <td><a href="{{ url('orang/'.Crypt::encryptString($item->id).'/edit') }}" target="_blank">{{ fullname($item) }}</a> <br> {{ $item->home_address }} <br> {{ $item->date_birth }}</td>
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
