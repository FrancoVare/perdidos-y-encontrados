@include('layouts.head')

@include('layouts.navbar')

<div class="container" id="app">
	<flash :display-icons="true" :timeout="5000"></flash>
	@yield('content')
</div> <!--wrapper-->
	
@include('layouts.footer')