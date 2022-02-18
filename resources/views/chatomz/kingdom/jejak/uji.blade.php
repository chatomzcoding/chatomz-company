{{-- @section('title')
    CHATOMZ - Daftar Jejak
@endsection

@section('head')


@endsection --}}
{{-- <x-app-layout> --}}
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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
                <a href="{{ url('jejak/'.Crypt::encryptString($jejak->id).'?maps=TRUE') }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-map"></i> Tambah Maps2 </a>
                <a href="{{ url('jejak/kategori/'.$jejak->kategori) }}" class="btn btn-info btn-sm float-right">Kategori : {{ $jejak->kategori }}</a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <div class="row">
                      <div class="col-md-12">
                        <div class="container">
                            <form action="" id="signupForm" class="form-user">
                                <label for="lat">lat</label>
                                <input type="text" id="lat" name="lat" placeholder="Your lat..">
                                <label for="lng">lng</label>
                                <input type="text" id="lng" name="lng" placeholder="Your lng..">
                                <input type="submit" value="Submit" >
                            </form>
                        </div>
                    
                        <div class="geocoder">
                            <div id="geocoder" ></div>
                        </div>
                    
                        <div id="map"></div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>



    {{-- @section('script') --}}
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
    var saved_markers = {{ get_saved_locations() }};
    var user_location = [77.216721,28.644800];
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
            var url = 'locations_model.php';
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

    {{-- @endsection --}}

{{-- </x-app-layout> --}}
