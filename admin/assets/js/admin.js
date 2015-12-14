jQuery(function($){

	/*$(".principal").on('click', function( event ){
		$('.collapse').slideUp('slow');
		$(this).next('.collapse').slideDown('slow');
	});*/

	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////

	// Abre fecha menu lateral conforme a sessão do sistema
	function abrefechamenu(){
		var url      	= window.location.pathname;
		var arr 		= url.split('/')[2];
		var newarr 		= 'm_'+arr;

		if(newarr != ''){
			$('.principal').next('div').removeClass('collapse').css('display', 'none');
			$('#'+newarr).next('div').slideDown('fast');
		}	
	}
	abrefechamenu();

	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////

	$('#upusuario').on('submit', function(){

		formulario  = $(this).serialize();

	    $.ajax({
	       url : 'http://dent.axitech.com.br/admin/configs/configs.php',
	       type : 'POST',
	       dataType : 'html',
	       data : formulario,
	       success : function(data){
	       		$('#msg').append(data);
	       		$('.msg').removeClass('hidden');
	       },
	       error : function(data){
				window.location = 'admin/usuarios/index';
	       }

	    });

	    return false;

	});

	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////

	$("#respondercontato").on('submit', function(){

		formulario	= $(this).serialize();
		assunto 	= this.assunto.value;
		mensagem 	= this.mensagem.value;
		id_resposta = this.id.value;
		nome 		= this.nome.value;
		email 		= this.email.value;

		if((assunto && mensagem) != ""){

		    $.ajax({
		       url : 'http://dent.axitech.com.br/admin/configs/configs.php',
		       type : 'POST',
		       dataType : 'html',
		       data : formulario,
		       success : function(data){
		       		$('#msg').append(data);
		       		$('.msg').removeClass('hidden');
		       },
		       error : function(data){
					window.location = 'admin/contatos/index';
		       }

		    });	

		} else {
			alert('Todos os campos precisam ser preenchidos.');
			return false;
		}

		return false;

	});

	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////

	$("#cad_deps").on('submit', function(){

		formulario = $(this).serialize();
		nome = this.nome.value;
		email = this.email.value;
		profissao = this.profissao.value;
		idade = this.idade.value;
		depoimento = this.depoimento.value;

		if((nome && email && profissao && idade && depoimento) != ''){

		    $.ajax({
		       url : 'http://dent.axitech.com.br/admin/configs/configs.php',
		       type : 'POST',
		       dataType : 'html',
		       data : formulario,
		       success : function(data){
		       		$('#msg').append(data);
		       		$('.msg').removeClass('hidden');
		       },
		       error : function(data){
					window.location = 'admin/depoimentos/index';
		       }

		    });

		    return false;

		} else {
			alert('Todos os campos precisam ser preenchidos.');
			return false;
		}

		return false;

	});

	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////

	$("#update_deps").on('submit', function(){

		formulario = $(this).serialize();
		nome = this.nome.value;
		email = this.email.value;
		profissao = this.profissao.value;
		idade = this.idade.value;
		depoimento = this.depoimento.value;

		if((nome && email && profissao && idade && depoimento) != ''){

		    $.ajax({
		       url : 'http://dent.axitech.com.br/admin/configs/configs.php',
		       type : 'POST',
		       dataType : 'html',
		       data : formulario,
		       success : function(data){
		       		$('#msg').append(data);
		       		$('.msg').removeClass('hidden');
		       },
		       error : function(data){
					window.location = 'admin/depoimentos/index';
		       }

		    });

		    return false;

		} else {
			alert('Todos os campos precisam ser preenchidos.');
			return false;
		}

		return false;

	});

	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////

	$('#inserir_banner').on('submit', function(){

		formulario = $(this).serialize();
		campanha = this.campanha.value;
		destino = this.destino.value;
		status = this.destino.value;
		frase1 = this.frase1.value;
		frase2 = this.frase2.value;

		if((campanha && destino && campanha && frase1 && frase2) != ''){

			// Quando todos os dados foram passados começamos
			// processamento do formulário para cadastrar o banner
			return true;

		} else {

			alert('Ocorreu um erro durante o processamento do formulário.');
			return false;

		}
		return false;

	});

	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////

	$('#inserir_faq').on('submit', function( event ){

		event.preventDefault();
		formulario = $(this).serialize();
		pergunta = this.pergunta.value;
		resposta = this.resposta.value;
		paginas = this.paginas.value;
		status = this.publicado.value;

		if((pergunta && resposta && paginas && status) != ''){

		    $.ajax({
		       url : 'http://dent.axitech.com.br/admin/configs/configs.php',
		       type : 'POST',
		       dataType : 'html',
		       data : formulario,
		       success : function(data){
		       		$('#msg').append(data);
		       		$('.msg').removeClass('hidden');
		       },
		       error : function(data){
					window.location = 'admin/depoimentos/index';
		       }

		    });

		} else {

			console.log('Alguns campos estão vazios.');
			return false;

		}
		return false;

	});

	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////

	$('#atualizar_faq').on('submit', function( event ){

		event.preventDefault();
		formulario = $(this).serialize();
		pergunta = this.pergunta.value;
		resposta = this.resposta.value;
		paginas = this.paginas.value;
		status = this.publicado.value;

		if((pergunta && resposta && paginas && status) != ''){

		    $.ajax({
		       url : 'http://dent.axitech.com.br/admin/configs/configs.php',
		       type : 'POST',
		       dataType : 'html',
		       data : formulario,
		       success : function(data){
		       		$('#msg').append(data);
		       		$('.msg').removeClass('hidden');
		       },
		       error : function(data){
					window.location = 'admin/faqs/index';
		       }

		    });

		} else {

			console.log('Alguns campos estão vazios.');
			return false;

		}
		return false;

	});

	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////

	$("#estados").change(function(){

		formulario = $(this).serialize();
		id_estado = $("#estados option:selected").val();

		if(id_estado != '' && id_estado != null){

		    $.ajax({
		       url : 'http://dent.axitech.com.br/admin/configs/configs.php',
		       type : 'POST',
		       dataType : 'html',
		       data : formulario,
		       success : function(data){
		       		$('#cidades').empty();
		       		$('#cidades').append(data);
		       },
		       error : function(data){
					window.location = 'admin/clinicas/index';
			   }

		    });

		}
		return false;
		
	});

	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////

	// Cadastro das clínicas
	$('#clinicas').on('submit', function(){

		formulario 			= $(this).serialize();
		nome_clinica 		= this.nome_clinica.value;
		end_1 				= this.end_1.value;
		end_2 				= this.end_2.value;
		estados 			= this.estados.value;
		cidades 			= this.cidades.value;
		tel_1 				= this.tel_1.value;
		tel_2 				= this.tel_2.value;
		coordenadas 		= this.coordenadas.value;
		responsavel 		= this.responsavel.value;
		cro 				= this.cro.value;
		info_adicional 		= this.info_adicional.value;
		status 				= this.status.value;

		if((nome_clinica && end_1 && estados && cidades && coordenadas && responsavel && cro) != ''){

		    $.ajax({
		       url : 'http://dent.axitech.com.br/admin/configs/configs.php',
		       type : 'POST',
		       dataType : 'html',
		       data : formulario,
		       success : function(data){
		       		$('#msg').append(data);
		       		$('.msg').removeClass('hidden');
		       		//console.log(data);
		       },
		       error : function(data){
					window.location = 'admin/clinicas/index';
			   }

		    });	

		} else {

			alert("Todos os campos obrigátórios precisam ser preenchidos.");
			return false;

		}
		return false;

	});

	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////

	// Cadastro das clínicas
	$('#atualizar_clinica').on('submit', function(){

		formulario 			= $(this).serialize();
		nome_clinica 		= this.nome_clinica.value;
		end_1 				= this.end_1.value;
		end_2 				= this.end_2.value;
		estados 			= this.estados.value;
		cidades 			= this.cidades.value;
		tel_1 				= this.tel_1.value;
		tel_2 				= this.tel_2.value;
		coordenadas 		= this.coordenadas.value;
		responsavel 		= this.responsavel.value;
		cro 				= this.cro.value;
		info_adicional 		= this.info_adicional.value;
		status 				= this.status.value;

		if((nome_clinica && end_1 && estados && cidades && coordenadas && responsavel && cro) != ''){

		    $.ajax({
		       url : 'http://dent.axitech.com.br/admin/configs/configs.php',
		       type : 'POST',
		       dataType : 'html',
		       data : formulario,
		       success : function(data){
		       		alert('A clínica foi atualizada com sucesso.');
		       		window.location = 'index';
		       },
		       error : function(data){
					window.location = 'index';
			   }

		    });	

		} else {

			alert("Todos os campos obrigátórios precisam ser preenchidos.");
			return false;

		}
		return false;

	});

});