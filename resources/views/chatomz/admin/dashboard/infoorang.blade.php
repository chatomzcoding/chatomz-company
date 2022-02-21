<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Ulang Tahun Bulan {{ bulan_indo() }}</h3>
              <div class="card-tools">
                <span class="badge badge-danger">{{ count($info['ulangtahunbulanini']) }} Orang</span>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="row p-2">
                    @foreach ($info['ulangtahunbulanini'] as $item)
                        <div class="col-lg-1 col-md-2 col-sm-3 p-1">
                            <a href="{{ url('/orang/'.Crypt::encryptString($item->id)) }}" title="{{fullname($item).' - '.date_indo($item->date_birth)}}"><img src="{{asset('/img/chatomz/orang/'.orang_photo($item->photo)) }}" alt="User Image" class="img-fluid rounded-circle"></a>
                            {{-- <small class="users-list-name">{!! fullname($item).gender($item->gender) !!}</small> --}}
                        </div>
                    @endforeach
                </div>
            </div>
          </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Ulang Tahun {{ ambil_tgl().' '.bulan_indo() }}</h3>
              <div class="card-tools">
                <span class="badge badge-danger">{{ count($info['ulangtahuntanggalini']) }} Orang</span>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="row p-2">
                    @foreach ($info['ulangtahuntanggalini'] as $item)
                        <div class="col-md-2 p-1">
                            <a href="{{ url('/orang/'.Crypt::encryptString($item->id)) }}" title="{{fullname($item)}}"><img src="{{asset('/img/chatomz/orang/'.orang_photo($item->photo)) }}" alt="User Image" class="img-fluid rounded-circle"></a>
                            {{-- <small class="users-list-name">{!! fullname($item).gender($item->gender) !!}</small> --}}
                        </div>
                    @endforeach
                </div>
            </div>
          </div>
    </div>
</div>