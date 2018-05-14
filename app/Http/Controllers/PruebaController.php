<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prueba;

class PruebaController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth','first-login']);
    }

   	public function index()
   	{
   		$pruebas = Prueba::where('baja',false)->orderBy('nombre')->get();

    	return view('pruebas.index',compact('pruebas'));
   	}

    public function apiPruebas()
    {
        $pruebas = Prueba::where('baja',false)->orderBy('nombre')->get();

        return json_encode($pruebas);
    }

   	public function show()
    {
    	
    }

    public function destroy()
    {
    	$this->validate(request(),[

    		'nombre_prueba' => 'required'

    	]);

    	$mat = Prueba::find(request('nombre_prueba'));
    	$mat-> baja = true;
    	$mat->save();

        $this->flash('La prueba ha sido eliminada');
    	return redirect('/pruebas');

    }

    public function store()
    {
    	$this->validate(request(),[

    		'nombre' => 'required'

    	]);

    	Prueba::create([

    		'nombre' => request('nombre')

    	]);

        $this->flash('La prueba ha sido agregada');
    	return redirect('/pruebas');
    }
}
