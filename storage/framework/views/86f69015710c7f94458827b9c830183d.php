<!DOCTYPE html>
<html>
<head>
<title>Nuevo Reporte</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<style>
#map { height:300px; border-radius:15px; }
</style>

</head>

<body class="bg-light">

<div class="container mt-3">

<h5>Nuevo Reporte</h5>

<form method="POST" action="/reporte/guardar" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<select class="form-control mb-2" name="categoria">
<option value="areas_verdes">Áreas verdes</option>
<option value="calles">Calles</option>
<option value="fugas">Fugas</option>
<option value="alumbrado">Alumbrado</option>
</select>

<textarea class="form-control mb-2" name="descripcion"></textarea>

<input class="form-control mb-2" type="file" name="imagen">

<input class="form-control mb-2" type="text" id="buscar" placeholder="Buscar dirección">

<button type="button" class="btn btn-dark w-100 mb-2" onclick="buscarDireccion()">
Buscar ubicación
</button>

<button type="button" class="btn btn-success w-100 mb-2" onclick="miUbicacion()">
📍 Usar mi ubicación
</button>
<div id="map"></div>

<input type="hidden" id="latitud" name="latitud">
<input type="hidden" id="longitud" name="longitud">
<input type="hidden" id="direccion" name="direccion">

<br>

<button class="btn btn-success w-100">Guardar</button>
<a href="/dashboard" class="btn btn-secondary w-100 mt-2">Volver</a>

</form>

</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
var map = L.map('map').setView([19.4326,-99.1332],13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

var marker;

map.on('click',function(e){
let lat=e.latlng.lat;
let lng=e.latlng.lng;

document.getElementById('latitud').value=lat;
document.getElementById('longitud').value=lng;

if(marker) map.removeLayer(marker);

marker=L.marker([lat,lng]).addTo(map);

fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
.then(r=>r.json())
.then(data=>{
document.getElementById('direccion').value=data.display_name;
});
});

function buscarDireccion() {
    let query = document.getElementById('buscar').value;

    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${query}`)
    .then(res => res.json())
    .then(data => {
        if(data.length > 0){
            let lat = data[0].lat;
            let lon = data[0].lon;

            map.setView([lat, lon], 15);

            if(marker) map.removeLayer(marker);
            marker = L.marker([lat, lon]).addTo(map);

            document.getElementById('latitud').value = lat;
            document.getElementById('longitud').value = lon;
            document.getElementById('direccion').value = data[0].display_name;
        }
    });
}

function miUbicacion() {
    navigator.geolocation.getCurrentPosition(function(position) {

        let lat = position.coords.latitude;
        let lng = position.coords.longitude;

        map.setView([lat, lng], 15);

        if(marker) map.removeLayer(marker);
        marker = L.marker([lat, lng]).addTo(map);

        document.getElementById('latitud').value = lat;
        document.getElementById('longitud').value = lng;

        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('direccion').value = data.display_name;
        });

    });
}
</script>

</body>
</html><?php /**PATH C:\Users\52722\homeLY\resources\views/crear_reporte.blade.php ENDPATH**/ ?>