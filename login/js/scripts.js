jQuery(function($){

	// Fazendo verificação e enviando os dados
	$('#form_signin').on('submit', function( event ){

		event.preventDefault();

		// Fazendo algumas verificações antes de enviar
		username 	= $('#usernick').val();
		password 	= $('#passnick').val();
		dados 		= $(this).serialize();
		msg			= '<div class="msg alert alert-danger alert-dismissible hidden" role="alert">';
		msg			+= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		msg			+= '<strong>Atenção! </strong>Todos os campos precisam ser preenchidos.';
		msg			+= '</div>';

		// Verificando se todos os dados foram inseridos
		if((username == '' || username == null) || 
		   (password == '' || password == null)){
		   	$('#msg').empty();
			$('#msg').append(msg);
			$('.msg').removeClass('hidden').fadeOut(3500, "linear");

		} else {

    		// Os dados foram verificados e vamos proceder ao login
		    $.ajax({
		       url : 'login/restrito.php',
		       type : 'POST',
		       dataType : 'html',
		       data : dados,
		       success : function(data){
		       		$('#msg').append(data);
		       		$('.msg').removeClass('hidden').fadeOut(3500, "linear");
		       },
		       error : function(data){
					window.location = 'admin/home/index';
		       }

		    });

			return false;

		}

	});

	// Formulário para solicitar a senha perdida
	$('#form_lost').on('submit', function(){

		formulario 	= $(this).serialize();
		campo 		= $('#emaillost').val();

		if(campo == '' || campo == null){

			alert('Preencha o campo de e-mail para receber a nova senha.');
			return false;

		} else {

		    $.ajax({
		       url : 'http://dent.axitech.com.br/admin/configs/ajax.functions.php',
		       type : 'POST',
		       dataType : 'html',
		       data : formulario,
		       success : function(data){
		       		$('#msg').append(data);
		       		$('.msg').removeClass('hidden');
		       },
		       error : function(data){
					window.location = 'login.php';
		       }

		    });	

		    return false;

		}

	});

	// Formulário para redefinir a senha e entrar no sistema
	$('#form_senhaperdida').on('submit', function(){

		formulario 	= $(this).serialize();
		senha 		= $('#l_pass').val(); 
		csenha 		= $('#lc_pass').val(); 

		if(senha == '' || csenha == ''){

			alert('Preencha todos os campos obrigatórios');
			return false;

		} else if (senha != csenha){

			alert('As senhas não podem ser diferentes. Digite senhas iguais.');
			return false;

		} else {

			// Passamos para a função no arquivo de funções PHP
			// que vai processar o pedido de redefinição de senha

		    $.ajax({
		       url : 'http://dent.axitech.com.br/admin/configs/ajax.functions.php',
		       type : 'POST',
		       dataType : 'html',
		       data : formulario,
		       success : function(data){
		       		$('#msglost').append(data);
		       		$('.msg').removeClass('hidden');
		       		// console.log(data);
		       },
		       error : function(data){
					window.location = 'admin/usuarios/index';
		       }

		    });

		    return false;

		}

		return false;

	});

});