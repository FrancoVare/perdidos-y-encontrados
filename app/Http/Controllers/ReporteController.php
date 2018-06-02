<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Carbon\Carbon;

class ReporteController extends Controller
{
    public function __construct()
   	{
   		return $this->middleware(['first-login','auth']);
   	}


    public function index()
    {  
      	return view('reportes.index');
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

    public function perdidosPorAtributo()
    {  
    	//atributos validos:
    	//laboratorio
    	//sede
    	//tag
    	//materia
    	$atributo = request('atributo');
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
    	
    	$items = $items->map(function($atributo, $key){return ['cantidad' => $atributo->count(),'nombre'=>$key];});
    	// dd($items);
      	return $items;
    }

    public function perdidoPorDia()
    {
    	$items = Item::all();
    	$items = $items->groupBy(function($item){
    		$ret = $item->created_at->dayOfWeek;
    		if($ret == 0) return 7;
    		else return $ret;
    	})->sortBy(function($item,$key){return $key;})
    	  ->map(function($items,$key){
    		return [collect([$key]),$items->groupBy(function($item){
    			return $item->created_at->hour;
    		})->map(function($it,$key){return [$key,$it->count()];})
    			->sortBy(function($item,$key){return $key;})];
    	});
    	$items = $items->map(function($item){
    		return $item[0]->crossJoin($item[1])->map(function($i){return collect($i)->flatten();});
    	})->collapse()->map(function($item){return collect(['y','x','value'])->combine($item);})->toArray();
    	return $items;
    }

    public function perdidoEncontrado()
    {
    	$perdidos = Item::has('retiro','<',1)->count();
    	$encontrados = Item::has('retiro')->count();

    	return [['Perdidos',$perdidos],['Encontrados',$encontrados]];
    }
}
