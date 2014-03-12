@if(isset($message))
	<div class="alert alert-error">
		{{$message}}
	</div>
@endif
<h1>Inicio de sesión</h1>
{{Form::open(array("url"=>"login"))}}
	<input type="email" name="email" value="" />
	<input type="password" name="password" value="" />
	<button type="submit">Ingresar</button>
{{Form::close()}}
