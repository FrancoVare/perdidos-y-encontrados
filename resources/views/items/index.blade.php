@extends('layouts.master')

@section('content')


<div class="row">
	<div class="col-sm-1">
		
	</div>
	<div class="col-sm-10">
		@foreach($items as $item)

	    	@include('items.item')

   		@endforeach
	</div>
</div>
	


          

{{--           <nav>
            <ul class="pager">
              <li><a href="#">Previous</a></li>
              <li><a href="#">Next</a></li>
            </ul>
          </nav> --}}


@endsection