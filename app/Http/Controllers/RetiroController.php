<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Laboratorio;
use App\Retiro;

class RetiroController extends Controller
{
	public function __construct()
    {
        return $this->middleware(['auth','first-login']);
    }

    public function create()
    {
    	$laboratorios = Laboratorio::where('baja',false)->orderBy('nombre')->get();
    	$item = Item::find(request('item'));

    	return view('retiros.create',compact('item','laboratorios'));
    }

    public function store()
    {
    	$this->validate(request(), [

    		'nombre' => 'required|string',
    		'tipoDoc' => 'required|string',
    		'numeroDoc' => 'required|numeric',
    		'laboratorio_id' => 'required',
    		'item_id' => 'required',

    	]);

    	$r = Retiro::create([

    		'nombre' => request('nombre'),  
    		'tipoDoc' => request('tipoDoc'),  
    		'numeroDoc' => request('numeroDoc'),   
    		'laboratorio_id' => request('laboratorio_id'),   
    		'item_id' => request('item_id'),   
    		'fechaEntregado' => date('Y-m-d H:i:s'),   
    		'tipoDoc' => request('tipoDoc'),   
    		'user_id' => auth()->user()->id
    	]);


    	$this->flash('El retiro ha sido registrado');
    	return redirect()->home();
    }
}
