<?php

namespace App\Repositories;

use App\Distributeur;
use Illuminate\Support\Facades\DB;

class DistributeurRepository extends RessourceRepository{
  public function __construct(Distributeur $distributeur)
  {
      $this->model = $distributeur;
  }
  public function getAllWithRelation(){
    return Distributeur::with(['departement','departement.region'])
    ->get();
}
public function getdistributeursByRegion($id){
    return Distributeur::with('region')
    ->where('region_id',$id)
    ->get();
}
public function getSumStockByDepartement(){
    return DB::table('distributeurs')
    ->join('departements','distributeurs.departement_id','=','departements.id')
    ->select('departements.nomd', DB::raw('sum(distributeurs.stock) as stock'))
    ->groupBy('departements.nomd')
    ->get();
}
public function getSumCommandeByDepartement(){
    return DB::table('distributeurs')
    ->join('departements','distributeurs.departement_id','=','departements.id')
    ->select('departements.nomd', DB::raw('sum(distributeurs.commande) as commande'))
    ->groupBy('departements.nomd')
    ->get();
}
public function getSumStockByRegion(){
    return DB::table('distributeurs')
    ->join('departements','distributeurs.departement_id','=','departements.id')
    ->join('regions','departements.region_id','=','regions.id')
    ->select('regions.nom', DB::raw('sum(distributeurs.stock) as stock'))
    ->groupBy('regions.nom')
    ->get();
}
public function getSumCommandeByRegion(){
    return DB::table('distributeurs')
    ->join('departements','distributeurs.departement_id','=','departements.id')
    ->join('regions','departements.region_id','=','regions.id')
    ->select('regions.nom', DB::raw('sum(distributeurs.commande) as commande'))
    ->groupBy('regions.nom')
    ->get();
}

}
