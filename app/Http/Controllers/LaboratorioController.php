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

    public function store()
    {
    	$this->validate(request(),[

    		'nombre-lab' => 'required',  
            'sede' => 'required'

    	]);

    	Laboratorio::create([

    		'nombre' => request('nombre-lab'),  
            'sede_id' => request('sede')

    	]);

        $this->flash('El laboratorio ha sido agregado');
    	return redirect('/laboratorios');
    }

    public function destroy()
    {

    	$this->validate(request(),[

    		'nombre' => 'required'

    	]);

    	$lab = Laboratorio::find(request('nombre'));
    	$lab-> baja = true;
    	$lab->save();

        $this->flash('El laboratorio ha sido eliminado');
    	return redirect('/laboratorios');

    }
}
