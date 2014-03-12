@extends('admin.layout')

@section('head')
	<title>Administración de categorías</title>
@stop

@section('body')
	
	<div class="row">
		<div class="well well-lg" id="option_buttons">
			{{link_to('admin/categories/new','Nuevo',array('class'=>'bt_new'))}}
			{{link_to('#','Eliminar',array('class'=>'bt_remove', 'id'=>'btEliminar'))}}
		</div>
	</div>
	
	@if($categories->count()>0)
		<div class="row">
			<table id="categorylist" class="table table-bordered">
				<thead>
					<tr>
						<th>
							{{Form::checkbox('selectall','', false, array('class'=>'chkAll'))}}
						</th>
						<th @if($order_field=="position")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/categories?page='.$page.'&order_field=position&order_dir=desc',"#", array('title'=>'Posición de la categoría', 'class'=>'tip')) }}
							@else
								{{ link_to('admin/categories?page='.$page.'&order_field=position&order_dir=asc',"#", array('title'=>'Posición de la categoría', 'class'=>'tip')) }}
							@endif
						</th>
						<th @if($order_field=="name")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/categories?page='.$page.'&order_field=name&order_dir=desc',"NOMBRE") }}
							@else
								{{ link_to('admin/categories?page='.$page.'&order_field=name&order_dir=asc',"NOMBRE") }}
							@endif
						</th>
						<th @if($order_field=="parent_id")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/categories?page='.$page.'&order_field=parent_id&order_dir=desc',"CATEGORÍA PADRE") }}
							@else
								{{ link_to('admin/categories?page='.$page.'&order_field=parent_id&order_dir=asc',"CATEGORÍA PADRE") }}
							@endif
						</th>
						<th>
							<span class="tip" title="Cantidad de productos asociados a esta categoría"># PRODUCTOS</span>
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach($categories as $cat)
						<tr>
							<td>{{Form::checkbox('selectall', $cat->id, false, array('class'=>'chkItem'))}}</td>
							<td>{{$cat->position}}</td>
							<td>{{link_to('admin/categories/'.$cat->id.'/edit',$cat->name)}}</td>
							<td>
								@if(Category::parentCat($cat))
									{{Category::parentCat($cat)->name}}
								@else
									/
								@endif
							</td>
							<td>{{ProductCategory::countProducts($cat)}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			
			{{-- paginador de categorías --}}
			{{ $categories->links() }}
		</div>
		
		<!-- formulario oculto que se ocupa de la eliminación de las categorías seleccionadas -->
		{{ Form::open(array('url'=>'admin/categories/destroy','id'=>'form_delete', 'style'=>'display:none;')) }}
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
						alert('No ha seleccionado ninguna categoría.');
						return false;
					}
					if(confirm('¿Realmente desea eliminar las categorías seleccionadas?')){
						$('#form_delete').submit();
					}
					return false;
				})
			});
		</script>
	@endif
@stop
