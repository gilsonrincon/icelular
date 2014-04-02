@extends('admin.layout')

@section('head')
	<title>Administración de productos</title>
@stop

@section('body')
	
	<div class="row">
		<div class="well well-lg" id="option_buttons">
			{{link_to('admin/products/new','Nuevo',array('class'=>'bt_new'))}}
			{{link_to('#','Eliminar',array('class'=>'bt_remove', 'id'=>'btEliminar'))}}
		</div>
	</div>
	
	@if($products->count()>0)
		<div class="row">
			<table id="productsList" class="table table-bordered">
				<thead>
					<tr>
						<th>
							{{Form::checkbox('selectall','', false, array('class'=>'chkAll'))}}
						</th>
						<th @if($order_field=="position")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/products?page='.$page.'&order_field=position&order_dir=desc',"# ▼", array('title'=>'Posición del producto', 'class'=>'tip')) }}
							@else
								{{ link_to('admin/products?page='.$page.'&order_field=position&order_dir=asc',"# ▲", array('title'=>'Posición del producto', 'class'=>'tip')) }}
							@endif
						</th>
						<th @if($order_field=="name")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/products?page='.$page.'&order_field=name&order_dir=desc',"NOMBRE") }}
							@else
								{{ link_to('admin/products?page='.$page.'&order_field=name&order_dir=asc',"NOMBRE") }}
							@endif
						</th>
						<th>IMAGEN PRINCIPAL</th>
					</tr>
				</thead>
				<tbody>
					@foreach($products as $product)
						<tr>
							<td>{{Form::checkbox('selectall', $product->id, false, array('class'=>'chkItem'))}}</td>
							<td>{{$product->position}}</td>
							<td>{{link_to('admin/products/'.$product->id.'/edit',$product->name)}}</td>
							<td>
								@if(ProductImage::where('product_id','=',$product['id'])->count()>0)
									<img style="max-height: 150px;" alt="" class="img-responsive" src="/img/p/{{ProductImage::where('product_id','=',$product['id'])->first()->image}}" />
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			
			{{-- paginador de productos --}}
			{{ $products->links() }}
		</div>
		
		<!-- formulario oculto que se ocupa de la eliminación de los productos seleccionadas -->
		{{ Form::open(array('url'=>'admin/products/destroy','id'=>'form_delete', 'style'=>'display:none;')) }}
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
						alert('No ha seleccionado ninguna producto.');
						return false;
					}
					if(confirm('¿Realmente desea eliminar los productos seleccionadas?')){
						$('#form_delete').submit();
					}
					return false;
				})
			});
		</script>
	@endif
@stop
