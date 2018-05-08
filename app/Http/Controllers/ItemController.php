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

      $items = Item::with(['materia','laboratorio','tag','user','laboratorio.sede'])
                        ->latest()
                        ->paginate(15);
      
      if(!is_null(request('tag'))){
        $items = Item::with(['materia','laboratorio','tag','user','laboratorio.sede'])
                        ->where('tag_id','=',Tag::where('nombre','=',request('tag'))->first()->id)
                        ->latest()
                        ->paginate(15);
      }

      return json_encode($items);
   }

   public function show(Item $item)
    {
    	return view('items.show',compact('item'));
    }



    public function createVue()
    {
      $materias = Materia::where('baja',false)->orderBy('nombre')->get();
      $tags = Tag::where('baja',false)->orderBy('nombre')->get();
      $laboratorios = Laboratorio::where('baja',false)->orderBy('nombre')->get();
      
      return view('items.create-vue',compact('materias','tags','laboratorios'));
    }

    public function create()
    {
    	$materias = Materia::where('baja',false)->orderBy('nombre')->get();
      $tags = Tag::where('baja',false)->orderBy('nombre')->get();
      $laboratorios = Laboratorio::where('baja',false)->orderBy('nombre')->get();

    	return view('items.create',compact('materias','tags','laboratorios'));
    }

    public function store()
    {
    	$this->validate(request(),[

    		'descripcion' => 'required',
    		'materia_id' => 'required',
        'laboratorio_id' => 'required',
        'tag_id' => 'required'

    	]);

    	$fechaEncontrado = date('Y-m-d H:i:s');
    	$descripcion = request('descripcion');
    	$materia_id = request('materia_id');
      $laboratorio_id = request('laboratorio_id');
      $tag_id = request('tag_id');

    	auth()->user()->publish(new Item(compact('descripcion','fechaEncontrado','materia_id','tag_id','laboratorio_id')));

      $this->flash('El objeto ha sido registrado');
    	return redirect('/');
    }
}
