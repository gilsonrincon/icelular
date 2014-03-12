@extends("admin.layout")

@section("head")
	<title>Gestión de banners</title>
@stop

@section("body")
	@if(!isset($banner))
		<h2>Nuevo banner</h2>
	@else
		<h2>Editar banner: {{$banner["id"]}} - {{$banner["title"]}}</h2>
	@endif
	
	@if(isset($banner))
		{{Form::open(array('url'=>'admin/banners/update/'.$banner->id, "files"=>true, 'class'=>'form-horizontal', "id"=>"editBannerForm"))}}
	@else
		{{Form::open(array('url'=>'admin/banners/new', "files"=>true, 'class'=>'form-horizontal'))}}
	@endif
	<div class="well well-lg">
		<fieldset>
			
			<div class="form-group">
				<label for="name" class="col-lg-4">Título:</label>
				<div class="col-lg-8">
					<input type="text" name="name" class="form-control" value="@if(isset($banner)){{$banner['name']}}@endif" required />
					<p class="help-block">Este valor se usará para las etiquetas alt y title de la imagen.</p>
				</div>
			</div>
			
			<div class="form-group">
				<label for="hook_id" class="col-lg-4">Posición del banner:</label>
				<div class="col-lg-8">
					@if(isset($banner))
						{{Form::select("hook_id",$hooks,$banner["hook_id"])}}
					@else
						{{Form::select("hook_id",$hooks)}}
					@endif
					<p class="help-block">Indica la posición del sitio en el que se ubicará el banner.</p>
				</div>
			</div>
			
			<div class="form-group">
				<label for="image" class="col-lg-4">Imagen:</label>
				<div class="col-lg-8">
					<input type="file" name="image" class="form-control" value="" />
					<p class="help-block">La imaen será usada únicamente si se no se especifica ningún valor en el camó código.</p>
				</div>
				<div class="col-lg-8" style="max-width: 300px;">
					@if(isset($banner))
						<img alt="" class="img-responsive" src="/img/b/{{$banner['image']}}" />
					@endif
				</div>
			</div>
			
			<div class="form-group">
				<label for="url_click" class="col-lg-4">Url para el enlace:</label>
				<div class="col-lg-8">
					<input type="url" name="url_click" class="form-control" value="@if(isset($banner)){{$banner['url_click']}}@endif" />
					<p class="help-block">Esta es la dirección URL hacia donde se dirigirá el usuario que haga clic en un banner di imagen; si el campo código contiene algún valor, 
						entonces esta URL no se utilizará.</p>
				</div>
			</div>
			
			<div class="form-group">
				<label for="code" class="col-lg-4">Código:</label>
				<div class="col-lg-8">
					<textarea class="form-control" name="code">@if(isset($banner)){{$banner["code"]}}@endif</textarea>
				</div>
			</div>
			
			<hr />
			
			<button type="submit" class="btn btn-default btn-success">Guardar</button>
		</fieldset>
	</div>
	{{Form::close()}}
@stop






























