<!DOCTYPE html>
<html>
<head>		
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}" crossorigin="anonymous">
	<title>Cadastro de Produtos</title>
	<style type="text/css">
		body {
			padding: 20px;
		}
		.navbar {
			margin-bottom: 20px;
		}
	</style>
</head>
<body>
	<div class="container">
		@component('componente_navbar', ["current" => $current])
		@endcomponent
		<main role="main">
			@hasSection('body')
				@yield('body')
			@endif
		</main>	
	</div>
	<!-- JS, Popper.js, Maks, e jQuery -->
	<script src="{{asset('js/jquery-3.5.1.min.js')}}" type="text/javascript" crossorigin="anonymous"></script>
	<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript" crossorigin="anonymous"></script>
	<script src="{{asset('js/popper.min.js')}}" type="text/javascript" crossorigin="anonymous"></script>
	<script src="{{asset('js/jquery.mask.min.js')}}" type="text/javascript" crossorigin="anonymous"></script>

	
	@hasSection('javascript')
		@yield('javascript')
	@endif	
</body>
</html>