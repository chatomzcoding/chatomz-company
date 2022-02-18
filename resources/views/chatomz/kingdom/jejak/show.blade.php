@section('title')
    CHATOMZ - Daftar Jejak
@endsection

@section('head')
<style>
    /* Optional: Makes the sample page fill the window. */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
 /* Always set the map height explicitly to define the size of the div

 * element that contains the map. */
    #map {
        height: 100%;
    }
    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    .container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
        margin-left: 20%;
        width:50%
    }
    #map { position:absolute;left: 350px; top:350px; bottom:0px;height:550px ;width:660px; }
    .geocoder {
        position:absolute;left: 350px; top:290px;
    }
</style>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}

@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row">
            <div class="col-sm-6">
              <h1 class="m-0">Data Jejak </h1>
              <p class="font-italic text-capitalize mb-0">&nbsp;&nbsp; {{ $jejak->nama_jejak }}</p>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url('jejak')}}">Daftar Jejak</a></li>
                <li class="breadcrumb-item active">Detail</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
    </x-slot>

    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title">Daftar Unit</h3> --}}
                <a href="{{ url('jejak') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-angle-left"></i> Daftar Jejak </a>
                <a href="#" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#tambahpoto"><i class="fas fa-plus"></i> Tambah Photo lainnya </a>
                <a href="#" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#ubahdata"><i class="fas fa-pen"></i> Ubah Data </a>
                <a href="#" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#tambahmarker"><i class="fas fa-map"></i> Tambah Maps </a>
                <a href="{{ url('jejak/kategori/'.$jejak->kategori) }}" class="btn btn-info btn-sm float-right">Kategori : {{ $jejak->kategori }}</a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <div class="row">
                    <div class="col-md-6">
                        <section class="p-2 text-center">
                            <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                  <div class="carousel-item active" data-interval="10000">
                                    <a href="{{ asset('img/chatomz/jejak/'.$jejak->gambar_jejak) }}" target="_blank"><img src="{{ asset('img/chatomz/jejak/'.$jejak->gambar_jejak) }}" class="d-block w-100" alt="poto utama"></a>
                                    {{-- <div class="carousel-caption d-none d-md-block"> --}}
                                        {{-- <h5>First slide label</h5> --}}
                                        {{-- <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p> --}}
                                      {{-- </div> --}}
                                  </div>
                                  @foreach ($jejakpoto as $item)
                                    <div class="carousel-item" data-interval="2000">
                                        <a href="{{ asset('img/chatomz/jejak/'.$item->poto) }}" target="_blank"><img src="{{ asset('img/chatomz/jejak/'.$item->poto) }}" class="d-block w-100" alt="poto tambahan"></a>
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>{{ $item->ket_poto }}</h5>
                                            {{-- <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p> --}}
                                        </div>
                                    </div>
                                  @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                                </a>
                              </div>
                            {{-- <a href="{{ asset('img/chatomz/jejak/'.$jejak->gambar_jejak) }}" target="_blank"><img src="{{ asset('img/chatomz/jejak/'.$jejak->gambar_jejak) }}" alt="" width="100%" class="rounded"></a> --}}
                            <small class="text-capitalize">{{ $jejak->lokasi }}</small>
                        </section>
                    </div>
                    <div class="col-md-6">
                        <h4 class="text-capitalize">{{ $jejak->nama_jejak }}</h4><hr>
                        <div class="text-right">
                            <span>{{ date_indo($jejak->tanggal,'-') }}</span>
                        </div>
                        <p class="font-italic">"{{ $jejak->keterangan_jejak }}"</p>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <div class="card">
                            <div class="card-header">
                                <a href="#" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Orang yang terlibat</a>
                                <span class="btn btn-success btn-sm float-right">Total Orang {{ count($jejakorang) }}</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @forelse ($jejakorang as $item)
                                        <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch">
                                            <div class="card bg-light">
                                                <div class="card-header text-muted border-bottom-0 text-capitalize">
                                                {{ fullname($item)}}
                                                </div>
                                                <div class="card-body pt-0 pb-0">
                                                <div class="row">
                                                    <div class="col-7">
                                                    <h2 class="lead"><b>{{ $item->gender}}</b></h2>
                                                    </div>
                                                    <div class="col-5 text-center">
                                                        <a href="{{ url('/orang/'.Crypt::encryptString($item->orang_id))}}"><img src="{{ asset('/img/chatomz/orang/'.$item->photo)}}" alt="user-avatar" class="img-fluid img-circle"></a>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <span class="small">{{ $item->ket_orang }}</span>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="card-footer p-2">
                                                    <form id="data-{{ $item->id }}" action="{{url('/jejakorang',$item->id)}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                    <span class="text-muted text-sm text-justify"><i class="fas fa-calendar-alt"></i> {{ $item->created_at }} </span>
                                                    <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-outline-danger btn-sm float-right mx-1"><i class="fas fa-trash-alt"></i></button>
                                                    <button type="button" data-toggle="modal"  data-ket_orang="{{ $item->ket_orang }}" data-id="{{ $item->id }}" data-target="#ubah" title="" class="btn btn-outline-success btn-sm float-right" data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @empty
                                            <div class="col text-center">
                                                belum ada data orang yang terlibat
                                            </div>
                                        @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    {{-- modal --}}
    {{-- modal tambah --}}
    <div class="modal fade" id="tambahmarker">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            {{-- <form action="{{ url('/jejakorang')}}" method="post" class="form-user"> --}}
                {{-- @csrf --}}
                {{-- <input type="hidden" name="id" value="{{ $jejak->id }}"> --}}
            <div class="modal-header">
            <h4 class="modal-title">Tambah Marker</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <div class="container">
                    <form action="" id="signupForm" class="form-user">
                        @csrf
                        <input type="hidden" name="id" value="{{ $jejak->id }}">
                        <label for="lat">lat</label>
                        <input type="text" id="lat" name="lat" placeholder="Your lat..">
                        <label for="lng">lng</label>
                        <input type="text" id="lng" name="long" placeholder="Your lng..">
                        <input type="submit" value="Submit" >
                    </form>
                </div>
            
                <div class="geocoder">
                    <div id="geocoder" ></div>
                </div>
            
                <div id="map"></div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
            {{-- <button type="submit" class="btn btn-primary tombol-simpan"><i class="fas fa-save"></i> SIMPAN</button> --}}
            </div>
        </form>
        </div>
        </div>
    </div>
    <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url('/jejakorang')}}" method="post">
                @csrf
                <input type="hidden" name="jejak_id" value="{{ $jejak->id }}">
            <div class="modal-header">
            <h4 class="modal-title">Tambah Orang dalam poto</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                    <div class="form-group row">
                     <label for="" class="col-md-4">Nama </label>
                     {{-- <input type="text" id="buah" name="orang_id" class="form-control col-md-8" placeholder="Nama Orang" value="" autofocus> --}}
                    <div class="col-md-8 p-0">
                        <select class="form-control" data-height="100%" data-width="100%" name="orang_id" id="orang" required>
                            @foreach ($orang as $item)
                                <option value="{{ $item->id}}">{{ fullname($item)}}</option>
                            @endforeach
                        </select>
                    </div>
                     </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Catatan (opsional)</label>
                        <input type="text" name="ket_orang" id="ket_orang" class="form-control col-md-8">
                   </div>
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
    <!-- /.modal -->
    {{-- modal tambah --}}
    <div class="modal fade" id="tambahpoto">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url('/jejakpoto')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="jejak_id" value="{{ $jejak->id }}">
            <div class="modal-header">
            <h4 class="modal-title">Tambah Poto Tambahan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                   
                   <div class="form-group row">
                        <label for="" class="col-md-4">Upload Poto</label>
                        <input type="file" name="poto" id="poto" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan Photo (opsional)</label>
                        <input type="text" name="ket_poto" id="ket_poto" class="form-control col-md-8">
                   </div>
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
    <!-- /.modal -->

    
    {{-- modal edit --}}
    <div class="modal fade" id="ubahdata">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ route('jejak.update','test')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Jejak</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" value="{{ $jejak->id }}">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4">Nama Jejak</label>
                        <input type="text" name="nama_jejak" id="nama_jejak" class="form-control col-md-8"  value="{{ $jejak->nama_jejak }}" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Tanggal Jejak</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control col-md-8"  value="{{ $jejak->tanggal }}">
                   </div>
                   <div class="form-group row">
                    <label for="" class="col-md-4">Kategori</label>
                    <select name="kategori" class="form-control col-md-8" required>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->nama_kategori}}" @if ($item->nama_kategori == $jejak->kategori)
                                selected
                            @endif>{{ strtoupper($item->nama_kategori)}}</option>
                        @endforeach
                    </select>
                    </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control col-md-8"  value="{{ $jejak->lokasi }}" required>
                   </div>
                   <div class="form-group row">
                       <label for="" class="col-md-4">Keterangan</label>
                       <textarea name="keterangan_jejak" id="keterangan_jejak" cols="30" rows="4" class="form-control col-md-8" required>{{ $jejak->keterangan_jejak }}</textarea>
                    </div>
                    <div class="form-group row">
                         <label for="" class="col-md-4">Gambar</label>
                         <input type="file" name="gambar_jejak" class="form-control col-md-8">
                    </div>
                </section>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
            <button type="submit" class="btn btn-success"><i class="fas fa-pen"></i> SIMPAN PERUBAHAN</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    <!-- /.modal -->

    {{-- modal edit --}}
    <div class="modal fade" id="ubah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ route('jejak.update','test')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Keluarga</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" id="id">
                <section class="p-3">
                  
                </section>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
            <button type="submit" class="btn btn-success"><i class="fas fa-pen"></i> SIMPAN PERUBAHAN</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    <!-- /.modal -->

    @section('script')
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />

    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />



        <script type="text/javascript">
            $(document).ready(function() {
                $("#orang").select2();
            })
        </script>
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama_keluarga = button.data('nama_keluarga')
                var no_kk = button.data('no_kk')
                var tgl_pernikahan = button.data('tgl_pernikahan')
                var keterangan = button.data('keterangan')
                var status_keluarga = button.data('status_keluarga')
                var orang_id = button.data('orang_id')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama_keluarga').val(nama_keluarga);
                modal.find('.modal-body #no_kk').val(no_kk);
                modal.find('.modal-body #tgl_pernikahan').val(tgl_pernikahan);
                modal.find('.modal-body #keterangan').val(keterangan);
                modal.find('.modal-body #status_keluarga').val(status_keluarga);
                modal.find('.modal-body #orang_id').val(orang_id);
                modal.find('.modal-body #id').val(id);
            })
        </script>
        <script>
            $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            });
        </script>

<script type="text/javascript">
    var saved_markers = {{ json_encode($maps) }};
    var user_location =  @json($maps[0]);
    mapboxgl.accessToken = 'pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v9',
        center: user_location,
        zoom: 10
    });
    //  geocoder here
    var geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        // limit results to Australia
        //country: 'IN',
    });

    var marker ;

    // After the map style has loaded on the page, add a source layer and default
    // styling for a single point.
    map.on('load', function() {
        addMarker(user_location,'load');
        add_markers(saved_markers);

        // Listen for the `result` event from the MapboxGeocoder that is triggered when a user
        // makes a selection and add a symbol that matches the result.
        geocoder.on('result', function(ev) {
            alert("aaaaa");
            console.log(ev.result.center);

        });
    });
    map.on('click', function (e) {
        marker.remove();
        addMarker(e.lngLat,'click');
        //console.log(e.lngLat.lat);
        document.getElementById("lat").value = e.lngLat.lat;
        document.getElementById("lng").value = e.lngLat.lng;

    });

    function addMarker(ltlng,event) {

        if(event === 'click'){
            user_location = ltlng;
        }
        marker = new mapboxgl.Marker({draggable: true,color:"#d02922"})
            .setLngLat(user_location)
            .addTo(map)
            .on('dragend', onDragEnd);
    }
    function add_markers(coordinates) {

        var geojson = (saved_markers == coordinates ? saved_markers : '');

        console.log(geojson);
        // add markers to map
        geojson.forEach(function (marker) {
            console.log(marker);
            // make a marker for each feature and add to the map
            new mapboxgl.Marker()
                .setLngLat(marker)
                .addTo(map);
        });

    }

    function onDragEnd() {
        var lngLat = marker.getLngLat();
        document.getElementById("lat").value = lngLat.lat;
        document.getElementById("lng").value = lngLat.lng;
        console.log('lng: ' + lngLat.lng + '<br />lat: ' + lngLat.lat);
    }

    $('#signupForm').submit(function(event){
            event.preventDefault();
            var data = $('.form-user').serialize();
            var url = "{{ route('simpanmaps') }}";
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function(){
                    location.reload();
                }
            });
        });



    document.getElementById('geocoder').appendChild(geocoder.onAdd(map));

</script>

    @endsection

</x-app-layout>
