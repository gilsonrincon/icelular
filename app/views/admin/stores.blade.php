@extends('admin.layout')

@section('head')
	<title>Administración de tiendas</title>
@stop

@section('body')
	
	<div class="row">
		<div class="well well-lg" id="option_buttons">
			{{link_to('admin/stores/new','Nuevo',array('class'=>'bt_new'))}}
			{{link_to('#','Eliminar',array('class'=>'bt_remove', 'id'=>'btEliminar'))}}
		</div>
	</div>
	
	@if($stores->count()>0)
		<div class="row">
			<table id="storesList" class="table table-bordered">
				<thead>
					<tr>
						<th>
							{{Form::checkbox('selectall','', false, array('class'=>'chkAll'))}}
						</th>
						<th @if($order_field=="name")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/stores?page='.$page.'&order_field=name&order_dir=desc',"NOMBRE ▼") }}
							@else
								{{ link_to('admin/stores?page='.$page.'&order_field=name&order_dir=asc',"NOMBRE ▲") }}
							@endif
						</th>
						<th @if($order_field=="email")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/stores?page='.$page.'&order_field=email&order_dir=desc',"E-MAIL") }}
							@else
								{{ link_to('admin/stores?page='.$page.'&order_field=email&order_dir=asc',"E-MAIL") }}
							@endif
						</th>
						<th @if($order_field=="url")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/stores?page='.$page.'&order_field=url&order_dir=desc',"URL") }}
							@else
								{{ link_to('admin/stores?page='.$page.'&order_field=url&order_dir=asc',"URL") }}
							@endif
						</th>
						<th @if($order_field=="url")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/stores?page='.$page.'&order_field=clics&order_dir=desc',"CLICS DISPONIBLES") }}
							@else
								{{ link_to('admin/stores?page='.$page.'&order_field=clics&order_dir=asc',"CLICS DISPONIBLES") }}
							@endif
						</th>
						<th>LOGO</th>
					</tr>
				</thead>
				<tbody>
					@foreach($stores as $store)
						<tr>
							<td>{{Form::checkbox('selectall', $store->id, false, array('class'=>'chkItem'))}}</td>
							<td>{{link_to('admin/stores/'.$store->id.'/edit',$store->name)}}</td>
							<td><a href="mailto:{{$store->email}}" target="_blank">{{$store->email}}</a></td>
							<td><a href="{{$store->url}}" target="_blank">{{$store->url}}</a></td>
							<td>{{$store->clics}}</td>
							<td><img style="max-height: 130px;" alt="" class="img-responsive" src="/img/t/{{$store['logo']}}" /></td>
						</tr>
					@endforeach
				</tbody>
			</table>
			
			{{-- paginador de tiendas --}}
			{{ $stores->links() }}
		</div>
		
		<!-- formulario oculto que se ocupa de la eliminación de las tiendas seleccionadas -->
		{{ Form::open(array('url'=>'admin/stores/destroy','id'=>'form_delete', 'style'=>'display:none;')) }}
			{{ Form::hidden('ids','', array('id'=>'ids')) }}
		{{ Form::close() }}
		
		<script type="text/javascript">
			$(document).ready(function(e){
				
				//se examinan todos los checks para ver qué registros se encuentran seleccionados
				$('.chkItem').each(function(e){
					if($(this).context.checked){
						$(this).parent().parent().addClass('selected_row');
					}
				});
				
				//seleccionar todos los elementos
				$('.chkAll').change(function(e){
					if($(this).context.checked){
						$('.chkItem').each(function(e){
							$(this).context.checked=true;
							$(this).change();
						});
					}else{
						$('.chkItem').each(function(e){
							$(this).context.checked=false;
							$(this).change();
						});
					}
				});
				
				//slección individual
				$('.chkItem').change(function(e){
					if($(this).context.checked){
						$(this).parent().parent().addClass('selected_row');
					}else{
						$(this).parent().parent().removeClass('selected_row');
					}
				});
				
				//al enviar el formulario de eliminación
				$('#form_delete').submit(function(e){
					var ids='';
					
					$('.selected_row .chkItem').each(function(e){
						ids+=$(this).val()+',';
					});
					
					$('#ids').val(ids);
					
					return true;
				});
				
				//envía el formulario
				$('#btEliminar').click(function(e){
					if($('.selected_row').length==0){
						alert('No ha seleccionado ninguna tienda.');
						return false;
					}
					if(confirm('¿Realmente desea eliminar las tiendas seleccionadas?')){
						$('#form_delete').submit();
					}
					return false;
				})
			});
		</script>
	@endif
@stop
