@extends('layouts.master')

@section('content')

<div class="row" id="app">
	<div class="col-sm-1">
		
	</div>
	<div class="col-sm-10">
	
		<h1>Registrar un objeto perdido</h1>

		<hr>

		<button @click="showNewMateriaModal = true">New Materia</button>
		<new-materia-modal :show="showNewMateriaModal" @close="showNewMateriaModal = false"></new-materia-modal>

	</div>


</div>

@endsection