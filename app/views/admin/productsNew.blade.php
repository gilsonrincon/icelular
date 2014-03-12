@extends('admin.layout')

@section("body")
	@if(!isset($product))
		<h2>Nuevo producto</h2>
	@else
		<h2>Editando producto: {{$product["id"]}} - {{$product["name"]}}</h2>
	@endif
	
	@if(isset($product))
		{{Form::open(array('url'=>'admin/products/'.$product->id.'/edit', 'action'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', "id"=>"editProductForm"))}}
	@else
		{{Form::open(array('url'=>'admin/products/new', 'action'=>'POST', 'class'=>'form-horizontal', 'role'=>'form'))}}
	@endif
	<ul class="nav nav-tabs" id="myTab">
		<li class="active"><a href="#tab1" data-toggle="tab">Información general</a></li>
		@if(isset($product))
			<li><a href="#tab2" data-toggle="tab">Etiquetas (tags)</a></li>
			<li><a href="#tab3" data-toggle="tab">Categorías</a></li>
			<li><a href="#tab4" data-toggle="tab">Imágenes</a></li>
			<li><a href="#tab5" data-toggle="tab">Atributos</a></li>
			<li><a href="#tab6" data-toggle="tab">Video YouTube</a></li>
		@endif
	</ul>
	
	<div id="myTabContent" class="tab-content">
		<!-- datos generales del producto -->
		<div id="tab1" class="tab-pane fade active in">
			<h3>Información general</h3>
			
			<div class="form-group">
				{{Form::label('name','Nombre:',array('class'=>'col-lg-4'))}}
				<div class="col-lg-8">
					@if(isset($product))
						{{Form::text("name",$product["name"],array("class"=>"form-control"))}}
					@else
						{{Form::text("name","",array("class"=>"form-control"))}}
					@endif
					<p class="help-block">Este valor se usará como etiqueta meta-title, tenga en cuenta las recomendaciones SEO para este valor.</p>
				</div>
			</div>
			
			<div class="form-group">
				{{Form::label('short_description','Descripción corta:',array('class'=>'col-lg-4'))}}
				<div class="col-lg-8">
					@if(isset($product))
						{{Form::textarea("short_description",$product["short_description"],array("class"=>"form-control"))}}
					@else
						{{Form::textarea("short_description","",array("class"=>"form-control"))}}
					@endif
					<p class="help-block">Este valor se usará como etiqueta meta-description, tenga en cuenta las recomendaciones SEO para este valor.</p>
				</div>
			</div>
			
			<div class="form-group">
				{{Form::label('url','URL amigable:',array('class'=>'col-lg-4'))}}
				<div class="col-lg-8">
					<input type="text" name="url" value="@if(isset($product)){{$product['url']}}@endif" class="form-control" />
					<p class="help-block">Indique la cadena de caracteres que identifica al producto en la url.</p>
				</div>
			</div>
			
			<div class="form-group">
				{{Form::label('description','Descripción corta:',array('class'=>'col-lg-12'))}}
				<div class="col-lg-12">
					@if(isset($product))
						{{Form::textarea('description', $product["description"],array('class'=>'html_editor form-control'))}}
					@else
						{{Form::textarea('description', '',array('class'=>'html_editor form-control'))}}
					@endif
				</div>
			</div>
			
			@if(!isset($producto))
				{{Form::hidden("position",Product::max("position")+1)}}
			@else
				{{Form::hidden("position",$product['position'])}}
			@endif
			
		</div>
		<!-- fin datos generales del producto -->

		<!-- etiquetas (tags) -->
		<div id="tab2" class="tab-pane fade">
			@if(isset($product))
				<h3>Etiquetas</h3>
				<p class="lead">
					Una forma útil de agrupar y clasificar artículos es el uso de tags, los cuales son palabras o pequeñas frases que describen y relacionan productos 
					según aspectos generales; esto facilita a los usuarios la navegación por todo el sitio.
				</p>
				<p>Puede ingresar etiquetas nuevas o seleccionar las que previamente han sido usadas y relacionadas con otros productos.</p>
				
				<div class="col-lg-6">
					<div class="form-group">
						{{Form::label("tags","Etiquetas (palabras o frases cortas):",array("class"=>"col-lg-12"))}}
						<div class="col-lg-12">
							{{Form::textarea("tags",$product->getTagsTxt(),array("class"=>"form-control","id"=>"tags"))}}
						</div>
					</div>
				</div>
				
				<div class="col-lg-6">
					<div class="form-group">
						{{Form::label("tagsList","Etiquetas que han sido usadas en el sitio:",array("class"=>"col-lg-12"))}}
						<div class="col-lg-12">
							<ul id="tagList" class="listSelect">
								@foreach(Tag::all() as $tag)
									<li>
										<span>{{$tag['tag']}}</span>
									</li>
								@endforeach
							</ul>
							<script type="text/javascript">
								$(document).ready(function(){
									$('#tagList span').click(function(e){
										$('#tags').val($('#tags').val()+','+$(this).text());
									});
								})
							</script>
						</div>
					</div>
				</div>
				
				<div style="clear:both;"></div>
			@endif
		</div>
		<!-- etiquetas (tags) -->
		
		<!-- categorías -->
		<div id="tab3" class="tab-pane fade">
			@if(isset($product))
				<h3>Categorías</h3>
				<p class="lead">
					Seleccione las categorías a las que pertenece el producto:
				</p>
				
				{{Category::categoryTree(NULL,'categoryTree',true,$product['id'])}}
			@endif
		</div>
		<!-- categorías -->
		
		<!-- imágenes -->
		<div id="tab4" class="tab-pane fade">
			@if(isset($product))
				<h3>Imágenes</h3>
				<p class="lead">
					Administre las imágenes relacionadas a este producto; puede subir o eliminar imágenes desde esta sección:
				</p>
				<div class="form-group">
					<label for="image">Seleccione la imagen:</label>
					<input type="file" id="image" />
					<button type="button" class="btn btn-default btn-primary" onclick="uploadImage();">Subir archivo</button>
					
					<div id="image_list"></div>
					
					<script type="text/javascript">
						function uploadImage(){
							var image=document.getElementById('image');
							
							image=image.files[0];
							
							var data=new FormData();
							
							data.append('image', image);
							data.append('product_id', {{$product['id']}});
							
							$.ajax({
								data: data,
								cache: false,
								url: '/admin/products/addimage',
								type: 'post',
								async: false,
								contentType:false,
								dataType: 'html',
								processData: false,
								
								success: function(data){
									//se llama a la función que carga las imágenes (ajax)
									getProductImages({{$product["id"]}});
								}
							});
							
							return false;
						}
						
						//función que se ocupa de cargar imágenes relacionadas con un producto vía ajax
						function getProductImages(id){
							$.ajax({
								url:'/admin/products/getimages?product_id='+id,
								cache:false,
								type:'get',
								dataType:'html',
								success:function(data){
									console.log(data);
									$('#image_list').html(data);
									addEventsBtDeleteImg();
								}
							})
						}
						
						//añade los eventos js a los elementos de la lista de imágenes
						function addEventsBtDeleteImg(){
							//eliminar una imagen
							$(".brn-delete-img").click(function(e){
								var id=$(this).attr("data-id");
								$.ajax({
									url:"/admin/products/deleteimage",
									data:'id='+id,
									cache:false,
									type:"post",
									dataType:"html",
									success:function(data){
										getProductImages({{$product['id']}});
									}
								});
								
								return false;
							});
						}
						
						//carga las imágenes cuando se carga la página
						$(document).ready(function(e){
							getProductImages({{$product['id']}});
						});
					</script>
				</div>
				
				
			@endif
		</div>
		<!-- fin imágenes -->
		
		<!-- atributos -->
		<div id="tab5" class="tab-pane fade">
			@if(isset($product))
				@foreach($attributesGroups as $group)
					<h4>{{$group["attributes_group"]}}</h4>
					
					@foreach($group->attributes()->get() as $attr)
						<div class="form-group">
							<label class="col-lg-3" for="attr{{$attr['id']}}">{{$attr["attribute"]}}</label>
							<div class="col-lg-6">
								<input type="text" class="attrField form-control" data-attrId="{{$attr['id']}}" value="{{ProductAttribute::getValue($product['id'],$attr['id'])}}" id="attr{{$attr['id']}}" name="attr{{$attr['id']}}" />
							</div>
						</div>
					@endforeach
				@endforeach
				
				<input type="hidden" name="attributes_h" id="attributes_h" value="" />
				
				<script type="text/javascript">
					$(document).ready(function(){
						$('#editProductForm').submit(function(e){
							$('.attrField').each(function(e){
								if($(this).val().length>0)
									$(this).val($(this).val()+'@|@'+$(this).attr('data-attrId'));
							});
							
							return true;
						});
					});
				</script>
			@endif
		</div>
		<!-- fin atributos -->
		
		<!-- Video YouTube -->
		<div id="tab6" class="tab-pane fade">
			@if(isset($product))
				<h4>Video YouTube</h4>
				<div class="form-group">
					<label class="col-lg-3" for="video">URL para compartir:</label>
					<div class="col-lg-6">
						<input type="text" name="video" id="video" value="{{$product['video']}}" class="form-control" />
					</div>
					<hr/>
					<div style="text-align:center;">
						<iframe width="420" height="315" src="//youtube.com/embed/{{$product['video']}}" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
			@endif
		</div>
		<!-- Video YouTube -->
	</div>
	{{Form::submit("Guardar",array("class"=>"btn btn-default btn-success"))}}
	{{Form::close()}}
@stop


























