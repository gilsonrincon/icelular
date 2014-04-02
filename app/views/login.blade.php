<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>INICIO DE SESIÓN</title>
	{{ HTML::style('bootstrap/css/bootstrap.css') }}
	{{ HTML::style('css/login.css') }}
</head>
<body>
	<div id="contenedor_ingresar">
		@if(isset($message))
			<div class="alert alert-danger">
				{{$message}}
			</div>
		@endif
		<h1>Iniciar sesión</h1>
		{{Form::open(array("url"=>"login"))}}
		    <label for="correo_sesion">Correo Electrónico</label>
			<input id="correo_sesion" type="email" name="email" value="" />
			<label for="contrasena_sesion">Contraseña</label>
			<input id="contrasena_sesion" type="password" name="password" value="" />
			<button class="btn btn-primary" id="boton_sesion" type="submit">Ingresar</button>
		{{Form::close()}}
	</div>
</body>
</html>