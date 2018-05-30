<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ReporteController extends Controller
{
    public function __construct()
   	{
   		return $this->middleware(['first-login','auth']);
   	}


    public function index()
    {  
    	$ptp = $this->promedioTiempoPerdido();
    	$ppa = $this->perdidoPorAtributo(request('atributo'));
      	return view('reportes.index')->with(compact('ptp','ppa'));
    }

    public function promedioTiempoPerdido()
    {  
    	$items = Item::has('retiro')->with('retiro')->get();
    	$calc = $items->map(function($item){
    		return ['perdido'=>$item->created_at,'encontrado'=>$item->retiro->created_at, 'diferencia' => $item->created_at->diffInDays($item->retiro->created_at)];
    	});

    	$reporte = ['promedio'=>round($calc->avg('diferencia'),2),'cantidad'=>$calc->count()];
      	return $reporte;
    }

    public function perdidoPorAtributo($atributo)
    {  
    	//atributos validos:
    	//laboratorio
    	//sede
    	//tag
    	//materia
    	$items = Item::all();
    	if($atributo == 'sede'){
    		$items = $items->groupBy(function($item){
	    		return $item->laboratorio->sede->nombre;
	    	});
    	} else {
    		$items = $items->groupBy(function($item) use($atributo){
	    		return $item[$atributo]->nombre;
	    	});
    	}
    	
    	$items = $items->map(function($atributo){return $atributo->count();});
      	return $items;
    }

    public function perdidoPorDia()
    {
    	//TODO: hacer para mes tambien?
    }
}