<x-singel-layout url="orang">
    <x-slot name="title">
        Chatomz - Tambah Orang
    </x-slot>
    <x-slot name="content">
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title"><i class="bi bi-plus-circle-fill"></i> Tambah Orang</h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{ url('/orang')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                      <div class="col-md-6 p-4">
                          <div class="row mb-2">
                                <label for="inlineinput" class="col-md-4 col-form-label">Nama Awal {!! ireq() !!}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name')}}" id="inlineinput" required>
                                </div>
                          </div>
                          <div class="row mb-2">
                              <label for="inlineinput" class="col-md-4 col-form-label">Nama Akhir</label>
                              <div class="col-md-8">
                                  <input type="text" class="form-control" name="last_name" value="{{ old('last_name')}}" id="inlineinput">
                              </div>
                          </div>
                          <div class="row mb-2">
                              <label for="inlineinput" class="col-md-4 col-form-label">Nama Panggilan</label>
                              <div class="col-md-8">
                                  <input type="text" class="form-control" name="nick_name" value="{{ old('nick_name')}}" id="inlineinput">
                            </div>
                          </div>
                          <div class="row mb-2">
                              <label for="inlineinput" class="col-md-4 col-form-label">Alamat Rumah</label>
                              <div class="col-md-8">
                                  <textarea name="home_address" id="" cols="3 0" row mb-2s="3" class="form-control">{{ old('home_address')}}</textarea>
                            </div>
                          </div>
                          <div class="row mb-2">
                              <label for="inlineinput" class="col-md-4 col-form-label">Alamat Sekarang</label>
                              <div class="col-md-8">
                                  <textarea name="current_address" id="" cols="30" row mb-2s="3" class="form-control">{{ old('current_address')}}</textarea>
                            </div>
                          </div>
                          <div class="row mb-2">
                              <label for="inlineinput" class="col-md-4 col-form-label">Tempat Lahir</label>
                              <div class="col-md-8">
                                  <input type="text" name="place_birth" class="form-control" id="inlineinput"  value="{{ old('place_birth')}}">
                            </div>
                          </div>
                          <div class="row mb-2">
                              <label for="inlineinput" class="col-md-4 col-form-label">Tanggal Lahir</label>
                              <div class="col-md-8">
                                  <input type="date" name="date_birth" class="form-control" id="inlineinput" value="{{ old('date_birth')}}">
                            </div>
                          </div>
                          <div class="row mb-2">
                              <label for="inlineinput" class="col-md-4 col-form-label">Pekerjaan</label>
                              <div class="col-md-8">
                                  <input type="text" name="job_status" class="form-control"  value="{{ old('job_status')}}">
                            </div>
                          </div>
                      </div>
                      <div class="col-md-6 p-4">
                          <div class="row mb-2">
                              <label for="inlineinput" class="col-md-4 col-form-label">Jenis Kelamin</label>
                              <div class="col-md-8">
                                  <select name="gender" id="" class="form-control">
                                      <option value="laki-laki">Laki - laki</option>
                                      <option value="perempuan">Perempuan</option>
                                      <option value="lainnya">Lainnya</option>
                                  </select>
                            </div>
                          </div>
                          <div class="row mb-2">
                              <label for="inlineinput" class="col-md-4 col-form-label">Kebangsaan</label>
                              <div class="col-md-8">
                                  <select name="nasionality" id="" class="form-control">
                                      @foreach (countryname() as $item)
                                      <option value="{{ $item }}" >{{ $item }}</option>
                                      @endforeach
                                  </select>
                            </div>
                          </div>
                          <div class="row mb-2">
                              <label for="inlineinput" class="col-md-4 col-form-label">Agama</label>
                              <div class="col-md-8">
                                  <select name="religion" id="" class="form-control">
                                      @foreach (kingdom_agama() as $item)
                                      <option value="{{ $item }}">{{ strtoupper($item) }}</option>
                                      @endforeach
                                  </select>
                            </div>
                          </div>
                          <div class="row mb-2">
                              <label for="inlineinput" class="col-md-4 col-form-label">Golongan Darah</label>
                              <div class="col-md-8">
                                  <select name="blood_type" id="" class="form-control">
                                      @foreach (kingdom_goldar() as $item)
                                        <option value="{{ $item }}">{{ strtoupper($item) }}</option>
                                      @endforeach
                                  </select>
                            </div>
                          </div>
                          <div class="row mb-2">
                              <label for="inlineinput" class="col-md-4 col-form-label">Status Perkawinan</label>
                              <div class="col-md-8">
                                  <select name="marital_status" id="" class="form-control">
                                      <option value="belum" >Belum Kawin</option>
                                      <option value="sudah">Sudah Kawin</option>
                                      <option value="pernah">Pernah Kawin</option>
                                  </select>
                            </div>
                          </div>
                          <div class="row mb-2">
                              <label for="inlineinput" class="col-md-4 col-form-label">Status Grup</label>
                              <div class="col-md-8">
                                  <select name="status_group" id="" class="form-control">
                                      <option value="available" >Tersedia</option>
                                      <option value="full" >Ditutup</option>
                                  </select>
                            </div>
                          </div>
                          <div class="row mb-2">
                              <label for="inlineinput" class="col-md-4 col-form-label">Status Kematian</label>
                              <div class="col-md-8">
                                  <select name="death" id="" class="form-control">
                                      <option value="">Masih Hidup</option>
                                      <option value="alm" >Meninggal</option>
                                  </select>
                            </div>
                          </div>
                          <div class="row mb-2">
                              <label for="inlineinput" class="col-md-4 col-form-label">Catatan</label>
                              <div class="col-md-8">
                                  <input type="text" name="note" class="form-control" id="inlineinput" value="{{ old('note')}}">
                            </div>
                          </div>
                          <div class="row mb-2">
                              <label for="inlineinput" class="col-md-4 col-form-label">Photo</label>
                                <div class="col-md-8">
                                    <input type="file" name="photo">
                                </div>
                          </div>
                          <div class="float-end">
                              <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-save"></i> SIMPAN</button>
                          </div>
                      </div>
                  </div>
              </form>
            </div>
          </div>
    </x-slot>
</x-singel-layout>