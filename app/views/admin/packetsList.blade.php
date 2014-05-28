@extends('admin.layout')

@section('head')
	<title>Administración de paquetes</title>
@stop

@section('body')
	
	<div class="row">
		<div class="well well-lg" id="option_buttons">
			{{link_to('admin/packets/new','Nuevo',array('class'=>'bt_new'))}}
			<!--{{link_to('#','Eliminar',array('class'=>'bt_remove', 'id'=>'btEliminar'))}}-->
		</div>
	</div>
	
	@if($packeages->count() > 0)
		<div class="row">
			<table id="categorylist" class="table table-bordered">
				<thead>
					<tr>
						<th>
							{{Form::checkbox('selectall','', false, array('class'=>'chkAll'))}}
						</th>
						<th @if($order_field=="name")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/packeages?page='.$page.'&order_field=name&order_dir=desc',"NOMBRE") }}
							@else
								{{ link_to('admin/packeages?page='.$page.'&order_field=name&order_dir=asc',"NOMBRE") }}
							@endif
						</th>
						<th @if($order_field=="value")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/packeages?page='.$page.'&order_field=value&order_dir=desc',"VALOR") }}
							@else
								{{ link_to('admin/packeages?page='.$page.'&order_field=value&order_dir=asc',"VALOR") }}
							@endif
						</th>
						<th @if($order_field=="clicks")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/packeages?page='.$page.'&order_field=clicks&order_dir=desc',"CLICKS") }}
							@else
								{{ link_to('admin/packeages?page='.$page.'&order_field=clicks&order_dir=asc',"CLICKS") }}
							@endif
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach($packeages as $pack)
						<tr>
							<td>{{Form::checkbox('selectall', $pack->id, false, array('class'=>'chkItem'))}}</td>
							<td>{{$pack->name}}</td>
							<td>{{$pack->value}}</td>
							<td>{{$pack->clicks}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			
			{{-- paginador de paquetes --}}
			{{ $packeages->links() }}
		</div>
		
		<!-- formulario oculto que se ocupa de la eliminación de los paquetes -->
		{{ Form::open(array('url'=>'admin/packeages/destroy','id'=>'form_delete', 'style'=>'display:none;')) }}
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
						alert('No ha seleccionado ningun paquete.');
						return false;
					}
					if(confirm('¿Realmente desea eliminar los paquetes seleccionados?')){
						$('#form_delete').submit();
					}
					return false;
				})
			});
		</script>
	@endif
@stop
