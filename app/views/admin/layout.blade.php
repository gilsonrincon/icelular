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
									<li id="cms">
										{{ link_to("admin/cms","Contenido del sitio (CMS)")}}
									</li>
								</ul>
							</li>
						</ul>
					</nav>
					<article id="contenido" class="col-xs-8 col-sm-9 col-md-9 col-lg-9">@yield('body')</article>
				@else
					<article id="contenido" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">@yield('body')</article>
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

