<?php

namespace App\Repositories;

use App\Commande;


class CommandeRepository extends RessourceRepository{
  public function __construct(Commande $commande)
  {
      $this->model = $commande;
  }
  public function getAllWithRelation(){
    return Commande::with(['departement','distributeur'])
    ->get();
}
public function getCommandesByRegion($id){
    return Commande::with('region')
    ->where('region_id',$id)
    ->get();
}
}
