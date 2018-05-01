@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-sm-1">
		
	</div>
	<div class="col-sm-10">
	
		<h1>Registrar un objeto perdido</h1>

		<hr>

		<form method="POST" action="/items">
		 
		 	{{csrf_field()}}

			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label for="materia_id">Materia:</label>
						<select class="form-control{{ $errors->has('materia_id') ? ' is-invalid' : '' }}" id="materia_id" name="materia_id" style="width: 100%" size="10">

							@foreach($materias as $materia)

					     	   <option value="{{$materia->id}}">{{$materia->nombre}}</option>

					        @endforeach
						
						</select>
						@if ($errors->has('materia_id'))
                            <span class="invalid-feedback">
                                <strong>Debe seleccionar una materia</strong>
                            </span>
                        @endif
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label for="tag_id">Tag:</label>
						<select class="form-control{{ $errors->has('tag_id') ? ' is-invalid' : '' }}" id="tag_id" name="tag_id" style="width:100%" size="10">

							@foreach($tags as $tag)

					     	   <option value="{{$tag->id}}">{{$tag->nombre}}</option>

					        @endforeach
					
						</select>
						@if ($errors->has('tag_id'))
                            <span class="invalid-feedback">
                                <strong>Debe seleccionar un tag</strong>
                            </span>
                        @endif
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label for="laboratorio_id">Laboratorio:</label>
						<select class="form-control{{ $errors->has('laboratorio_id') ? ' is-invalid' : '' }}" id="laboratorio_id" name="laboratorio_id" style="width:100%" size="10">

							@foreach($laboratorios as $laboratorio)

					     	   <option value="{{$laboratorio->id}}">{{$laboratorio->nombre . ' en ' . $laboratorio->sede->nombre}}</option>

					        @endforeach
						
						</select>
						@if ($errors->has('tag_id'))
                            <span class="invalid-feedback">
                                <strong>Debe seleccionar un laboratorio</strong>
                            </span>
                        @endif
					</div>
				</div>
			</div>

			 <div class="form-group">
			    <label for="descripcion">Descripcion:</label>
			    <textarea id="descripcion" name="descripcion" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" ></textarea>
			    @if ($errors->has('descripcion'))
                    <span class="invalid-feedback">
                        <strong>Debe proveer una descripcion</strong>
                    </span>
                @endif
			 </div>

			 <div class="form-group">
			 	<button type="submit" class="btn btn-primary">Registrar</button>
			 </div>
		
		 {{-- @include('layouts.errors') --}}

		</form>

</div>


</div>
		


@endsection