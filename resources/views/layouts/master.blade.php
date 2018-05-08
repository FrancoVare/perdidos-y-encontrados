@include('layouts.head')

@include('layouts.navbar')

@if($flash = session('message'))

<div id="flash-message" class="alert alert-success" role="alert">
	{{$flash}}
</div>

@endif


<div class="container-fluid" style="padding-left: 0">
	@if(Auth::check())
		@include('layouts.sidebar')
	@endif

	<div id="right">
		@if(Auth::check())
		<a class="side" href="#" data-target="#sidebar" data-toggle="collapse"><i class="fa fa-navicon fa-2x py-2 p-1"></i></a>
		@else
		<i style="visibility: hidden;" class="fa fa-navicon fa-2x py-2 p-1"></i>
		@endif
		@yield('content')
	</div> <!--blog-main-->
</div> <!--wrapper-->

{{-- <div id="app">
	<button @click="showNewMateriaModal = true">New Materia</button>
	<new-materia-modal :show="showNewMateriaModal" @close="showNewMateriaModal = false"></new-materia-modal>
</div> --}}
	
@include('layouts.footer')