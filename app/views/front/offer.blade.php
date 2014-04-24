@extends ('front.base')

@section ('body')
		<!--Información de la oferta-->
		<h2>{{$offer->title}}</h2>
		<b>Tienda:</b> {{$offer->store->name}}<br>

		<p>{{$offer->description}}</p>
		
		<ul>
			@foreach ($offer->reviews as $review)
				<li>
					<b>{{$review->vote}}</b><br>
					<p>{{$review->comment}}</p>
				</li>
			@endforeach
		</ul>

		{{Form::open(array('url' => 'oferta', 'id'=>'review'))}}
			{{Form::hidden('offer', $offer->id)}}
			<div class="form-group">
			    <label for="exampleInputEmail1">Voto</label>
			    <select name="vote" id="vote" class="form-control numeric">
			    	<option value="no-calificado">Seleccionar</option>
			    	<option value="1">1</option>
			    	<option value="2">2</option>
			    	<option value="3">3</option>
			    	<option value="4">4</option>
			    	<option value="5">5</option>
			    </select>
			</div>
			<div class="form-group">
			    {{Form::textarea('comment', '', array('class' => 'form-control require', 'placeholder' => 'Por favor dinos la razon de tu voto'))}}
			</div>
			{{Form::submit('Enviar', array('class' => 'btn btn-primary btn-submit', 'data-form' => 'review'))}}
		{{Form::close()}}

		<div class="validation" style="padding-top:20px; padding-bottom:20px; height:40px">
			<p></p>
		</div>

@stop