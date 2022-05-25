<x-mazer-layout title="CHATOMZ - Peta Orang">
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
            <x-header head="Data Peta Orang" p="Daftar list orang - orang" active="Peta"></x-header>
            <section class="section">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <x-sistem.kembali url="orang"></x-sistem.kembali>
                      </div>
                      <div class="card-body">
                        <div id="map"></div>
                      </div>
                    </div>
                  </div>
                </div>
            </section>
        </div>
    </x-slot>

    <x-slot name="kodejs">
        
<script>
	// TO MAKE THE MAP APPEAR YOU MUST
	// ADD YOUR ACCESS TOKEN FROM
	// https://account.mapbox.com
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
        const width = marker.properties.iconSize[0];
        const height = marker.properties.iconSize[1];
        const poto = marker.properties.poto;
        el.className = 'marker';
        el.style.backgroundImage = `url(${poto})`;
        el.style.width = `${width}px`;
        el.style.height = `${height}px`;
        el.style.backgroundSize = '100%';

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
