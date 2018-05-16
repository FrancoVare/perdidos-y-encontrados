@extends('layouts.master')

@section('content')

<items auth-check={{Auth::check()}}></items>

@endsection