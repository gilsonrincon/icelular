$(document).on('ready', function(){
	$('.btn-submit').click(function(event) {
		//Recuperamos el formulario que se trata de recuperar
		$form = $(this).data('form')
		
		//Si hay un label de aceptar lo regresamos al color negro por si estaba rojo
		$('#' + $form + ' .accept-label').css('color', '#f00')

		//Validamos campos requeridos, que no esten vacios
		$allrequired = true
		$('#' + $form + ' .require').each(function($index, $val) {
			$(this).css('border', '1px solid #000')
			$value = $(this).val()
			if($value == null || $value.length == 0 || /^\s+$/.test($value)){
				$('.validation p').text('El/Los campo/s resaltados son obligatorios.')
				$('.validation').css('visibility', 'visible')
				$(this).css('border', '1px solid #f00')
				$allrequired = false
			}
		})

		//En caso de que los obligatorios no esten correctos detendra el envio del formulario
		if($allrequired == false){
			event.preventDefault()
			return false
		}

		//Validamos campos de solo numeros
		$allnumeric = true
		$('#' + $form + ' .numeric').each(function($index, $val) {
			$(this).css('border', '1px solid #000')
			$value = $(this).val()
			if(isNaN($value) == true){
				$('.validation p').text('El/Los campo/s resaltados debe contener solo numeros.')
				$('.validation').css('visibility', 'visible')
				$(this).css('border', '1px solid #f00')
				$allnumeric = false
			}
		})

		//En caso de que los campos numericos no esten correctos detendra el envio del formulario
		if($allnumeric == false){
			event.preventDefault()
			return false
		}

		//Validamos direcciones de correo (emails)
		$allemail = true
		$('#' + $form + ' .email').each(function($index, $val) {
			$(this).css('border', '1px solid #000')
			$value = $(this).val()
			if( !(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test($value)) ) {
			    $('.validation p').text('La dirección de correo no es valida.')
				$('.validation').css('visibility', 'visible')
				$(this).css('border', '1px solid #f00')
				$allemail = false
			}
		})

		//En caso de que los emails no esten correctos detendra el envio del formulario
		if($allemail == false){
			event.preventDefault()
			return false
		}

		//Validamos checkbox de aceptar
		$accept = true
		$('#' + $form + ' .accept').each(function(index, el) {
			if($(this).is(':checked') == false){
				$('#' + $form + ' .accept-label').css('color', '#f00')
				$accept = false
			}
		})
			
		//En caso de que el checkbox de aceptar no se encuentre checked detiene el envio del formulario
		if($accept == false){
			event.preventDefault()
			return false
		}
	});
})