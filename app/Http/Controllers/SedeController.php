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

    public function store()
    {
    	$this->validate(request(),[

    		'nombre-sede' => 'required',  
    		'direccion' => 'required'

    	]);

    	Sede::create([

    		'nombre' => request('nombre-sede'),  
    		'direccion' => request('direccion')

    	]);

        $this->flash('La sede ha sido agregada');
    	return redirect('/sedes');
    }

    public function destroy()
    {

    	$this->validate(request(),[

    		'nombre' => 'required'

    	]);

    	$sede = Sede::find(request('nombre'));
    	$sede-> baja = true;
    	$sede->save();

        $this->flash('La sede ha sido eliminada');
    	return redirect('/sedes');

    }
}
