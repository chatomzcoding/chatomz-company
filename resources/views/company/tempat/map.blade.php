<x-mazer-layout title="TEMPAT" alert="TRUE" select="TRUE">
    <x-slot name="head">
        <link href="https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.css" rel="stylesheet">
        <script src="https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.js"></script>

        <style>
            #map { width: 100%; height: 600px;}
            .marker {
                display: block;
                border: none;
                border-radius: 50%;
                cursor: pointer;
                padding: 0;
            }
        </style>
    </x-slot>
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Informasi Tempat" active="Daftar Tempat"></x-header>
            <div class="content">
               
                <div class="row">
                    <div class="col-md-12">
                        <header class="bg-white mb-2 p-2 rounded">
                            <x-sistem.kembali url="tempat"></x-sistem.kembali>
                            <span class="float-end fst-italic small pt-1">Ditemukan {{ count($data) }} Tempat</span>
                        </header>
                        <div class="row">
                            <div class="col">
                                <form action="" method="get">
                                    <input type="hidden" name="s" value="map">
                                    <div class="form-group">
                                        <select name="kategori_id" id="" class="form-select select2bs4" onchange="this.form.submit()">
                                            <option value="semua" {{ Syselected('semua',$kategori_id) }}>SEMUA</option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}" {{ Syselected($item->id,$kategori_id) }}>{{ strtoupper($item->nama_kategori) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                       <div id="map"></div>
                    </div>
                  </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="kodejs">
               
<script>
	mapboxgl.accessToken = "{{ kingdom_tokenmap() }}";
 
    const geojson = {
        'type': 'FeatureCollection',
        'features': @json($data)
    };

    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: @json(kingdom_latlong()),
        zoom: 9
    });

    // Add markers to the map.
    for (const marker of geojson.features) {
        const el = document.createElement('div');
        const poto = marker.properties.poto;
        const nama = marker.properties.message;
        el.className = 'marker';
        el.innerHTML = "<section class='text-center'><img src='"+ poto + "' width='50px' height='50px'><br><strong>"+ nama +"</strong></section>";

        // el.addEventListener('click', () => {
        //     window.alert(marker.properties.message);
        // });
        const popup = new mapboxgl.Popup({ offset: 25 }).setHTML(marker.properties.description);

        // Add markers to the map.
        new mapboxgl.Marker(el)
            .setLngLat(marker.geometry.coordinates)
            .setPopup(popup) // sets a popup on this marker
            .addTo(map);
    }
</script>
    </x-slot>
</x-mazer-layout>