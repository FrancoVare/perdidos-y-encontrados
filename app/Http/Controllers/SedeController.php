<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sede;

class SedeController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth','first-login']);
    }

    public function index()
    {
    	$sedes = Sede::where('baja',false)->orderBy('nombre')->get();

    	return view('sedes.index',compact('sedes'));
    }

    public function apiSedes()
    {
        $sedes = Sede::where('baja',false)->orderBy('nombre')->get();

        return json_encode($sedes);
    }

    public function store()
    {
    	$this->validate(request(),[

    		'nombreSede' => 'required',  
    		'direccion' => 'required'

    	]);

    	$sede = Sede::create([

    		'nombre' => request('nombreSede'),  
    		'direccion' => request('direccion')

    	]);

        return response()->json(['message' => 'La sede '. $sede->nombre .'ha sido agregada']);
    }

    public function destroy()
    {

    	$this->validate(request(),[

    		'sede' => 'required'

    	]);

    	$sede = Sede::find(request('sede'));
    	$sede-> baja = true;
    	$sede->save();

        return response()->json(['message' => 'La sede '. $sede->nombre .' ha sido eliminada']);

    }
}
