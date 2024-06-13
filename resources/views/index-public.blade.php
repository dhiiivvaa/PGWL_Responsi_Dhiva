@extends('template')

    @section('styles')
    
    <style>
        html,
        body {
            height: 100%;
            width: 100%;
            margin : 0;
        }

        #map {
            height: calc(100vh - 56px);
            width: 100%;
            margin: 0;
        }
    </style>
    @endsection
</head>

    @section('content')
    <div id ="map"></div>
    @endsection


    @section('script')
    <script>
        //Map
        var map = L.map('map').setView([38.99001227850432, 21.804014525529816], 7);

        /* Tile Basemap */
        var basemap1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '<a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> | <a href="DIVSIGUGM" target="_blank">DIVSIG UGM</a>' //menambahkan nama//
        });
             basemap1.addTo(map);

        var baseMaps = {
            "OpenStreetMap": basemap1,
                  };

        var overlayMaps = {
            // Kec
        };


        L.control.layers(baseMaps, overlayMaps, {
            collapsed: false,
            position: 'topright'
        }).addTo(map);


/* GeoJSON Point */
var point = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var popupContent = "Nama Wisata: " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image + "'class='img-thumbnail' alt=''>" + "<br>" ;
                    // di antara petik ditambahkan feature.properties.image sbg peranan javascript

					layer.on({
						click: function (e) {
							point.bindPopup(popupContent);
						},
						mouseover: function (e) {
							point.bindTooltip(feature.properties.kab_kota);
						},
					});
				},
			});
			$.getJSON("{{ route('api.points') }}", function (data) {
				point.addData(data);
				map.addLayer(point);
			});
/* GeoJSON Polyline */
var polyline = L.geoJson(null, {
				onEachFeature: function (feature, layer) {
					var popupContent = "Nama Wisata: " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image + "'class='img-thumbnail' alt=''>" + "<br>" 
                    ;
                    // di antara petik ditambahkan feature.properties.image sbg peranan javascript
					layer.on({
						click: function (e) {
							polyline.bindPopup(popupContent);
						},
						mouseover: function (e) {
							polyline.bindTooltip(feature.properties.kab_kota);
						},
					});
				},
			});
			$.getJSON("{{ route('api.polylines') }}", function (data) {
				polyline.addData(data);
				map.addLayer(polyline);
			});
/* GeoJSON Polygon */
var polygon = L.geoJson(null, {
				onEachFeature: function (feature, layer) {
					var popupContent = "Nama Wisata: " + feature.properties.name + "<br>" +
                    "Jenis Objek: " + feature.properties.description + "<br>" +
                    "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image + "'class='img-thumbnail' alt=''>" + "<br>" 
                    ;
                    // di antara petik ditambahkan feature.properties.image sbg peranan javascript
					layer.on({
						click: function (e) {
							polygon.bindPopup(popupContent);
						},
						mouseover: function (e) {
							polygon.bindTooltip(feature.properties.kab_kota);
						},
					});
				},
			});
			$.getJSON("{{ route('api.polygons') }}", function (data) {
				polygon.addData(data);
				map.addLayer(polygon);
			});
            //layer control
        var overlayMaps = {
            "Point": point,
            "Polyline": polyline,
            "Polygon": polygon
        };

        var layerControl = L.control.layers(null, overlayMaps).addTo(map);
    </script>
    @endsection