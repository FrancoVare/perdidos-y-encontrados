<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;

class MateriaController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth','first-login']);
    }

    public function index()
    {
    	$materias = Materia::where('baja',false)->orderBy('nombre')->get();

    	return view('materias.index',compact('materias'));
    }

    public function store()
    {
    	$this->validate(request(),[

    		'nombre-materia' => 'required'

    	]);

        dd(request());

    	Materia::create([

    		'nombre' => request('nombre-materia')

    	]);

        $this->flash('La materia ha sido agregada');

    	return redirect('/materias');
    }

    public function destroy()
    {

    	$this->validate(request(),[

    		'nombre' => 'required'

    	]);

    	$mat = Materia::find(request('nombre'));
    	$mat-> baja = true;
    	$mat->save();

        $this->flash('La materia ha sido eliminada');
    	return redirect('/materias');

    }
}
