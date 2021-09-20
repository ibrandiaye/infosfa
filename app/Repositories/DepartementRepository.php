<?php

namespace App\Repositories;

use App\Departement;


class DepartementRepository extends RessourceRepository{
  public function __construct(Departement $departement)
  {
      $this->model = $departement;
  }
  public function getAllWithRegion(){
    return Departement::with('region')
    ->get();
}
public function getDepartementsByRegion($id){
    return Departement::with('region')
    ->where('region_id',$id)
    ->get();
}
}
