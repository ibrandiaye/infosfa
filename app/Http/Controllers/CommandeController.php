<?php

namespace App\Http\Controllers;

use App\Repositories\CommandeRepository;
use App\Repositories\DepartementRepository;
use App\Repositories\DistributeurRepository;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    protected $commandeRepository;
    protected $departementRepository;
    protected $distributeurRepository;

    public function __construct(CommandeRepository $commandeRepository, DepartementRepository $departementRepository,
    DistributeurRepository $distributeurRepository){
        $this->commandeRepository =$commandeRepository;
        $this->departementRepository = $departementRepository;
        $this->distributeurRepository = $distributeurRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commandes = $this->commandeRepository->getAllWithRelation();
        return view('commande.index',compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departements = $this->departementRepository->getAll();
        $distributeurs = $this->distributeurRepository->getAll();
        return view('commande.add',compact('departements','distributeurs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $distributeur = $this->distributeurRepository->getById($request['distributeur_id']);
        $distributeur->commande = $request['nbfacom'];
       // dd($distributeur);
        $distributeur->save();
        $commandes = $this->commandeRepository->store($request->all());
        return redirect('commande');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commande = $this->commandeRepository->getById($id);
        return view('commande.show',compact('commande'));
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
        $commande = $this->commandeRepository->getById($id);
        $distributeurs = $this->distributeurRepository->getAll();
        return view('commande.edit',compact('commande','departements','distributeurs'));
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
        $distributeur = $this->distributeurRepository->getById($request['distributeur_id']);
        $distributeur->commande = $request['nbfacom'];
       // dd($distributeur);
        $distributeur->save();
        $this->commandeRepository->update($id, $request->all());
        return redirect('commande');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->commandeRepository->destroy($id);
        return redirect('commande');
}
}
