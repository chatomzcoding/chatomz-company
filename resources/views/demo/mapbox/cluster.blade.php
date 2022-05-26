<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Create and style clusters</title>
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
	mapboxgl.accessToken = "{{ kingdom_tokenmap() }}";
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: @json(kingdom_latlong()),
        zoom: 12
    });

    const geojson = {
        'type': 'FeatureCollection',
        'features': @json($data)
    };

    map.on('load', () => {
        map.addSource('earthquakes', {
            type: 'geojson',
            data: @json($data),
            cluster: true,
            clusterMaxZoom: 17, // Max zoom to cluster points on
            clusterRadius: 50 // Radius of each cluster when clustering points (defaults to 50)
        });
        // Load an image from an external URL.
        map.loadImage(
            'https://i.ibb.co/yWJD0Hx/icon-map.png',
            (error, image) => {
            if (error) throw error;
            
            // Add the image to the map style.
            map.addImage('cat', image);
            // map.addImage('cat', features[0].properties.poto);


            map.addLayer({
                id: 'clusters',
                type: 'circle',
                source: 'earthquakes',
                filter: ['has', 'point_count'],
                paint: {
                    'circle-color': [
                        'step',
                        ['get', 'point_count'],
                        '#51bbd6',
                        100,
                        '#f1f075',
                        750,
                        '#f28cb1'
                    ],
                    'circle-radius': [
                        'step',
                        ['get', 'point_count'],
                        20,
                        100,
                        30,
                        750,
                        40
                    ]
                }
            });

            map.addLayer({
                id: 'cluster-count',
                type: 'symbol',
                source: 'earthquakes',
                filter: ['has', 'point_count'],
                layout: {
                    'text-field': '{point_count_abbreviated}',
                    'text-font': ['DIN Offc Pro Medium', 'Arial Unicode MS Bold'],
                    'text-size': 12
                }
            });

            map.addLayer({
                id: 'unclustered-point',
                type: 'symbol',
                source: 'earthquakes',
                filter: ['!', ['has', 'point_count']],
                // paint: {
                //     'circle-color': 'red',
                //     'circle-radius': 4,
                //     'circle-stroke-width': 1,
                //     'circle-stroke-color': '#fff'
                // },
                layout: {
                    'icon-image': 'cat', // reference the image
                    'icon-allow-overlap': true,
                    'icon-size': 0.08,
                    'text-field': ['get', 'message'],
                    'text-font': [
                        'Open Sans Semibold',
                        'Arial Unicode MS Bold'
                        ],
                    'text-offset': [0, 1.25],
                    'text-anchor': 'top'
                }
            });

            // inspect a cluster on click
            map.on('click', 'clusters', (e) => {
                const features = map.queryRenderedFeatures(e.point, {
                    layers: ['clusters']
                });
                const clusterId = features[0].properties.cluster_id;
                map.getSource('earthquakes').getClusterExpansionZoom(
                    clusterId,
                    (err, zoom) => {
                        if (err) return;

                        map.easeTo({
                            center: features[0].geometry.coordinates,
                            zoom: zoom
                        });
                    }
                );
            });

            map.on('click', 'unclustered-point', (e) => {
                const el = document.createElement('div');
                const coordinates = e.features[0].geometry.coordinates.slice();
                const mag = e.features[0].properties.description;
                const poto = e.features[0].properties.poto;
            
                // create the marker
                el.className = 'marker';
                el.style.backgroundImage = `url(${poto})`;
                // el.style.width = `${width}px`;
                // el.style.height = `${height}px`;
                el.style.backgroundSize = '100%';

                while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                    coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                    }

                new mapboxgl.Popup()
                    .setLngLat(coordinates)
                    .setHTML(
                        `${mag}`
                    )
                    .addTo(map);
            });

            map.on('mouseenter', 'clusters', () => {
                map.getCanvas().style.cursor = 'pointer';
            });
            map.on('mouseleave', 'clusters', () => {
                map.getCanvas().style.cursor = '';
            });
        }
        );
    });
</script>

</body>
</html>