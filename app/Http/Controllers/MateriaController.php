<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;

class MateriaController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth','first-login'])->except('apiMaterias');
    }

    public function apiMaterias()
    {
        return json_encode(Materia::where('baja',false)->orderBy('nombre')->get());
    }

    public function store()
    {
    	$this->validate(request(),[

    		'nombreMateria' => 'required'

    	]);

    	$mat = Materia::create([

    		'nombre' => request('nombreMateria')

    	]);

    	return response()->json(['message' => 'La materia '.$mat->nombre.' ha sido agregada']);
    }

    public function destroy()
    {

    	$this->validate(request(),[

    		'nombre' => 'required'

    	]);

    	$mat = Materia::find(request('nombre'));
    	$mat-> baja = true;
    	$mat->save();

    	return response()->json(['message' => 'La materia '.$mat->nombre.' ha sido eliminada']);
    }
}
