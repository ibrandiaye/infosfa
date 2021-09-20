{{-- \resources\views\permissions\create.blade.php --}}
@extends('layout')

@section('css')
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.1/dist/esri-leaflet-geocoder.css"
  integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
  crossorigin="">
<style>
    html, body, #container, #map {
    padding: 0;
    margin: 0;
    }
    html, body, #map, #container {
    height: 440px;
    }
    </style>
@endsection

@section('content')

    <div class="content-wrapper">

        <div class="container">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-info">GESTION DES Distributeurs</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" role="button" class="btn btn-primary">ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('distributeur.index') }}" role="button" class="btn btn-primary">LISTE D'ENREGISTREMENT DES distributeur</a></li>

                        </ol>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
        <form action="{{ route('distributeur.store') }}" method="POST">
            @csrf
             <div class="card border-danger border-0">
                        <div class="card-header bg-info text-center">FORMULAIRE D'ENREGISTREMENT D'UN distributeur</div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row">
                                <div class="col-lg-6">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Nom </label>
                                        <input type="text" name="nomcomplet"  value="{{ old('nomcomplet') }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Contact </label>
                                        <input type="text" name="contact"  value="{{ old('contact') }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Nom Département</label>
                                    <select class="form-control" name="departement_id" required="">
                                        @foreach ($departements as $departement)
                                        <option value="{{$departement->id}}">{{$departement->nomd}}</option>
                                            @endforeach

                                    </select>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Stock </label>
                                        <input type="number" id="stock" name="stock"  value="{{ old('stock') }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Commande </label>
                                        <input type="number" id="commande" name="commande"  value="{{ old('commande') }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Latitude </label>
                                        <input type="text" id="latitude" name="latitude"  value="{{ old('latitude') }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Longitutde </label>
                                        <input type="text" name="longitude"  value="{{ old('longitude') }}" id="longitude" class="form-control"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div id="map"></div>
                            </div>

                                <div>
                                    <center>
                                        <button type="submit" class="btn btn-success btn btn-lg "> ENREGISTRER</button>
                                    </center>
                                </div>
                            </div>

                            </div>

            </form>
            </div>
        </div>



@endsection
@section('script')

<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
<!-- Load Esri Leaflet from CDN -->
<script src="https://unpkg.com/esri-leaflet@3.0.2/dist/esri-leaflet.js"
  integrity="sha512-myckXhaJsP7Q7MZva03Tfme/MSF5a6HC2xryjAM4FxPLHGqlh5VALCbywHnzs2uPoF/4G/QVXyYDDSkp5nPfig=="
  crossorigin=""></script>

<!-- Load Esri Leaflet Geocoder from CDN -->

<script src="https://unpkg.com/esri-leaflet-geocoder@3.1.1/dist/esri-leaflet-geocoder.js"
  integrity="sha512-enHceDibjfw6LYtgWU03hke20nVTm+X5CRi9ity06lGQNtC9GkBNl/6LoER6XzSudGiXy++avi1EbIg9Ip4L1w=="
  crossorigin=""></script>
<script>
var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> Contributors'
});
//remember last position
var map;
$(document).ready(function () {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition);

        }

});
function showPosition(position) {
    document.getElementById('latitude').value = position.coords.latitude ;
    document.getElementById('longitude').value = position.coords.longitude;
    marker.setLatLng([position.coords.latitude,position.coords.longitude]);
    map.panTo([position.coords.latitude,position.coords.longitude]);
    console.log(rememberLat);
  }

  var rememberLat = document.getElementById('latitude').value;
  var rememberLong = document.getElementById('longitude').value;
    if( !rememberLat || !rememberLong ) { rememberLat = 14.6900; rememberLong = -14.5273;}
    var map = new L.Map('map', {
    'center': [rememberLat, rememberLong],
    'zoom': 8,
    'layers': [tileLayer]
    });
    var marker = L.marker([rememberLat, rememberLong],{
    draggable: true
    }).addTo(map);
    marker.on('dragend', function (e) {
    updateLatLng(marker.getLatLng().lat, marker.getLatLng().lng);
    });
    map.on('click', function (e) {
    marker.setLatLng(e.latlng);
    updateLatLng(marker.getLatLng().lat, marker.getLatLng().lng);
    });

function updateLatLng(lat,lng,reverse) {

document.getElementById('latitude').value = marker.getLatLng().lat;
document.getElementById('longitude').value = marker.getLatLng().lng;
map.panTo([lat,lng]);

}


var searchControl = L.esri.Geocoding.geosearch({
    position: 'topright',
    placeholder: 'Enter an address or place e.g. 1 York St',
    useMapBounds: false,
    providers: [L.esri.Geocoding.arcgisOnlineProvider({
      apikey: 'AAPKdfd3d5a3ccd54600901d1a2a12de3678puADQZR0gGtxIW_LvJSZL_Wwpf12lAg0OeC4pSmGEnnd7D3zIJqpzdL-zuLp5Txy', // replace with your api key - https://developers.arcgis.com
      nearby: {
        lat: 14.6900,
        lng: -14.5273
      }
    })]
  }).addTo(map);

  var results = L.layerGroup().addTo(map);

  searchControl.on('results', function (data) {
    results.clearLayers();
    for (var i = data.results.length - 1; i >= 0; i--) {
      results.addLayer(L.marker(data.results[i].latlng));
    }
  });

</script>
@endsection



