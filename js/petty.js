function ajaxEmail(postId) {
	jQuery.post(
		ajaxurl, 
		{
		    'action': 'enviar_email',
		    'postId': postId
		}, 
		function(response){
			console.log(response);
			response = JSON.parse(response);
			if(response.envio === true)
			{
				alert('Email enviado com sucesso para '+response.email+'!');	
				window.location = window.location;
			}
			
			console.log(response.email);
			
		}
	);
}



function confirmaEnvio(postId)
{
	var enviar = confirm("Deseja mesmo enviar o email?");	

	if(enviar === true) {
 		ajaxEmail(postId);
	}
}