@extends('template')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">
<style>
    html,
    body {
        height: 100%;
        width: 100%;
        margin: 0;
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
<div id="map"></div>
<div class="modal fade" id="PointModal" tabindex="-1" aria-labelledby="PointModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Point</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store-point') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Fill point name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Geometry</label>
                        <textarea class="form-control" id="geom_point" name="geom" rows="3" readonly></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image_point" name="image" onchange="document.getElementById
                            ('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="mb-3">
                        <img src="" alt="Preview" id="preview-image-point" class="img-thumbnail" width="400">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="PolylineModal" tabindex="-1" aria-labelledby="PolylineModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polyline</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store-polyline') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Fill polyline name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Geometry</label>
                        <textarea class="form-control" id="geom_polyline" name="geom" rows="3" readonly></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image_polyline" name="image" onchange="document.getElementById
                            ('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="mb3">
                        <img src="" alt="Preview" id="preview-image-polyline" class="img-thumbnail" width="400">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="PolygonModal" tabindex="-1" aria-labelledby="PolygonModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polygons</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store-polygon') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Fill polygon name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Geometry</label>
                        <textarea class="form-control" id="geom_polygon" name="geom" rows="3" readonly></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image_polygon" name="image" onchange="document.getElementById
                            ('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="mb-3">
                        <img src="" alt="Preview" id="preview-image-polygon" class="img-thumbnail" width="400">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
<script src="https://unpkg.com/terraformer@1.0.7/terraformer.js"></script>
<script src="https://unpkg.com/terraformer-wkt-parser@1.1.2/terraformer-wkt-parser.js"></script>
<script>
    //Map
    var map = L.map('map').setView([38.99001227850432, 21.804014525529816], 6);

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

    /* Digitize Function */
    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    var drawControl = new L.Control.Draw({
        draw: {
            position: 'topleft',
            polyline: true,
            polygon: true,
            rectangle: true,
            circle: false,
            marker: true,
            circlemarker: false
        },
        edit: false
    });

    map.addControl(drawControl);

    map.on('draw:created', function(e) {
        var type = e.layerType,
            layer = e.layer;

        console.log(type);

        var drawnJSONObject = layer.toGeoJSON();
        var objectGeometry = Terraformer.WKT.convert(drawnJSONObject.geometry);

        console.log(drawnJSONObject);
        console.log(objectGeometry);

        if (type === 'polyline') {
            $("#geom_polyline").val(objectGeometry);
            // $("#PointModal").modal('show');
            $("#PolylineModal").modal('show');

        } else if (type === 'polygon' || type === 'rectangle') {
            $("#geom_polygon").val(objectGeometry);
            $("#PolygonModal").modal('show');

        } else if (type === 'marker') {
            $("#geom_point").val(objectGeometry);
            $("#PointModal").modal('show');
            // $("#PointModal").modal('show');
        } else {
            console.log('undefined');
        }

        drawnItems.addLayer(layer);
    });
    /* GeoJSON Point */
    var point = L.geoJson(null, {
        onEachFeature: function(feature, layer) {
            var popupContent = "Nama Wisata: " + feature.properties.name + "<br>" +
                "Deskripsi: " + feature.properties.description + "<br>" +
                "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image + "'class='img-thumbnail' alt=''>" + "<br>" +

                "<div class='d-flex flex-row mt-3'>" +

                "<a href='{{ url('edit-point') }}/" + feature.properties.id + "' class='btn btn-sm btn-warning me-2'><i class='fa-solid fa-edit'></i></a>" +

                "<form action='{{ url('delete-point') }}/" + feature.properties.id + "'method='POST'>" +
                '{{ csrf_field() }}' +
                '{{ method_field('DELETE ') }}' +

                "<button type='submit' class='btn btn-danger' onclick='return confirm(`Yakin nih pointnya dihapus?`)'><i class='fa-solid fa-trash-can'></i></button>" +

                "</form>" +

                "</div>"

            ;
            // di antara petik ditambahkan feature.properties.image sbg peranan javascript

            layer.on({
                click: function(e) {
                    point.bindPopup(popupContent);
                },
                mouseover: function(e) {
                    point.bindTooltip(feature.properties.kab_kota);
                },
            });
        },
    });
    $.getJSON("{{ route('api.points') }}", function(data) {
        point.addData(data);
        map.addLayer(point);
    });
    /* GeoJSON Polyline */
    var polyline = L.geoJson(null, {
        onEachFeature: function(feature, layer) {
            var popupContent = "Nama Wisata: " + feature.properties.name + "<br>" +
                "Deskripsi: " + feature.properties.description + "<br>" +
                "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image + "'class='img-thumbnail' alt=''>" + "<br>" +

                "<div class='d-flex flex-row'>" +

                "<a href='{{ url('edit-polyline') }}/" + feature.properties.id + "' class='btn btn-warning me-2'><i class='fa-solid fa-edit'></i></a>" +

                "<form action='{{ url('delete-polyline') }}/" + feature.properties.id + "'method='POST'>" +
                '{{ csrf_field() }}' +
                '{{ method_field('DELETE ') }}' +

                "<button type='submit' class='btn btn-danger' onclick='return confirm(`Yakin nih garisnya dihapus?`)'><i class='fa-solid fa-trash-can'></i></button>" +

                "</form>" +

                "</div>";
            // di antara petik ditambahkan feature.properties.image sbg peranan javascript
            layer.on({
                click: function(e) {
                    polyline.bindPopup(popupContent);
                },
                mouseover: function(e) {
                    polyline.bindTooltip(feature.properties.kab_kota);
                },
            });
        },
    });
    $.getJSON("{{ route('api.polylines') }}", function(data) {
        polyline.addData(data);
        map.addLayer(polyline);
    });
    /* GeoJSON Polygon */
    var polygon = L.geoJson(null, {
        onEachFeature: function(feature, layer) {
            var popupContent = "Nama Wisata: " + feature.properties.name + "<br>" +
                "Jenis Objek: " + feature.properties.description + "<br>" +
                "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image + "'class='img-thumbnail' alt=''>" + "<br>" +

                "<div class='d-flex flex-row'>" +

                "<a href='{{ url('edit-polygon') }}/" + feature.properties.id + "' class='btn btn-sm btn-warning me-2'><i class='fa-solid fa-edit'></i></a>" +

                "<form action='{{ url('delete-polygon') }}/" + feature.properties.id + "'method='POST'>" +
                '{{ csrf_field() }}' +
                '{{ method_field('DELETE ') }}' +

                "<button type='submit' class='btn btn-danger' onclick='return confirm(`Yakin nih areanya dihapus?`)'><i class='fa-solid fa-trash-can'></i></button>" +

                "</form>" +

                "</div>";
            // di antara petik ditambahkan feature.properties.image sbg peranan javascript
            layer.on({
                click: function(e) {
                    polygon.bindPopup(popupContent);
                },
                mouseover: function(e) {
                    polygon.bindTooltip(feature.properties.kab_kota);
                },
            });
        },
    });
    $.getJSON("{{ route('api.polygons') }}", function(data) {
        polygon.addData(data);
        map.addLayer(polygon);
    });
    //layer control


    // GeoJSON Geoserver ADMINISTRASI KABUPATEN
    var adminLayer = L.geoJson(null, {
        style: function(feature) {
            var value = feature.properties.NAME_2;
        },
        onEachFeature: function(feature, layer) {
            var content = "NAME_2: " + feature.properties.id + "<br>";
            layer.on({
                click: function(e) {
                    layer.bindPopup(content).openPopup();
                },
                mouseover: function(e) {
                    layer.bindTooltip(feature.properties.id).openTooltip();
                },
                mouseout: function(e) {
                    layer.closePopup();
                    layer.closeTooltip();
                }
            });
        }
    });

    // Memuat data geojson
    fetch('{{ asset("storage/geojson/admin.geojson") }}')
        .then(response => response.json())
        .then(data => {
            adminLayer.addData(data);
            adminLayer.addTo(map);
        })
        .catch(error => console.log('Error GeoJSON:', error));

    // layer kontrol
    var overlayMaps = {
        "Point": point,
        "Polyline": polyline,
        "Polygon": polygon,
        "Provinsi": adminLayer,
    };
    var layerControl = L.control.layers(null, overlayMaps).addTo(map)
</script>
@endsection