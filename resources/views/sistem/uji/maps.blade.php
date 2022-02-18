<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta</title>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css" type="text/css">
</head>
<body>
    <div id="peta" style="width: 100%;height: 100vh;"></div>

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiZmlybWFuY2hhdG9teiIsImEiOiJja3pvaWN3OHMzOGcyMnZvMHM2NHR4a2lkIn0.qJuyAarv7FiTYNTQRt64mQ';
        var map = new mapboxgl.Map({
        container: 'peta',//id elemen html
        style: 'mapbox://styles/mapbox/streets-v11',
        // style: 'mapbox://styles/mapbox/satellite-v9',
        center:[108.197371, -7.303617],//koordinat lokasi garis bujur dan lintang,longitude dan latitude
        zoom: 15 // starting zoom
        });
        new mapboxgl.Marker().setLngLat([108.197371, -7.303617])
            .addTo(map)
        new mapboxgl.Marker().setLngLat([108.157371, -7.373617])
            .addTo(map)
        var geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl,
            marker:false,
            placeholder: 'Masukan kata kunci...',
            zoom:20
        });
 
 
        map.addControl(
            geocoder
        );
        </script>
</body>
</html>