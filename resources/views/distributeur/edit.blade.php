{{-- \resources\views\permissions\create.blade.php --}}
@extends('layout')

@section('css')
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
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
                        <h1 class="m-0 text-info">GESTION DES departementS</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" role="button" class="btn btn-primary">ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('departement.index') }}" role="button" class="btn btn-primary">RETOUR</a></li>

                        </ol>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

        {!! Form::model($distributeur, ['method'=>'PATCH','route'=>['distributeur.update', $distributeur->id]]) !!}
            @csrf
             <div class="card border-danger border-0">
                        <div class="card-header bg-info text-center">FORMULAIRE DE MODIFICATION TABLE</div>
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
                                        <input type="text" name="nomcomplet"  value="{{ $distributeur->nomcomplet }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Contact </label>
                                        <input type="text" name="contact"  value="{{ $distributeur->contact }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Département</label>
                                    <select class="form-control" name="departement_id" required="">
                                        @foreach ($departements as $departement)
                                        <option {{old('departement_id', $distributeur->departement_id) == $departement->id ? 'selected' : ''}} value="{{$departement->id}}">{{$departement->nomd}}</option>
                                            @endforeach

                                    </select>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Stock </label>
                                        <input type="number" id="stock" name="stock"  value="{{ $distributeur->stock }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Commande </label>
                                        <input type="number" id="commande" name="commande"  value="{{ $distributeur->commande }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Latitude </label>
                                        <input type="text" id="latitude" name="latitude"  value="{{ $distributeur->latitude }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Longitutde </label>
                                        <input type="text" name="longitude"  value="{{ $distributeur->longitude }}" id="longitude" class="form-control"  required>
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                    <div id="map"></div>
                                </div>
                                <div>
                                    <center>
                                        <button type="submit" class="btn btn-success btn btn-lg "> MODIFIER</button>
                                    </center>
                                </div>


                            </div>
                        </div>
    {!! Form::close() !!}
                </div>
        </div>

    </div>

@endsection
@section('script')

<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script> <!-- Orginal: http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js -->
<script>
var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> Contributors'
});
//remember last position

$(document).ready(function () {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition);

        }

});
function showPosition(position) {
    document.getElementById('latitude').value = position.coords.latitude ;
    document.getElementById('longitude').value = position.coords.longitude;
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

</script>
@endsection
