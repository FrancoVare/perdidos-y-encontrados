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

    		'pruebas' => 'required'

    	]);

    	$pruebas = Prueba::find(request('pruebas'));
       $nombres = [];
        
        foreach ($pruebas as $prueba) {
            $prueba-> baja = true;
            $prueba->save();
            $nombres[] = $prueba->nombre;
        }

        if(count($pruebas)>1){
            $s = 's';
            $n = 'n';
            $nombres = implode(', ',$nombres);
        } else {
            $s = '';
            $n = '';
            $nombres = $nombres[0];
        }
        return response()->json(['message' => "La{$s} prueba{$s} " .$nombres." ha{$n} sido eliminada{$s}"]);

    }

    public function store()
    {
    	$this->validate(request(),[

    		'nombre' => 'required'

    	]);

    	$prueba = Prueba::create([

    		'nombre' => request('nombre')

    	]);

        return response()->json(['message' => 'La prueba '.$prueba->nombre.' ha sido agregada']);
    }
}
