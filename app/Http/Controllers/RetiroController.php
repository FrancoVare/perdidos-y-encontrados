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

    public function store(Request $request)
    {
    	$this->validate(request(), [

    		'nombre' => 'required|string',
    		'tipoDoc' => 'required|string',
    		'numeroDoc' => 'required|numeric',
    		'laboratorio_id' => 'required',
    		'item_id' => 'required',
            'foto_retiro' => 'required | mimes:jpeg,jpg,png'

    	]);

        $path = $request->file('foto_retiro')->store('images');

    	$r = Retiro::create([

    		'nombre' => request('nombre'),  
    		'tipoDoc' => request('tipoDoc'),  
    		'numeroDoc' => request('numeroDoc'),   
    		'laboratorio_id' => request('laboratorio_id'),   
    		'item_id' => request('item_id'),    
    		'tipoDoc' => request('tipoDoc'),   
    		'user_id' => auth()->user()->id,
            'foto_retiro' => $path
    	]);

    	$this->flash('El retiro ha sido registrado');
    	return redirect()->home();
    }
}
