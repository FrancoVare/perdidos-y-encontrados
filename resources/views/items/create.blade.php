@extends('layouts.master')

@section('content')

		<div class="col-sm-6 center">
			
			<h1>Registrar un objeto perdido</h1>

			<hr>

			<form method="POST" action="/items">
			 
			 {{csrf_field()}}

			<div class="form-group">
				<label for="materia_id">Materia:</label>
				<select class="form-control" id="materia_id" name="materia_id" style="width: 50%" size="10">

					@foreach($materias as $materia)

			     	   <option value="{{$materia->id}}">{{$materia->nombre}}</option>

			        @endforeach
				
				</select>
			</div>

			 <div class="form-group">
			    <label for="descripcion">Descripcion:</label>
			    <textarea id="descripcion" name="descripcion" class="form-control" ></textarea>
			 </div>

			 <div class="form-group">
			 	<button type="submit" class="btn btn-primary">Registrar</button>
			 </div>
			
			 {{-- @include('layouts.errors') --}}

			</form>

		</div>

		


@endsection