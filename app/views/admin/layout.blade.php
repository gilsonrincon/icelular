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
			<title>PANEL DE ADMINISTRACIÓN</title>
		@show
		
		<!-- add CSS files -->
		{{ HTML::style('bootstrap/css/bootstrap.css') }}
		{{ HTML::style('css/admin.css') }}
		
		<!-- add JS files -->
		{{ HTML::script("js/jquery-1.10.2.min.js") }}
		{{ HTML::script("bootstrap/js/bootstrap.min.js") }}
		{{ HTML::script("js/admin.js") }}
		{{ HTML::script("ckeditor/ckeditor.js") }}
		{{ HTML::script("ckeditor/adapters/jquery.js") }}
		
		<script type="text/javascript">
			$(document).ready(function(e){
				$('.html_editor').ckeditor();
			});
		</script>
	</head>

	<body>
		<section class="container">
			<header class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h1>PANEL ADMINISTRATIVO DEL PORTAL ICELULAR.COM</h1>
				</div>
			</header>
			<nav id="topMenu">
				{{link_to("/","Ver sitio")}}
				<span> - </span>
				{{Form::open(array("url"=>"logout"))}}
					<button type="submit" class="btn btn-link">Salir</button>
					<input type="hidden" value="0" name="logout" />
				{{Form::close()}}
			</nav>	
			<section id="izquierda" class="row">
				@if(!isset($hide_menu))
					<?php if(Auth::user()->user_type == 1): ?>
					<nav id="menu_lateral" class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
						<ul class="nav nav-pills nav-stacked">
							<li class="nav_header">
								<a>CATÁLOGO</a>
								<ul class="nav nav-pills nav-stacked">
									<li id="products">
										{{ link_to('admin/products',"Productos")}}
									</li>
									<li id="categories">
										{{ link_to('admin/categories','Categorías') }}
									</li>
									<li id="attributes">
										{{ link_to('admin/attributes','Atributos') }}
									</li>
								</ul>
							</li>
							<li class="nav_header">
								<a>COMERCIOS</a>
								<ul class="nav nav-pills nav-stacked">
									<li id="stores">
										{{ link_to("admin/stores","Tiendas")}}
									</li>
									<li id="availableclicks">
										{{ link_to('admin/availableclicks', 'Clics Disponibles')}}
									</li>
									<li id="reportclicks">
										{{ link_to('admin/reportclicks', 'Reportes de clics')}}
									</li>
									<li id="reviews">
										{{link_to('admin/calificaciones', 'Calificaciones de ofertas')}}
									</li>
									<li id="complaints">
										{{link_to('admin/quejas', 'Quejas de calificaciones')}}
									</li>
									<li id="packeages">
										{{link_to('admin/packeages', 'Paquetes')}}
									</li>
								</ul>
							</li>
							<li class="nav_header">
								<a>OFERTAS / PUBLICACIONES</a>
								<ul class="nav nav-pills nav-stacked">
									<li id="offers">
										{{link_to("admin/offers","Todas las ofertas")}}
									</li>
								</ul>
							</li>
							<li class="nav_header">
								<a>MAS OPCIONES...</a>
								<ul class="nav nav-pills nav-stacked">
									<li id="banners">
										{{ link_to("admin/banners","Administrar Banners")}}
									</li>
									<li id="users">
										{{ link_to("admin/users","Usuarios")}}
									</li>
									<li id="cms">
										{{ link_to("admin/cms","Contenido del sitio (CMS)")}}
									</li>
									<li id="countries">
										{{ link_to("admin/countries","Paises")}}
									</li>
									<?php if(Auth::user()->store): ?>
										<li id="profile">
											{{ link_to("admin/profile", 'Perfil')}}
										</li>
									<?php endif; ?>
								</ul>
							</li>
						</ul>
					</nav>
					<?php endif; ?>
					<article id="contenido" class="col-xs-8 col-sm-9 col-md-9 col-lg-9">
						@if(isset($page_name))
							@if ($page_name == 'stores')
								<div class="searchContainer">
									{{Form::open(array('method'=>'GET', 'id'=>'search-form'))}}
										{{Form::text('search', '', array('placeholder'=>'Buscar', 'class'=>'form-control'))}}
										<span id="search" class="glyphicon glyphicon-search">&nbsp;</span>
									{{Form::close()}}
								</div>
								<br><br>
								<script>
									$('#search').click(function(event) {
										$("#search-form").submit();
									});
								</script>
							@endif
						@endif
						@yield('body')</article>
				@else
					<article id="contenido" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						@if(isset($page_name))
							
						@endif
						@yield('body')</article>
				@endif
			</section>
			
			<footer class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<p>icelular 2014 ©copyright  all rights reserved</p>
					<p>Desarrollado por <a href="http://swm.com.co" target="_blank">STUDIOWEB & MARKETING</a></p>
				</div>
			</footer>
		</section>

		<script type="text/javascript">
			$(document).ready(function(){
				//añade tooltips
				$('.tip').tooltip();
				
				@if(isset($page_name))
					//asigna la clase active al item de menú correspondiente si existe una variable que lo indique
					$('#{{$page_name}}').addClass('active');
				@endif
			});
		</script>
	</body>
</html>

