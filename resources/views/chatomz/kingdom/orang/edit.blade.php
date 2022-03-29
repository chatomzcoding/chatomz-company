<x-singel-layout back="orang" title="edit orang">
    <x-slot name="content">
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title">Edit - {{ fullname($orang) }}</h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{ url('/orang/'.$orang->id)}}" enctype="multipart/form-data">
                  @csrf
                  @method('patch')
                  <input type="hidden" name="id" value="{{ $orang->id }}">
                  <div class="row">
                      <div class="col-md-6 p-4">
                          <div class="form-group row">
                              <label for="inlineinput" class="col-md-4">Nama Awal</label>
                                  <input type="text" class="form-control col-md-8" name="first_name" id="inlineinput" value="{{ $orang->first_name}}" required>
                          </div>
                          <div class="form-group row">
                              <label for="inlineinput" class="col-md-4">Nama Akhir</label>
                                  <input type="text" class="form-control col-md-8" name="last_name" id="inlineinput" value="{{ $orang->last_name}}">
                          </div>
                          <div class="form-group row">
                              <label for="inlineinput" class="col-md-4">Nama Panggilan</label>
                                  <input type="text" class="form-control col-md-8" name="nick_name" id="inlineinput"  value="{{ $orang->nick_name}}">
                          </div>
                          <div class="form-group row">
                              <label for="inlineinput" class="col-md-4">Alamat Rumah</label>
                                  <textarea name="home_address" id="" cols="30" rows="3" class="form-control col-md-8">{{ $orang->home_address}}</textarea>
                          </div>
                          <div class="form-group row">
                              <label for="inlineinput" class="col-md-4">Alamat Sekarang</label>
                                  <textarea name="current_address" id="" cols="30" rows="3" class="form-control col-md-8">{{ $orang->current_address}}</textarea>
                          </div>
                          <div class="form-group row">
                              <label for="inlineinput" class="col-md-4">Tempat Lahir</label>
                                  <input type="text" name="place_birth" class="form-control col-md-8" id="inlineinput" value="{{ $orang->place_birth}}">
                          </div>
                          <div class="form-group row">
                              <label for="inlineinput" class="col-md-4">Tanggal Lahir</label>
                                  <input type="date" name="date_birth" class="form-control col-md-8" id="inlineinput" value="{{ $orang->date_birth}}">
                          </div>
                          <div class="form-group row">
                              <label for="inlineinput" class="col-md-4">Pekerjaan</label>
                                  <input type="text" name="job_status" class="form-control col-md-8" value="{{ $orang->job_status}}">
                          </div>
                      </div>
                      <div class="col-md-6 p-4">
                          <div class="form-group row">
                              <label for="inlineinput" class="col-md-4">Jenis Kelamin</label>
                                  <select name="gender" id="" class="form-control col-md-8">
                                      <option value="laki-laki" @if ($orang->gender == 'laki-laki')
                                          selected
                                      @endif>Laki - laki</option>
                                      <option value="perempuan" @if ($orang->gender == 'perempuan')
                                          selected
                                      @endif>Perempuan</option>
                                      <option value="lainnya" @if ($orang->gender == 'lainnya')
                                          selected
                                      @endif>Lainnya</option>
                                  </select>
                          </div>
                          <div class="form-group row">
                              <label for="inlineinput" class="col-md-4">Kebangsaan</label>
                                  <select name="nasionality" id="" class="form-control col-md-8">
                                      @foreach (countryname() as $item)
                                      <option value="{{ $item }}" @if ($orang->nasionality == $item)
                                          selected
                                      @endif>{{ $item }}</option>
                                      @endforeach
                                  </select>
                          </div>
                          <div class="form-group row">
                              <label for="inlineinput" class="col-md-4">Agama</label>
                                  <select name="religion" id="" class="form-control col-md-8">
                                      @foreach (kingdom_agama() as $item)
                                      <option value="{{ $item}}" @if ($item == $orang->religion)
                                          selected
                                      @endif>{{ $item}}</option>
                                      @endforeach
                                  </select>
                          </div>
                          <div class="form-group row">
                              <label for="inlineinput" class="col-md-4">Golongan Darah</label>
                                  <select name="blood_type" id="" class="form-control col-md-8">
                                      @foreach (kingdom_goldar() as $item)
                                      <option value="{{ $item}}" @if ($item == $orang->blood_type)
                                          selected
                                      @endif>{{ strtoupper($item)}}</option>
                                      @endforeach
                                  </select>
                          </div>
                          <div class="form-group row">
                              <label for="inlineinput" class="col-md-4">Status Perkawinan</label>
                                  <select name="marital_status" id="" class="form-control col-md-8">
                                      <option value="belum" @if ($orang->marital_status == 'belum')
                                          selected
                                      @endif >Belum Kawin</option>
                                      <option value="sudah" @if ($orang->marital_status == 'sudah')
                                          selected
                                      @endif>Sudah Kawin</option>
                                      <option value="pernah" @if ($orang->marital_status == 'pernah')
                                          selected
                                      @endif>Pernah Kawin</option>
                                  </select>
                          </div>
                          <div class="form-group row">
                              <label for="inlineinput" class="col-md-4">Grup Status</label>
                                  <select name="status_group" id="" class="form-control col-md-8">
                                      <option value="available" @if ($orang->status_group == 'available')
                                          selected
                                      @endif>Tersedia</option>
                                      <option value="full"  @if ($orang->status_group == 'full')
                                          selected
                                      @endif>Ditutup</option>
                                  </select>
                          </div>
                          <div class="form-group row">
                              <label for="inlineinput" class="col-md-4">Status Kematian</label>
                                  <select name="death" id="" class="form-control col-md-8">
                                      <option value="" @if ($orang->death == NULL)
                                          selected
                                      @endif>Masih Hidup</option>
                                      <option value="alm" @if ($orang->death == 'alm')
                                          selected
                                      @endif>Meninggal</option>
                                  </select>
                          </div>
                          <div class="form-group row">
                              <label for="inlineinput" class="col-md-4">Catatan</label>
                                  <input type="text" name="note" class="form-control col-md-8" id="inlineinput" value="{{ $orang->note}}">
                          </div>
                          <div class="form-group row">
                              <label for="inlineinput" class="col-md-4">Photo</label>
                              <div class="col-md-8">
                                  <input type="file" name="photo" class="form-control">
                                  <span class="text-danger">input jika ingin mengubah photo</span>
                              </div>
                          </div>
                          <div class="form-group float-right">
                              <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-pen"></i> SIMPAN PERUBAHAN</button>
                          </div>
                      </div>
                  </div>
              </form>
            </div>
        </div>
    </x-slot>
</x-singel-layout>