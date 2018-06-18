<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Materia;
use App\Tag;
use App\Laboratorio;

class ItemController extends Controller
{

	public function __construct()
   	{
   		return $this->middleware('auth')->except(['index','apiItems']);
   	}


   public function index(Tag $tag = null)
   {  
      return view('items.index');
   }

   public function apiItems()
   {  

      $items = Item::with(['materia','laboratorio','tag','user','laboratorio.sede','retiro'])
                        ->tag(request('tag'))
                        ->estado(request('estado'))
                        ->materia(request('materia'))
                        ->laboratorio(request('laboratorio'))
                        ->get();
                        if(request('q')){
                          $items = $items->filter(function($item){return $item->filtrar(request('q'));});
                        }

                        if(request('sede') != 'Todas'){
                          $items = $items->filter(function($item){return $item->laboratorio->sede->nombre == request('sede');});
                        }
      
      switch(request('sort')){
        case 'fa':
          //sort fecha nueva->vieja
          $items = $items->sortByDesc(function($item){
            return $item->created_at->timestamp;
          });
          break;
        case 'fd':
          //sort fecha vieja->nueva
          $items = $items->sortBy(function($item){
            return $item->created_at->timestamp;
          });
          break;
        case 'ma':
        //sort materia asc
          $items = $items->sortBy('materia.nombre');
          break;
        case 'md':
         //sort materia desc
          $items = $items->sortByDesc('materia.nombre');
          break;
        case 'ta':
        //sort tag asc
          $items = $items->sortBy('tag.nombre');
          break;
        case 'td':
         //sort tag desc
          $items = $items->sortByDesc('tag.nombre');
          break;
        case 'la':
         //sort laboratorio asc
          $items = $items->sortBy('laboratorio.nombre');
          break;
        case 'ld':
         //sort laboratorio desc
          $items = $items->sortByDesc('laboratorio.nombre');
          break;
        case 'sa':
         //sort sede asc
          $items = $items->sortBy('laboratorio.sede.nombre');
          break;
        case 'sd':
         //sort sede desc
          $items = $items->sortByDesc('laboratorio.sede.nombre');
          break;
      }

      $items = $items->values();
      $items = $items->paginate(15); 
      return json_encode($items);
   }

   public function show(Item $item)
    {
    	return view('items.show',compact('item'));
    }
    
    public function create()
    {
    	return view('items.create');
    }

    public function store()
    {
    	$this->validate(request(),[

    		'descripcion' => 'required|string',
    		'materia_id' => 'required|numeric',
        'laboratorio_id' => 'required|numeric',
        'tag_id' => 'required|numeric',
        'foto_item' => 'required | mimes:jpeg,jpg,png| max:15360'

    	]);

      $foto_item = request()->file('foto_item')->store('images');

    	$descripcion = request('descripcion');
    	$materia_id = request('materia_id');
      $laboratorio_id = request('laboratorio_id');
      $tag_id = request('tag_id');

    	auth()->user()->publish(new Item(compact('descripcion','materia_id','tag_id','laboratorio_id','foto_item')));

      return response()->json(['message' => 'El item ha sido registrado']);
    }
}
