@include('layouts.head')
@include('layouts.navbar')
<div class="lf-back"></div>




<div class="container fl-page" id="app">
	<flash :display-icons="true" :timeout="5000"></flash>
	@yield('content')
	<div class="fl-page-footer-wrap">
		<footer style="font-size:75%">
				Departamento de Ingeniería en Sistemas de Información - Universidad Tecnológica Nacional - Facultad Regional Buenos Aires <br>
				<font style="font-weight: bold">Medrano:</font> Av.Medrano 951, C.A.B.A. - Oficina 317 - 4867-7554 - 
				<font style="font-weight: bold">Campus:</font> Mozart 2300, C.A.B.A. - Oficina 263/264 - 4867-7500 <br>
				Para cualquier consulta puede escribirnos a <font style="font-weight: bold">disilab-soporte@sistemas.frba.utn.edu.ar</font> <br>
		</footer>
	</div>
</div> <!--wrapper-->
@include('layouts.footer')