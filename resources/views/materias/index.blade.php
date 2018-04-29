@extends('layouts.master')

@section('content')

<div class="row">
  <div class="column">
  	<h1>Agregar Materia</h1>
  	
	<div class="container">
		<hr>
		<form method="post" action="/materias">
		@csrf

		<div class="form-group">
		    <label for="nombre">Nombre:</label>
		    <input type="text" class="form-control" id="nombre" name="nombre" >
		 </div>

		<div class="form-group">
			 <button type="submit" class="btn btn-primary">Agregar</button>
		</div>
		
	</form>
	</div>
  </div>
  <div class="column" style="border-left:1px solid gray">
  	<h1>Eliminar Materia</h1>
  	
  	<div class="container">
  		<hr>
  		<form method="post" action="/materias/destroy">
		@csrf

		<div class="form-group">
			<select class="form-control" id="nombre" name="nombre" style="width: 95%" size="10">

			@foreach($materias as $materia)

	        <option value="{{$materia->id}}">{{$materia->nombre}}</option>

	        @endforeach
			
		</select>
		</div>

		<div class="form-group">
			 <button type="submit" class="btn btn-primary">Eliminar</button>
		</div>
		
	</form>
  	</div>
  </div>
</div>



	

          

{{--           <nav>
            <ul class="pager">
              <li><a href="#">Previous</a></li>
              <li><a href="#">Next</a></li>
            </ul>
          </nav> --}}


@endsection