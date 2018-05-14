<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Prueba;

class TagController extends Controller
{

    public function __construct()
    {
        return $this->middleware(['auth','first-login'])->except('apiTags');
    }

   	public function index()
   	{
     		$tags = Tag::where('baja',false)->orderBy('nombre')->get();
     		$pruebas = Prueba::where('baja',false)->orderBy('nombre')->get();

      	return view('tags.index',compact('tags','pruebas'));
   	}

    public function apiTags()
    {
      if(request('side')){
        return Tag::has('items')->get();
      } else {
        return Tag::where('baja',false)->orderBy('nombre')->get();
      }
      
    }

   	public function show()
    {
    	
    }

    public function create()
    {

    }

    public function store()
    {
        $this->validate(request(),[

          'nombre' => 'required',
          'pruebas' => 'required'

        ]);

        $tag = new Tag;

        $tag->nombre = request('nombre');
        $tag->save();

        $tag->pruebas()->attach(request('pruebas'));

        $tag->save();

        return response()->json(['message' => 'El tag '.$tag->nombre.' ha sido agregado']);
    }

    public function destroy()
    {

      $this->validate(request(),[

        'nombre' => 'required'

      ]);

      $tag = Tag::find(request('nombre'));
      $tag-> baja = true;
      $tag->save();

      return response()->json(['message' => 'El tag '.$tag->nombre.' ha sido eliminado']);

    }
}
