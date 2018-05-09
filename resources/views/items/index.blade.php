@extends('layouts.master')

@section('content')


<div id="app">
	<items auth-check={{Auth::check()}}></items>
</div>

@endsection