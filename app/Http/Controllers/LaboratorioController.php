<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laboratorio;
use App\Sede;

class LaboratorioController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth','first-login']);
    }

    public function index()
    {
    	$laboratorios = Laboratorio::where('baja',false)->orderBy('nombre')->get();
    	$sedes = Sede::where('baja',false)->orderBy('nombre')->get();

    	return view('laboratorios.index',compact('laboratorios','sedes'));
    }

    public function apiLaboratorios()
    {
        $laboratorios = Laboratorio::with('sede')->where('baja',false)->orderBy('nombre')->get();

        return json_encode($laboratorios);
    }

    public function store()
    {
    	$this->validate(request(),[

    		'nombreLab' => 'required',  
            'sede' => 'required'

    	]);

    	$lab = Laboratorio::create([

    		'nombre' => request('nombreLab'),  
            'sede_id' => request('sede')

    	]);

        return response()->json(['message' => 'El laboratorio '.$lab->nombre .' de ' . $lab->sede->nombre . ' ha sido agregado']);
    }

    public function destroy()
    {

    	$this->validate(request(),[

    		'nombre' => 'required'

    	]);

    	$lab = Laboratorio::find(request('nombre'));
    	$lab-> baja = true;
    	$lab->save();

    	return response()->json(['message' => 'El laboratorio '.$lab->nombre .' de ' . $lab->sede->nombre . ' ha sido eliminado']);

    }
}
