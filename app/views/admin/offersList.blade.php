@extends("admin.layout")

@section("head")
	<title>Todas las ofertas</title>
@stop

@section("body")
	<h2>Lista de todas las ofertas</h2>
	
	<div class="row">
		<div class="well well-lg" id="option_buttons">
			{{link_to('admin/offers/new','Nuevo',array('class'=>'bt_new'))}}
			{{link_to('#','Eliminar',array('class'=>'bt_remove', 'id'=>'btEliminar'))}}
		</div>
	</div>
	
	@if($offers->count()>0)
		<div class="row">
			<table id="offerlist" class="table table-bordered">
				<thead>
					<tr>
						<th>
							{{Form::checkbox('selectall','', false, array('class'=>'chkAll'))}}
						</th>
						<th>
							PRODUCTO
						</th>
						<th>
							TÍTULO
						</th>
						<th>
							TIENDA
						</th>
						<td>
							PRECIO
						</td>
						<th>
							CLICS
						</th>
						<th>
							IMPRESIONES
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach($offers as $offer)
						<tr>
							<td>{{Form::checkbox('selectall', $offer->id, false, array('class'=>'chkItem'))}}</td>
							<td>{{link_to("admin/offers/update/".$offer["id"],Product::find($offer['product_id'])->name)}}</td>
							<td>{{link_to("admin/offers/update/".$offer["id"],$offer["title"]) }}</td>
							<td>{{link_to("admin/offers/update/".$offer["id"],Store::find($offer['store_id'])->name)}}</td>
							<td>${{$offer["price"]}}</td>
							<td>{{OfferClick::where("offer_id","=",$offer["id"])->count()}}</td>
							<td>{{OfferHit::where("offer_id","=",$offer["id"])->count()}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		
		{{$offers->links()}}
		
		<!-- formulario oculto que se ocupa de la eliminación de las categorías seleccionadas -->
		{{ Form::open(array('url'=>'admin/offers/destroy','id'=>'form_delete', 'style'=>'display:none;')) }}
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
					if(confirm('¿Realmente desea eliminar las ofertas seleccionadas?')){
						$('#form_delete').submit();
					}
					return false;
				})
			});
		</script>
	@endif
@stop
