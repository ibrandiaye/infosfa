{{-- \resources\views\permissions\create.blade.php --}}
@extends('layout')


@section('content')

    <div class="content-wrapper">

        <div class="container">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-info">GESTION DES commandes</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" role="button" class="btn btn-primary">ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('commande.index') }}" role="button" class="btn btn-primary">LISTE D'ENREGISTREMENT DES commande</a></li>

                        </ol>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
        <form action="{{ route('commande.store') }}" method="POST">
            @csrf
             <div class="card border-danger border-0">
                        <div class="card-header bg-info text-center">FORMULAIRE D'ENREGISTREMENT D'UN commande</div>
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
                                            <label>Nombre de FA commandés </label>
                                            <input type="number" name="nbfacom"  value="{{ old('nbfacom') }}" class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Adresse du fournisseur </label>
                                            <input type="text" name="adresse"  value="{{ old('adresse') }}" class="form-control"  required>
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
                                        <label>Distributeur</label>
                                        <select class="form-control" name="distributeur_id" required="">
                                            @foreach ($distributeurs as $distributeur)
                                            <option value="{{$distributeur->id}}">{{$distributeur->nomcomplet}}</option>
                                                @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div id="map"></div>
                                </div>

                                    <div>
                                        <center>
                                            <br>
                                            <button type="submit" class="btn btn-success btn btn-lg "> ENREGISTRER</button>
                                        </center>
                                    </div>
                                </div>

                                </div>


             </div>
            </form>
            </div>
        </div>



@endsection


