@extends('layouts.master')

@section('content')

<div class="row" id="app">
	<flash :display-icons="true" :timeout="5000"></flash>
	<div class="col-sm-1">
		
	</div>
	<div class="col-sm-10">
	
		<h1>Registrar un objeto perdido</h1>

		<hr>

		<registro-item></registro-item>
		
	</div>
</div>

@endsection