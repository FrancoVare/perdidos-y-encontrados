@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-sm-1">
		
	</div>
	<div class="col-sm-8">
	
		<h1>Registrar retiro de {{$item->tag->nombre}}</h1>

		<hr>

		<form action="/retiros" method="POST">
			{{csrf_field()}}
			<input type="hidden" name="item_id" value="{{$item->id}}" /> 

			<div class="form-group">
				<label for="nombre">Nombre de quien retira:</label>
				<input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="nombre" name="nombre">
			</div>

			<label>Identificacion:</label>
			<div class="form-group">
				
				<select class="form-control{{ $errors->has('tipoDoc') ? ' is-invalid' : '' }}" id="tipoDoc" name="tipoDoc" style="width: 15%; float: left">

					<option>DNI</option>
					<option>Legajo</option>
						
				</select>
				<input type="text" class="form-control{{ $errors->has('numeroDoc') ? ' is-invalid' : '' }}" id="numeroDoc" name="numeroDoc" style="width: 80%; float: right">
				@if ($errors->has('numeroDoc'))
	                <span class="invalid-feedback">
	                    <strong>Debe ingresar un numero de documento</strong>
	                </span>
	            @endif
			</div>
			<div class="form-group" style="padding-top: 2rem">
				<label for="laboratorio_id">Laboratorio:</label>
				<select class="form-control{{ $errors->has('laboratorio_id') ? ' is-invalid' : '' }}" id="laboratorio_id" name="laboratorio_id">

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
			<hr>
			<div class="form-group" style="text-align: right;">
				<button type="submit" class="btn btn-primary">Aceptar</button>
			</div>
		</form>

	</div>
	<div class="col-sm-1"></div>
	<div class="col-sm-2">
		<div class="filter-module filter-module-inset" style="word-wrap: break-word; width: 25vh;">
        <h4 style="text-align: center;">Pruebas Minimas</h4>
        <ul class="fa-ul">
        	@foreach($item->tag->pruebas as $prueba)
        	<li><i class="fa-li fa fa-chevron-circle-right"></i>{{$prueba->nombre}}</li>
        	@endforeach
        </ul>
    </div>
	</div>
</div>
		


@endsection