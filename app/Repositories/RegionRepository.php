<?php

namespace App\Repositories;

use App\Region;


class RegionRepository extends RessourceRepository{
  public function __construct(Region $region)
  {
      $this->model = $region;
  }
}
