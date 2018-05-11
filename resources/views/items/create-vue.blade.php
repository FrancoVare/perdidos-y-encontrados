@extends('layouts.master')

@section('content')

<div class="row" id="app">
	<flash :display-icons="true" :timeout="5000"></flash>
	<div class="col-sm-1">
		
	</div>
	<div class="col-sm-10">
	
		<h1>Registrar un objeto perdido</h1>

		<hr>

		<div class="row">
			<div class="col-sm-4" style="display: flex;">
				<registro atributo="Materia"></registro>
			</div>
			<div class="col-sm-4" style="display: flex;">
				<registro atributo="Tag"></registro>
			</div>
			<div class="col-sm-4" style="display: flex;">
				<registro atributo="Laboratorio"></registro>
			</div>
		</div>
	</div>
</div>

@endsection