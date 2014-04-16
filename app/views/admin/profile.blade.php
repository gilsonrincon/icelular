@extends('admin.layout')

@section("body")
@if(!isset($store))
<h2>Nueva tienda</h2>
@else
<h2>Perfil: {{$store["id"]}} - {{$store["name"]}}</h2>
@endif

@if(isset($store))
{{Form::open(array('url'=>'admin/stores/'.$store->id.'/edit', "files"=>true, 'class'=>'form-horizontal', "id"=>"editStoreForm"))}}
@else
{{Form::open(array('url'=>'admin/stores/new', "files"=>true, 'class'=>'form-horizontal'))}}
@endif
<ul class="nav nav-tabs" id="myTab">
	<li class="active">
		<a href="#tab1" data-toggle="tab">Información general</a>
	</li>
	@if(isset($store))
	<li>
		<a href="#tab2" data-toggle="tab">Direcciones / Puntos de venta</a>
	</li>
	<li>
		<a href="#tab3" data-toggle="tab">Ofertas</a>
	</li>
	@endif
</ul>

<div id="myTabContent" class="tab-content">
	<!-- datos generales del producto -->
	<div id="tab1" class="tab-pane fade active in">
		<h3>Información general</h3>

		<div class="form-group">
			<label class="col-lg-3" for="name">Nombre:</label>
			<div class="col-lg-6">
				@if(isset($store))
				<input class="form-control" type="text" id="name" name="name" placeholder="Nombre de la tienda" value="{{$store['name']}}" />
				@else
				<input class="form-control" type="text" id="name" name="name" placeholder="Nombre de la tienda" value="" />
				@endif
				<p class="help-block">
					Este campo se usa para la etiqueta META TITLE
				</p>
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3" for="short_description">Descripción corta:</label>
			<div class="col-lg-6">
				@if(isset($store))
				<textarea class="form-control" id="short_description" name="short_description" placeholder="Descripción corta">{{$store['short_description']}}</textarea>								
					@else
 				<textarea class="form-control" id="short_description" name="short_description" placeholder="Nombre de la tienda"></textarea>
					@endif


				<p class="help-block">
					Este campo se usa para la etiqueta META DESCRIPTION
				</p>
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3" for="url_seo">URL amigable:</label>
			<div class="col-lg-6">
				@if(isset($store))
				<input class="form-control" type="text" id="url_seo" name="url_seo" value="{{$store['url_seo']}}" />
				@else
				<input class="form-control" type="text" id="url_seo" name="url_seo" value="" />
				@endif
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-12" for="description">Descripción completa:</label>
			<div class="col-lg-12">
				@if(isset($store))
				<textarea class="form-control html_editor" id="description" name="description">{{$store['description']}}</textarea>								
					@else
 				<textarea class="form-control html_editor" id="description" name="description"></textarea>
					@endif


			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3" for="email">Correo electrónico:</label>
			<div class="col-lg-6">
				@if(isset($store))
				<input class="form-control" type="email" id="email" name="email" placeholder="info@ejemplo.com" value="{{$store['email']}}" />
				@else
				<input class="form-control" type="email" id="email" name="email" placeholder="info@ejemplo.com" value="" />
				@endif
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3" for="logo">Logo:</label>
			<div class="col-lg-4">
				<input type="file" name="logo" id="logo" class="form-control" value="" />
			</div>
			<div class="col-lg-5">
				<img class="img-responsive" alt="" src="@if(isset($store))/img/t/{{$store['logo']}}@endif" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3" for="url">Página Web:</label>
			<div class="col-lg-6">
				<input class="form-control" type="url" id="url" name="url" placeholder="www.sutienda.com" value="@if(isset($store)){{$store['url']}}@endif" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3" for="fan_page">Fan page en Facebook:</label>
			<div class="col-lg-6">
				<input class="form-control" type="url" id="fan_page" name="fan_page" placeholder="www.facebook.com/sutienda" value="@if(isset($store)){{$store['fan_page']}}@endif" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3" for="twitter">Usuario en twitter:</label>
			<div class="col-lg-6">
				<input class="form-control" type="text" id="twitter" name="twitter" placeholder="@sutienda" value="@if(isset($store)){{$store['twitter']}}@endif" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3" for="google_plus">Página en Google+:</label>
			<div class="col-lg-6">
				<input class="form-control" type="url" id="google_plus" name="google_plus" placeholder="https://plus.google.com/u/0/111111111111111/" value="@if(isset($store)){{$store['google_plus']}}@endif" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3" for="youtube">Canal en YouTube:</label>
			<div class="col-lg-6">
				<input class="form-control" type="url" id="youtube" name="youtube" placeholder="http://youtube.com/sutienda" value="@if(isset($store)){{$store['youtube']}}@endif" />
			</div>
		</div>
		{{Form::submit("Guardar",array("class"=>"btn btn-default btn-success"))}}
	</div>
	<!-- fin datos generales del producto -->

	<!-- Direcciones / Puntos de venta -->
	<div id="tab2" class="tab-pane fade">
		@if(isset($store))
			<h3>Direcciones</h3>
			<p>
				Esta sección le permite administrar las diferentes direcciones que tenga un determinado comercio; es posible que una tienda puede contar con varias direcciones
				a modo de sucursales o puntos físicos de atención.
			</p>
			<hr/>
			
			<button type="button" class="btn btn-primary" id="btShowDialog">
				Añadir dirección
			</button>
			
			<script type="text/javascript">
				$(document).ready(function(e){
					$('#btShowDialog').click(function(e){
						$('#myModal input[type=text]').each(function(e){
							$(this).val('');
						});
						
						$('#myModal').modal('show');
						
						return false;
					});
				});
			</script>
			
			<hr/>
			
			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">Añadir / Editar dirección</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-lg-12">
									<label class="col-lg-12" for="name_address">Nombre de la dirección:</label>
									<div class="col-lg-12">
										<input type="text" id="name_address" name="name_address" value="" class="form-control"/>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-lg-6">
									<label for="country" class="col-lg-12">País:</label>
									<div class="col-lg-12">
										<select id="country" name="country" class="form-control">
											@foreach(Country::all() as $country)
											<option value="{{$country['id']}}">{{$country["country"]}}</option>
											@endforeach
										</select>
									</div>
								</div>
		
								<div class="col-lg-6">
									<label class="col-lg-12" for="state">Estado / departamento:</label>
									<div class="col-lg-12">
										<select id="state" name="state" class="form-control"></select>
									</div>
								</div>
							</div>
							<script type="text/javascript">
								$(document).ready(function(e) {
									$('#country').change();
									$('#country').change(function(e) {
										getStates();
									});
	
								});
								getStates();
	
								function getStates() {
									$.get('/utils/get_states_ops/' + $('#country').val(), function(data) {
										$('#state').html(data);
									});
								}
							</script>
	
							<div class="form-group">
								<div class="col-lg-6">
									<label for="city" class="col-lg-12">Ciudad:</label>
									<div class="col-lg-12">
										<input type="text" class="form-control" id="city" name="city" value=""/>
									</div>
								</div>
								
								<div class="col-lg-6">
									<label for="phone" class="col-lg-12">Teléfono:</label>
									<div class="col-lg-12">
										<input type="text" class="form-control" name="phone" id="phone" value=""/>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-lg-12" for="address">Dirección postal:</label>
								<div class="col-lg-12">
									<input type="text" class="form-control" id="address" name="address" value=""/>
								</div>
							</div>
							
							<div class="form-group">
								<label for="coords_gmaps" class="col-lg-12">Url de Google Maps:</label>
								<div class="col-lg-12">
									<input type="url" class="form-control" name="coords_gmaps" id="coords_gmaps" value="" />
								</div>
							</div>
							
							<input type="hidden" name="id_address" id="id_address" value="0" />
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">
								Cerrar
							</button>
							<button type="button" id="btSaveAddress" class="btn btn-primary">
								Guardar
							</button>
						</div>
						
						<script type="text/javascript">
							$(document).ready(function(e){
								//guardar una dirección
								$('#btSaveAddress').click(function(e){
									//si el campo id_address está vacío se crea un dirección nueva, de lo contrario se procede a realizar una actualización
									if($('#id_address').val()==0){
										//se crea una nueva dirección
										$.ajax({
											url:'/admin/stores/{{$store["id"]}}/address/add',
											data:{
												name_address:	$('#name_address').val(),
												country:			$('#country').val(),
												state:				$('#state').val(),
												city:					$('#city').val(),
												address:			$('#address').val(),
												phone:				$('#phone').val(),
												coords_gmaps:	$('#coords_gmaps').val()
											},
											cache:false,
											type:"post",
											dataType:"html",
											
											success:function(data){
												loadAddresses();
												$('#myModal').modal('hide');
												$('#id_address').val('0');
											},
											
											error:function(jqXHR,textStatus,errorThrown){
												alert(jqXHR+' - '+textStatus+' - '+errorThrown);
												console.log(jqXHR);
											}
										});
									}else{
										//se actualiza una nueva dirección
										$.ajax({
											url:'/admin/stores/address/update',
											data:{
												id:						$('#id_address').val(),
												name_address:	$('#name_address').val(),
												country:			$('#country').val(),
												state:				$('#state').val(),
												city:					$('#city').val(),
												address:			$('#address').val(),
												phone:				$('#phone').val(),
												coords_gmaps:	$('#coords_gmaps').val()
											},
											cache:false,
											type:"post",
											dataType:"html",
											
											success:function(data){
												loadAddresses();
												$('#myModal').modal('hide');
											},
											
											error:function(jqXHR,textStatus,errorThrown){
												alert(jqXHR+' - '+textStatus+' - '+errorThrown);
												console.log(jqXHR);
											}
										});
									}
									
								});
							});
							
							//carga la lista de direcciones de la tienda actual
							loadAddresses();
							function loadAddresses(){
								$.get('/admin/stores/{{$store["id"]}}/address/list',function(data){
									var html='<table class="table table-bordered"><thead>';
									html+='<tr><th></th><th>NOMBRE</th><th>DIRECCIÓN</th><th>TELÉFONO</th></tr></thead>';
									html+='<tbody>';
									for(i=0;i<data.length;i++){
										html+='<tr>';
										html+='<td style="text-align:center;"><button data-id="'+data[i].id+'" class="btn btDelete btn-default btn-xs btn-danger">x</button></td>';
										html+='<td><a class="btEditAddress" data-id="'+data[i].id+'" href="#">'+data[i].name_address+'</a></td>';
										html+='<td>'+data[i].address+'</td>';
										html+='<td>'+data[i].phone+'</td>';
										html+='</tr>';
									}
									html+='</tbody>';
									$('#addressList').html(html);
									addEventsAddresses()
								});
							}
							
							//asignar eventos a tabla de direcciones generada dinámicamente por la función loadAddresses
							function addEventsAddresses(){
								
								//para editar una dirección
								$('#addressList .btEditAddress').click(function(e){
									var idAddress=$(this).attr('data-id'); 
									$.ajax({
										url:'/admin/stores/address/'+idAddress+'/info',
										type:'get',
										
										success:function(data){
											$('#id_address').val(data[0].id);
											$('#name_address').val(data[0].name_address);
											$('#country').val(data[0].country);
											$('#state').val(data[0].state);
											$('#city').val(data[0].city);
											$('#address').val(data[0].address);
											$('#phone').val(data[0].phone);
											$('#coords_gmaps').val(data[0].coords_gmaps);
											
											$('#myModal').modal('show');
										},
											
										error:function(jqXHR,textStatus,errorThrown){
											alert(jqXHR+' - '+textStatus+' - '+errorThrown);
											console.log(jqXHR);
										}
									});
									return false;
								});
								
								//clic para eliminar una dirección
								$('#addressList .btDelete').click(function(e){
									if(confirm('¿Realmente desea eliminar la dirección indicada?')){
										var idAddress=$(this).attr('data-id');
										$.ajax({
											data:{id:idAddress},
											url:'/admin/stores/address/delete',
											cache:false,
											type:'post',
											dataType:'html',
											
											success:function(data){
												loadAddresses();
											},
											
											error:function(jqXHR,textStatus,errorThrown){
												alert(jqXHR+' - '+textStatus+' - '+errorThrown);
												console.log(jqXHR);
											}
										});
									}
									return false;
								});
							}
						</script>
						
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<div id="addressList"></div>
		@endif
	</div>
	<!-- Fin Direcciones / Puntos de venta -->

	<div id="tab3" class="tab-pane fade active in">
		<table class="table">
			<tr>
				<th>Producto</th>
				<th>Precio</th>
				<th></th>
			</tr>
			@foreach ($store->getOffers as $offer)
				<tr>
					<td>{{$offer->product->name}}</td>
					<td>{{$offer->price}}</td>
					<td>
						{{link_to('admin/profile/offer/'.$offer->id.'/edit', 'Editar', array('class'=>'delete btn btn-info'))}}
						{{link_to('admin/profile/offer/'.$offer->id.'/delete', 'Borrar', array('class'=>'delete btn btn-danger'))}}
					</td>
				</tr>
			@endforeach
		</table>
	</div>
</div>

{{Form::close()}}
@stop

