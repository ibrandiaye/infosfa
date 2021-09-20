<?php

namespace App\Http\Controllers;

use App\Repositories\DepartementRepository;
use App\Repositories\DistributeurRepository;
use Illuminate\Http\Request;

class DistributeurController extends Controller
{
    protected $distributeurRepository;
    protected $departementRepository;

    public function __construct(DistributeurRepository $distributeurRepository, DepartementRepository $departementRepository){
        $this->distributeurRepository =$distributeurRepository;
        $this->departementRepository = $departementRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distributeurs = $this->distributeurRepository->getAllWithRelation();
        return view('distributeur.index',compact('distributeurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departements = $this->departementRepository->getAll();
        return view('distributeur.add',compact('departements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$request->merge(['stock'=>0,'commande'=>0]);
        $distributeurs = $this->distributeurRepository->store($request->all());

        return redirect('distributeur');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $distributeur = $this->distributeurRepository->getById($id);
        return view('distributeur.show',compact('distributeur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departements = $this->departementRepository->getAll();
        $distributeur = $this->distributeurRepository->getById($id);
        return view('distributeur.edit',compact('distributeur','departements'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->distributeurRepository->update($id, $request->all());
        return redirect('distributeur');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->distributeurRepository->destroy($id);
        return redirect('distributeur');
}
public function dashboard(){
    $distributeurs = $this->distributeurRepository->getAllWithRelation();
    $stockByDepartement = $this->distributeurRepository->getSumStockByDepartement();
    $commandeByDepartement = $this->distributeurRepository->getSumCommandeByDepartement();
    $stockByRegion = $this->distributeurRepository->getSumStockByRegion();
    $commandeByRegion = $this->distributeurRepository->getSumCommandeByRegion();
    return view('welcome',compact('distributeurs','stockByDepartement','commandeByDepartement',
'stockByRegion','commandeByRegion'));
}
}
