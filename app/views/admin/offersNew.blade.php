@extends("admin.layout")

@section("head")
	<title>Todas las ofertas</title>
@stop

@section("body")
	
	@if(isset($error))
		<div class="alert alert-warning">
			<h3>Error al guardar la oferta</h3>
			<p>{{$error}}</p>
		</div>
	@endif
	
	
	@if(!isset($offer))
		<h2>Crear nueva oferta</h2>
		
		<div class="well well-lg">
			{{Form::open(array('url'=>'admin/offers/new','action'=>'POST', 'class'=>'form-horizontal', 'role'=>'form'))}}
				<fieldset>
					
					<div class="control-group">
						<label for="title" class="col-lg-3">Título para la oferta:</label>
						<div class="col-lg-9">
							<input type="text" name="title" class="form-control" value="" required />
							<p class="help-block">Este título le permite usar su propio argumento de venta en el título de la publicación.</p>
						</div>
					</div>
					
					<div style="clear: both;"></div>
					
					<div class="control-group">
						<label for="description" class="col-lg-3">Descripción breve de la oferta:</label>
						<div class="col-lg-9">
							<textarea name="description" class="form-control" required></textarea>
							<p class="help-block">Puede informar sobre detalles de la oferta: descuentos, políticas de envío o algún tipo de incentivo que desee suministrar al 
								comprador o visitante interesado.</p>
						</div>
					</div>
					
					<div style="clear: both;"></div>
					
					<div class="control-group">
						<label for="store_id" class="col-lg-3">Tienda relacionada a la oferta:</label>
						<div class="col-lg-9">
							{{Form::select("store_id",$store_list, array("class"=>"form-control"))}}
						</div>
					</div>
					
					<div style="clear: both;"></div>
					
					<div class="control-group">
						<label for="product_id" class="col-lg-3">Producto:</label>
						<div class="col-lg-9">
							{{Form::select("product_id",$product_list, array("class"=>"form-control"))}}
						</div>
					</div>

					<div style="clear: both;"></div>

					<div class="control-group">
						<label for="country_id" class="col-lg-3">Pais:</label>
						<div class="col-lg-9">
							<select id="country_id" name="country_id">
								@foreach ($countries as $country)
									<option value="{{$country->id}}">
										{{$country->country}}
									</option>
								@endforeach
							</select>
						</div>
					</div>

					<div style="clear: both;"></div>

					<div class="control-group">
						<label for="state_id" class="col-lg-3">Estado:</label>
						<div class="col-lg-9">
							<select id="state_id" name="state_id" style="width: 240px">
								
							</select>
						</div>
					</div>

					<script>
						//Petición via ajax para los estados
						$(document).on('ready', function(){
							$("#country_id").change(function(event) {
								$country_id = $("#country_id").val()
								$.post('{{url("estados")}}', {country: $country_id}, function(data) {
									$('#state_id').html(data)
								});
							});

							$("#country_id").change()
						})
					</script>
					
					<div style="clear: both;"></div>
					
					<div class="control-group">
						<label for="price" class="col-lg-3">Precio:</label>
						<div class="col-lg-9">
							<input type="text" name="price" class="form-control" value="" required />
							<p class="help-block">Indique el precio que tiene el producto en su tienda.</p>
						</div>
					</div>
					
					<div style="clear: both;"></div>
					
					<div class="form-group">
						<label for="active">Campaña activa</label>
						<input type="checkbox" name="active" />
					</div>

					<hr />
					
					<button class="btn btn-default btn-success" type="submit">Guardar</button>
					
				</fieldset>
			{{Form::close()}}
		</div>
	@else
		<h2>Editar la oferta: {{$offer["title"]}}</h2>
		
		<div class="well well-lg">
			{{Form::open(array('url'=>'admin/offers/update/'.$offer["id"],'action'=>'POST', 'class'=>'form-horizontal', 'role'=>'form'))}}
				<fieldset>
					
					<div class="control-group">
						<label for="title" class="col-lg-3">Título para la oferta:</label>
						<div class="col-lg-9">
							<input type="text" name="title" class="form-control" value="{{$offer['title']}}" required />
							<p class="help-block">Este título le permite usar su propio argumento de venta en el título de la publicación.</p>
						</div>
					</div>

					<div class="control-group">
						<label for="country_id" class="col-lg-3">Pais:</label>
						<div class="col-lg-9">
							<select id="country_id" name="country_id">
								@foreach ($countries as $country)
									@if ($offer->state)
										<option value="{{$country->id}}" 

										@if ($offer->state->country_id == $country->id)
											selected="selected"
										@endif>

											{{$country->country}}
										</option>
									@else
										<option value="{{$country->id}}">
											{{$country->country}}
										</option>
									@endif
								@endforeach
							</select>
						</div>
					</div>

					<div style="clear: both;"></div>

					<div class="control-group">
						<label for="state_id" class="col-lg-3">Estado:</label>
						<div class="col-lg-9">
							<select id="state_id" name="state_id" style="width: 240px">
								@if ($states)
									@foreach ($states as $state)
										<option value="{{$state->id}}" @if ($state->id == $offer->state_id)
											selected="selected"
										@endif>{{$state->state}}</option>
									@endforeach
								@endif
							</select>
						</div>
					</div>

					<script>
						//Petición via ajax para los estados
						$(document).on('ready', function(){
							$("#country_id").change(function(event) {
								$country_id = $("#country_id").val()
								$.post('{{url("estados")}}', {country: $country_id}, function(data) {
									$('#state_id').html(data)
								});
							});

							//$("#country_id").change()
						})
					</script>
					
					<div style="clear: both;"></div>
					
					<div class="control-group">
						<label for="description" class="col-lg-3">Descripción breve de la oferta:</label>
						<div class="col-lg-9">
							<textarea name="description" class="form-control" required>{{$offer["description"]}}</textarea>
							<p class="help-block">Puede informar sobre detalles de la oferta: descuentos, políticas de envío o algún tipo de incentivo que desee suministrar al 
								comprador o visitante interesado.</p>
						</div>
					</div>
					
					<div style="clear: both;"></div>
					
					<div class="control-group">
						<label for="price" class="col-lg-3">Precio:</label>
						<div class="col-lg-9">
							<input type="text" name="price" class="form-control" value="{{$offer['price']}}" required />
							<p class="help-block">Indique el precio que tiene el producto en su tienda.</p>
						</div>
					</div>
					
					<div style="clear: both;"></div>
					
					<div class="form-group">
						<label for="active">Campaña activa</label>
						<input type="checkbox" name="active" @if($offer["active"])checked="checked"@endif />
					</div>
					
					<br />
					
					<button class="btn btn-default btn-success" type="submit">Guardar</button>
					
				</fieldset>
			{{Form::close()}}
		</div>
	@endif
	
@stop
