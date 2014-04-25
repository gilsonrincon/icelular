@extends ('front.base')

@section ('body')
	<div id="store" class="col-md-12">
		<h2>Contactenos</h2>
		{{Form::open(array('url' => 'contacto', 'id' => 'contact'))}}
		<div class="col-md-6">
			<div class="form-group">
				<label for="email">Email address</label>
			    {{Form::text('email', '', array('placeholder' => 'Correo:', 'class' => 'require email form-control', 'id' =>'email'))}}<br>
			</div>

			<div class="form-group">
				<label for="subject">Asunto</label>
				{{Form::text('subject', '', array('placeholder' => 'Asunto:', 'class' => 'require form-control', 'id' =>'subject'))}}<br>
			</div>
		</div>
		<div class="col-md-6">
			<label for="msg">Mensje:</label>
			{{Form::textarea('msg', '', array('placeholder' => 'Mensaje:', 'class' => 'require form-control', 'id' =>'msg'))}}<br>
		</div>
		
		{{Form::submit('Enviar', array('class' => 'btn btn-primary btn-submit', 'data-form' => 'contact'))}}
		
		{{Form::close()}}

		<div class="validation" style="padding-top:20px; padding-bottom:20px; height:40px">
			<p></p>
		</div>
	</div>
@stop