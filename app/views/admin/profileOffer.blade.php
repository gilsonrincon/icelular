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
			{{Form::open(array('url'=>'admin/profile/offer/store','action'=>'POST', 'class'=>'form-horizontal', 'role'=>'form'))}}
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
			{{Form::open(array('url'=>'admin/profile/offer/update/'.$offer["id"],'action'=>'POST', 'class'=>'form-horizontal', 'role'=>'form'))}}
				<fieldset>
					
					<div class="control-group">
						<label for="title" class="col-lg-3">Título para la oferta:</label>
						<div class="col-lg-9">
							<input type="text" name="title" class="form-control" value="{{$offer['title']}}" required />
							<p class="help-block">Este título le permite usar su propio argumento de venta en el título de la publicación.</p>
						</div>
					</div>
					
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
