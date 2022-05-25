<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Add a default marker to a web map</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
<link href="https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.js"></script>
<style>
body { margin: 0; padding: 0; }
#map { position: absolute; top: 0; bottom: 0; width: 100%; }
</style>
</head>
<body>
<div id="map"></div>

<script>
	// TO MAKE THE MAP APPEAR YOU MUST
	// ADD YOUR ACCESS TOKEN FROM
	// https://account.mapbox.com
	mapboxgl.accessToken = "{{ $token }}";
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [108.173121, -7.305376],
        zoom: 13
    });

    // Create a default Marker and add it to the map.
    const marker1 = new mapboxgl.Marker()
        .setLngLat([108.173121, -7.305376])
        .addTo(map);

    // Create a default Marker, colored black, rotated 45 degrees.
    const marker2 = new mapboxgl.Marker({ color: 'black', rotation: 45 })
        .setLngLat([108.197454, -7.303660])
        .addTo(map);

    map.addControl(new mapboxgl.FullscreenControl());
</script>

</body>
</html>