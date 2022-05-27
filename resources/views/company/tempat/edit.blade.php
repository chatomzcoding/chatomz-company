<x-mazer-layout title="TEMPAT" alert="TRUE">
    <x-slot name="head">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <style>
            #map { 
                height:550px ;width:660px; }
            .geocoder {
                position:absolute;left: 350px; top:290px;
            }
        </style>
    </x-slot>
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Informasi Tempat" active="Perbaharui Tempat"></x-header>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <header class="bg-white mb-2 p-2 rounded">
                            <x-sistem.kembali url="tempat"></x-sistem.kembali>
                        </header>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <form method="post" action="{{ url('/tempat/'.$tempat->id)}}" enctype="multipart/form-data">
                                  @csrf
                                  @method('patch')
                                  <div class="form-group">
                                      <label for="">Kategori</label>
                                      <select name="kategori_id" id="" class="form-control">
                                            @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}" @if ($tempat->kategori_id == $item->id)
                                                selected
                                            @endif>{{ $item->nama_kategori }}</option>
                                            @endforeach  
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label for="">Nama Tempat</label>
                                      <input type="text" name="nama" class="form-control" value="{{ $tempat->nama }}" placeholder="Nama Tempat" required>
                                  </div>
                                  <div class="form-group">
                                      <label for="">Alamat</label>
                                      <input type="text" name="alamat" class="form-control" value="{{ $tempat->alamat }}" placeholder="lokasi tempat">
                                  </div>
                                  <div class="form-group">
                                      <label for="">Kota/Kabupaten</label>
                                      <input type="text" name="kota" class="form-control" value="{{ $tempat->kota }}" placeholder="kota/kabupaten" required>
                                  </div>
                                  <div class="form-group">
                                      <label for="">keterangan</label>
                                      <input type="text" name="keterangan" value="{{ $tempat->keterangan }}" class="form-control" placeholder="keterangan">
                                  </div>
                                  <div class="form-group">
                                      <label for="">Gambar</label>
                                      <input type="file" name="gambar" class="form-control">
                                  </div>
                                  <div class="form-group">
                                      <label for="lat">lat</label>
                                      <input type="text" id="lat" name="nilai_lat" value="{{ $tempat->nilai_lat }}" class="form-control" placeholder="Your lat.." required>
                                  </div>
                                  <div class="form-group">
                                      <label for="lng">lng</label>
                                      <input type="text" id="lng" name="nilai_long" value="{{ $tempat->nilai_long }}" class="form-control" placeholder="Your lng.." required>
                                  </div>
                                  <div class="form-group">
                                    <button class="btn btn-success btn-sm" ><i class="bi-save"></i> SIMPAN PEMBAHARUAN</button>
                                  </div>
                              </form>
                            </div>
                            <div class="col-md-8">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="kodejs">
        <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>
        <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />
        <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
        <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
    
        <script>
            var user_location = @json($longlat);
            mapboxgl.accessToken = "{{ kingdom_tokenmap() }}";
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v9',
                center: user_location,
                zoom: 13
            });

            // Add the control to the map.
            map.addControl(
                new MapboxGeocoder({
                    accessToken: mapboxgl.accessToken,
                    mapboxgl: mapboxgl
                })
            );
            //  geocoder here
            // var geocoder = new MapboxGeocoder({
                // accessToken: mapboxgl.accessToken,
                // limit results to Australia
                //country: 'IN',
            // });
    
            var marker ;
    
            // After the map style has loaded on the page, add a source layer and default
            // styling for a single point.
            map.on('load', function() {
                addMarker(user_location,'load');
    
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
    
            // document.getElementById('geocoder').appendChild(geocoder.onAdd(map));
            
        </script>
    
    </x-slot>
</x-mazer-layout>