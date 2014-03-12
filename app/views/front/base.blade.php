<!DOCTYPE html>
<html lang="es">
	<head>
		
		<meta charset="utf-8" />
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- título de la página -->
		@section('head')
			<title>{{Configuration::getValue("meta_title")}}</title>
			<meta name="description" content="{{Configuration::getValue('meta_description')}}" />
			<meta name="keywords" content="{{Configuration::getValue('meta_keywords')}}" />
		@show
		
		<!-- add CSS files -->
		{{ HTML::style('bootstrap/css/bootstrap.css') }}
		{{ HTML::style('css/front.css') }}
		
		<!-- add JS files -->
		{{ HTML::script("js/jquery-1.10.2.min.js") }}
		{{ HTML::script("bootstrap/js/bootstrap.min.js") }}

	</head>

	<body>
		<header>
			<section class="container">
				<h1>¡BIENVENIDO A ICELULAR.COM!</h1>
			</section>
		</header>
		<section id="contenedor" class="container">
			@yield("body")
		</section>
	</body>
</html>

