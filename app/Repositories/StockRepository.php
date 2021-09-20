<?php

namespace App\Repositories;

use App\Stock;


class StockRepository extends RessourceRepository{
  public function __construct(Stock $stock)
  {
      $this->model = $stock;
  }

  public function getAllWithRelation(){
      return Stock::with(['distributeur'])
      ->get();
  }
}
