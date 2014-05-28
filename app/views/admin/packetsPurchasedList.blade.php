@extends('admin.layout')

@section('head')
	<title>Administración de paquetes</title>
@stop

@section('body')
	
	@if($packets->count() > 0)
		<div class="row">
			<table id="categorylist" class="table table-bordered">
				<thead>
					<tr>
						<th @if($order_field=="packetage_id")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/packetspurchased?page='.$page.'&order_field=packeage_id&order_dir=desc',"NOMBRE") }}
							@else
								{{ link_to('admin/packetspurchased?page='.$page.'&order_field=packeage_id&order_dir=asc',"NOMBRE") }}
							@endif
						</th>
						<th>
							VALOR
						</th>
						<th @if($order_field=="store_id")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/packetspurchased?page='.$page.'&order_field=store_id&order_dir=desc',"TIENDA") }}
							@else
								{{ link_to('admin/packetspurchased?page='.$page.'&order_field=store_id&order_dir=asc',"TIENDA") }}
							@endif
						</th>
						<th>
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach($packets as $pack)
						<tr>
							<td>{{$pack->packet->name}}</td>
							<td>{{$pack->packet->value}}</td>
							<td>{{link_to('admin/stores/'.$pack->store->id.'/edit', $pack->store->name)}}</td>
							<td>
								{{Form::open(['url'=>'admin/packetspurchased/'.$pack->id.'/approved'])}}
								{{Form::submit('Aprovar', ['class'=>'btn btn-success'])}}
								{{Form::close()}}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			
			{{-- paginador de paquetes --}}
			{{ $packets->links() }}
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
	@else
		<b>No hay paquetes en espera de aprovación.<b>
	@endif
@stop
