@extends('layout')
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>



@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">ACCUEIL</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                        <li class="breadcrumb-item active">BIENVENUE</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
          {{--  <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>IM</h3>

                            <p>Gestion des clients</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">Consulter <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>IM<sup style="font-size: 20px">%</sup></h3>

                            <p>Calendrier de reservation</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-calendar"></i>
                        </div>
                        <a href="#" class="small-box-footer">Consulter <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>IM</h3>

                            <p>Stock</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">Consulter <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>IM</h3>
                            <p>Restaurant</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">Consulter <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>--}}
            <div class="row">

                @for($i=0 ;  $i< count($stockByRegion); $i++)
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="ion ion-stats-bars"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ $stockByRegion[$i]->nom }}</span>
                            <span class="info-box-number" id="reclamationDuJour">Stock {{ $stockByRegion[$i]->stock }}  Commande {{ $commandeByRegion[$i]->commande }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                @endfor
        </div>

                <div class="row">
                <div class="col-md-12 col-sm-12 col-12">

                            <div id="address-map" style="height: 700px"></div>

                </div>
               {{--  <div class="col-md-3 col-sm-3 col-3">
                    <duv class="card">
                        <div class="card-header">
                            <h4>Situation</h4>
                        </div>
                        <div class="card-body">

                        </div>
                    </duv>

                </div> --}}
                <div class="col-12">
                    <div class="card border-danger border-0">
                        <div class="card-header bg-info text-center">LISTE D'ENREGISTREMENT DES distributeurs</div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-responsive-md table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nom </th>
                                            <th>contact</th>
                                            <th>Departement</th>
                                            <th>Région</th>
                                            <th>Stock</th>
                                            <th>Commande</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($distributeurs as $distributeur)
                                        <tr>
                                            <td>{{ $distributeur->id }}</td>
                                            <td>{{ $distributeur->nomcomplet }}</td>
                                            <td>{{ $distributeur->contact }}</td>
                                            <td>{{ $distributeur->departement->nomd }}</td>
                                            <td>{{ $distributeur->departement->region->nom }}</td>
                                            <td>{{ $distributeur->stock }}</td>
                                            <td>{{ $distributeur->commande }}</td>
                                            <td>
                                                <a href="{{ route('distributeur.edit', $distributeur->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route'=>['distributeur.destroy', $distributeur->id], 'style'=> 'display:inline', 'onclick'=>"if(!confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')) { return false; }"]) !!}
                                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                {!! Form::close() !!}



                                            </td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>



                            </div>

                        </div>
                    </div>

            </div>
            <!-- /.row -->

            <!-- =========================================================== -->

            </div>
    </section>
        </div>
        <input type="hidden" value="15.3893489" id="latitude">
        <input type="hidden" value="-14.7824247" id="longitude">
@endsection
@section('script')
<script>

    var map = L.map('address-map').setView([parseFloat(document.getElementById('latitude').value),parseFloat(document.getElementById('longitude').value)],8);
    L.tileLayer('https://api.maptiler.com/maps/streets/256/{z}/{x}/{y}.png?key=r7UvRXibthwur7YWRkfQ',{
        attribution : '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
    }).addTo(map);
    var greenIcon = L.icon({
        iconUrl: '{{ asset('assets/dist/img/danger.png') }}',


       iconSize:     [28, 30], // size of the icon
       {{--  shadowSize:   [50, 64], // size of the shadow
        iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
        shadowAnchor: [4, 62],  // the same for the shadow
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor --}}
    });
    @foreach ($distributeurs as $distributeur )
    @if($distributeur->stock > 0)
    var marker = L.marker([parseFloat({{ $distributeur->latitude }}),parseFloat({{ $distributeur->longitude }} )]).addTo(map);
    marker.bindPopup('<p> Nom : {{ $distributeur->nomcomplet }}</p>'+
'<p>Stock :{{ $distributeur->stock }}</p>' +
'<p>Commande : {{ $distributeur->commande }}</p>' +
'<p>Dernière MAJ : {{ Carbon\Carbon::parse($distributeur->updated_at)->format('d-m-Y')  }}</p>'+
'<p>Departement : {{ $distributeur->departement->nomd }}</p>' +
'<p>Téléphone : {{ $distributeur->contact }}</p>' ).openPopup();
    @else
    var marker = L.marker([parseFloat({{ $distributeur->latitude }}),parseFloat({{ $distributeur->longitude }} )], {icon: greenIcon}).addTo(map);
    marker.bindPopup('<p> Nom : {{ $distributeur->nomcomplet }}</p>'+
'<p>Stock : {{ $distributeur->stock }}</p>' +
'<p>Commande : {{ $distributeur->commande }}</p>' +
'<p>Dernière MAJ : {{ Carbon\Carbon::parse($distributeur->updated_at)->format('d-m-Y')  }}</p>'+
'<p>Departement : {{ $distributeur->departement->nomd }}</p>' +
'<p>Téléphone : {{ $distributeur->contact }}</p>' ).openPopup();
    @endif

    @endforeach



</script>
@endsection

