<?php

namespace App\Http\Controllers;

use App\Repositories\DistributeurRepository;
use App\Repositories\StockRepository;
use Illuminate\Http\Request;

class StockController extends Controller
{
    protected $stockRepository;
    protected $distributeurRepository;

    public function __construct(StockRepository $stockRepository, DistributeurRepository $distributeurRepository){
        $this->stockRepository =$stockRepository;
        $this->distributeurRepository = $distributeurRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = $this->stockRepository->getAllWithRelation();
        return view('stock.index',compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $distributeurs = $this->distributeurRepository->getAll();
        return view('stock.add',compact('distributeurs'));
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
        $distributeur->stock = $request['stock'];
        $distributeur->save();
        $stocks = $this->stockRepository->store($request->all());
        return redirect('stock');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock = $this->stockRepository->getById($id);
        return view('stock.show',compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $distributeurs = $this->distributeurRepository->getAll();
        $stock = $this->stockRepository->getById($id);
        return view('stock.edit',compact('stock','distributeurs'));
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
        $distributeur->stock = $request['stock'];
        $distributeur->save();
        $this->stockRepository->update($id, $request->all());

        return redirect('stock');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->stockRepository->destroy($id);
        return redirect('stock');
}
}
