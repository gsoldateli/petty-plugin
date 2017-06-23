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
				sweetAlert(
					{
						title: 'Sucesso!',
						text: 'Email enviado com sucesso para '+response.email+'!', 
						type: 'success'
					},
					function(){window.location = window.location;});	
			}
			else {
				sweetAlert(
					{
						title:'Oopss...',
						text: 'Problemas ao enviar e-mail para '+response.email+'!', 
						type: 'error'
					}, 
					function(){window.location = window.location;});	
			}

			console.log(response);
		}
	);
}



function confirmaEnvio(postId)
{

	swal({
	  title: "Deseja mesmo enviar o e-mail?",
	  text: "Clique em OK para enviar o e-mail.",
	  type: "info",
	  showCancelButton: true,
	  closeOnConfirm: false,
	  showLoaderOnConfirm: true,
	},
	function(){
	    ajaxEmail(postId);
	});
}