<?php

	# Configurações
	# Esta separação de 3 linhas apresentada abaixo representa a separação
	# das sessões da área administrativa do site que tem as funcionalidades
	# para cada parte do sistema de backednd e frontend.
	######################################################################  
	######################################################################  
	######################################################################

	# Sessão Usuários
	function addUsuario(){

		global $pdo;

		$nome 			= $_POST['nome'];
		$email 			= $_POST['email'];
		$senha 			= $_POST['senha'];
		$csenha 		= $_POST['csenha'];
		$nivel 			= $_POST['nivel'];
		$status 		= $_POST['status'];

    	$sql          	= "SELECT * FROM tb_usuarios WHERE email = '{$email}'";
    	$query        	= $pdo->query($sql);
    	$contador     	= $query->rowCount($sql);

		if($nome == '' || $nome == null 	||
		   $email == '' || $email == null 	||
		   $senha == '' || $senha == null 	||
		   $csenha == '' || $csenha == null ||
		   $nivel == '' || $nivel == null 	||
		   $status == '' || $status == null
		) { 

			echo '<div class="msg alert alert-danger alert-dismissible hidden" role="alert">';
			echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			echo '<strong>Falha! </strong>Preencha todos os dados obrigatótios.';
			echo '</div>';

		} else if ($senha != $csenha){

			echo '<div class="msg alert alert-danger alert-dismissible hidden" role="alert">';
			echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			echo '<strong>Falha! </strong>As senhas não são iguais. Corrija as senhas.';
			echo '</div>';

		} else if ($contador >= 1) {

			echo '<div class="msg alert alert-danger alert-dismissible hidden" role="alert">';
			echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			echo '<strong>Falha! </strong>Este usuário já existe no banco de dados.';
			echo '</div>';

		} else {

			$nova_senha 	= encrypt_pass($senha);
			$datacad		= date('Y-m-d H:i:s');
        	$sql          	= "INSERT INTO tb_usuarios (nome, email, senha, nivel, status, datacad) VALUES ('$nome', '$email', '$nova_senha', '$nivel', '$status', '$datacad');";
        	$query        	= $pdo->query($sql);

        	if(!$query){

				echo '<div class="msg alert alert-danger alert-dismissible hidden" role="alert">';
				echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
				echo '<strong>Sucesso! </strong>Usuário não foi cadastrado. Tente novamente.';
				echo '</div>';	

        	} else {

		        echo "
		        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
		        	<script type=\"text/javascript\">
		        	alert(\"O usuário foi cadastrado com sucesso.\");
		        	window.location = \"index\";
		        	</script>
		      	";

        	}

		}

	}

	# Atualizando informações cadastrais do usuário
	function updUsuario(){

		global $pdo;

		$id 			= $_POST['updidusuario'];
		$nome 			= $_POST['nome'];
		$email 			= $_POST['email'];
		$nivel 			= $_POST['nivel'];
		$status 		= $_POST['status'];

		if($nome == '' || $nome == null 	||
		   $email == '' || $email == null 	||
		   $nivel == '' || $nivel == null 	||
		   $status == '' || $status == null
		) { 

			echo '<div class="msg alert alert-danger alert-dismissible hidden" role="alert">';
			echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			echo '<strong>Falha! </strong>Preencha todos os dados obrigatótios.';
			echo '</div>';

		} else {

        	$sql	= "UPDATE tb_usuarios SET nome = '$nome', email = '$email', nivel = '$nivel', status = '$status' WHERE ID = '$id'";
        	$query	= $pdo->query($sql);

        	if(!$query){

				echo '<div class="msg alert alert-danger alert-dismissible hidden" role="alert">';
				echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
				echo '<strong>Sucesso! </strong>Usuário não foi atualizado. Tente novamente.';
				echo '</div>';	

        	} else {

		        echo "
		        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
		        	<script type=\"text/javascript\">
		        	alert(\"O usuário foi atualizado com sucesso.\");
		        	window.location = \"index\";
		        	</script>
		      	";

        	}

		}
	}

	# Script de recuperação de senha na página de login
	function recuperarSenha(){

		global $pdo;

		$email 		  	= $_POST['emaillost'];
		$sql          	= "SELECT * FROM tb_usuarios WHERE email = '$email'";
    	$query        	= $pdo->query($sql);
    	$contador     	= $query->rowCount($sql);
    	$resultado 		= $query->fetch(PDO::FETCH_ASSOC);

    	if($contador == 1 && $resultado['status'] == 1){

    		$url_login = url_login();
    		$nova_url_login = substr_replace($url_login, '', -1).'.php';

    		$link_pass 		= geraSenha();
    		$lostsenha		= md5($link_pass);
    		$data_hoje 		= date('Y-m-d H:i:s');
    		$lost          	= "INSERT INTO tb_lostpassword (email, lostpassid, status, data) VALUES ('$email', '$lostsenha', '0', '$data_hoje');";
    		$insert        	= $pdo->query($lost);

    		$nome 			= $resultado['nome'];
    		$subject 		= 'Recuperar senha - Painel Dental Arte';
			$mail       	= new PHPMailer();

			$mail->IsSMTP();

			$mail->SMTPAuth   = true;
			$mail->Host       = "mail.axitech.com.br";
			$mail->Port       = 465;
			$mail->Username   = "contato@axitech.com.br";
			$mail->Password   = "3755d43776";
			$mail->SMTPSecure = 'ssl';
			$mail->SetFrom('contato@axitech.com.br', 'AXITECH Informática');
			$mail->AddReplyTo("contato@axitech.com.br","AXITECH Informática");
			$mail->Subject    = $subject;
			$mail->Body       = "
			<!DOCTYPE html>
			<html lang=\"en\">
			<head>
				<meta charset=\"UTF-8\">
			</head>
			<body>
				<p>Você solicitou recentemente a redefinição de sua senha.</p>	
				<p>Accesse o link a seguir para redefinir a sua senha: <br>
					<a href=".$nova_url_login.'?usuario='.$email.'&senhaperdida='.$lostsenha.">
						<strong>Clique aqui para recuperar sua senha</strong>
					</a>
				</p>
			</body>
			</html>
			";
			
			$mail->IsHTML(true); 
			$mail->AddAddress($email, $nome);

			if(!$mail->Send()) {

		        echo "
		        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/login.php'>
		        	<script type=\"text/javascript\">
		        	alert(\"Erro! Algum problema ocorreu ao tentar enviar a senha para seu e-mail.\");
		        	</script>
		      	";

			} else {

		        echo "
		        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/login.php'>
		        	<script type=\"text/javascript\">
		        	alert(\"A senha foi encaminhada com sucesso para seu e-mail.\");
		        	</script>
		      	";

			}

    	} else {

	        echo "
	        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/login.php'>
	        	<script type=\"text/javascript\">
	        	alert(\"Atenção! Usuário inválido.\");
	        	</script>
	      	";

		}

	}

	# Redefinir a senha perdida na página de login
	function redefinirsenha(){

		global $pdo;

		$l_pass 	= $_POST['l_pass'];
		$lc_pass 	= $_POST['lc_pass'];
		$l_senha 	= $_POST['l_senha'];
		$l_usuario 	= $_POST['l_usuario'];

		$sql          	= "SELECT * FROM tb_lostpassword WHERE lostpassid = '$l_senha' AND email = '$l_usuario'";
    	$query        	= $pdo->query($sql);
    	$contador     	= $query->rowCount();
    	$resultado 		= $query->fetch();

    	if($contador == 1 && $resultado['status'] == 0){
  
  			if($l_pass == $lc_pass)	{

  				$newsenha 	= encrypt_pass($l_pass);
				$sql 		= "UPDATE tb_usuarios SET senha = '$newsenha' WHERE email = '$l_usuario'";
				$status 	= "UPDATE tb_lostpassword SET status = '1' WHERE lostpassid = '$l_senha' AND email = '$l_usuario'";
    			$query		= $pdo->query($sql);
    			$query2		= $pdo->query($status);

    			if(!$query and !$query2){

			        echo "
			        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=login.php'>
			        	<script type=\"text/javascript\">
			        	alert(\"Sua senha não pôde ser redefinida. Tente mais tarde.\");
			        	</script>
			      	";

    			} else {

			        echo "
			        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=login.php'>
			        	<script type=\"text/javascript\">
			        	alert(\"Sucesso! Sua senha foi redefinida com sucesso.\");
			        	window.location = \"index\";
			        	</script>
			      	";

    			}

  			} else {

		        echo "
		        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
		        	<script type=\"text/javascript\">
		        	alert(\"As senhas não podem ser diferentes. Digite senhas iguais.\");
		        	</script>
		      	";	

  			}

    	} else {

	        echo "
	        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/recuperar.php'>
	        	<script type=\"text/javascript\">
	        	alert(\"A redefinição da senha expirou. Solicite novamente uma nova senha.\");
	        	</script>
	      	";

    	}

	}

	######################################################################  
	######################################################################  
	######################################################################

	# Sessão contatos
	# Respondendo os contatos
	function respondercontatos(){

		$assunto 		= $_POST['assunto'];
		$mensagem 		= $_POST['mensagem'];
		$id 			= $_POST['id'];
		$nome 			= $_POST['nome'];
		$email 			= $_POST['email'];

		if(($assunto && $mensagem) != ''){

    		$subject 		  = $assunto;
			$mail       	  = new PHPMailer();

			$mail->IsSMTP();
			$mail->SMTPAuth   = true;
			$mail->Host       = "mail.axitech.com.br";
			$mail->Port       = 465;
			$mail->Username   = "contato@axitech.com.br";
			$mail->Password   = "3755d43776";
			$mail->SMTPSecure = 'ssl';

			$mail->SetFrom('contato@axitech.com.br', 'AXITECH Informática');
			$mail->AddReplyTo("contato@axitech.com.br","AXITECH Informática");

			$mail->Subject    = $subject;
			$mail->Body       = "
			<!DOCTYPE html>
			<html lang=\"en\">
			<head>
				<meta charset=\"UTF-8\">
			</head>
			<body>
				<div style=\"border:1px solid #ccc; width:600px; border-radius:5px; padding:25px; margin:30px auto\">
					<h1 style=\"color:#337AB7\">Dental Arte - Feedback</h1>
					<h2>".$assunto."</h2>
					<p stule=\"text-align:justify\">".$mensagem."</p>
				</div>	
			</body>
			</html>
			";
			$mail->IsHTML(true); 
			$mail->AddAddress($email, $nome);

			if(!$mail->Send()) {

				echo '<div class="msg alert alert-danger alert-dismissible hidden" role="alert">';
				echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
				echo '<strong>Falha! </strong>Erro encontrado no envio da mensagem.';
				echo '</div>';	

			} else {

				if($id != '' && $id != null){

					global $pdo;
					$sql = "UPDATE tb_contatos SET status = '1' WHERE ID = '$id'";
		    		$query = $pdo->query($sql);

				}

		        echo "
		        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
		        	<script type=\"text/javascript\">
		        	alert(\"Sucesso. A mensagem foi enviada com sucesso.\");
			        window.location = \"index\";		        	
		        	</script>
		      	";

			}

		} else {

			echo '<div class="msg alert alert-danger alert-dismissible hidden" role="alert">';
			echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			echo '<strong>Falha! </strong>Erro encontrado no envio da mensagem.';
			echo '</div>';

		}

	}

	######################################################################  
	######################################################################  
	######################################################################

	# Sessão Depoimentos
	# Depoimento - cadastrar
	function cadastar_deps(){

		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$profissao = $_POST['profissao'];
		$idade = $_POST['idade'];
		$depoimento = $_POST['depoimento'];
		$publicado = $_POST['publicado'];
		$acao = $_POST['cad_depoimentos'];

		if(($nome && $email && $profissao && $idade && $depoimento) != ''){

			global $pdo;

			$sql = "INSERT INTO tb_depoimentos VALUES ('', '$nome', '$email', '$profissao', '$idade', '$depoimento', '$publicado', NOW())";
		    $query = $pdo->query($sql);	

		    if(!$query){

		      	echo '<div class="msg alert alert-danger alert-dismissible hidden" role="alert">';
				echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
				echo '<strong>Falha! </strong>Não foi possível inserir o depoimento.';
				echo '</div>';		    

		      } else {

		        echo "
		        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
		        	<script type=\"text/javascript\">
		        	alert(\"Sucesso! O depoimento foi inserido com sucesso.\");
		        	window.location = \"index\";
		        	</script>
		      	";

		    }

		} else {

			echo '<div class="msg alert alert-danger alert-dismissible hidden" role="alert">';
			echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			echo '<strong>Falha! </strong>Preencha todos os campos obrigatórios.';
			echo '</div>';

		}

	}

	# Depoimento - editar, autorizar, atualizar
	function update_deps(){

		$id = $_POST['id_dep'];
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$profissao = $_POST['profissao'];
		$idade = $_POST['idade'];
		$depoimento = $_POST['depoimento'];
		$publicado = $_POST['publicado'];

		if(($nome && $email && $profissao && $idade && $depoimento) != ''){

			global $pdo;

			$sql = "UPDATE tb_depoimentos SET nome = '$nome', email = '$email', profissao = '$profissao', idade = '$idade', depoimento = '$depoimento', status = '$publicado' WHERE ID = '$id'";
		    $query = $pdo->query($sql);	

		    if(!$query){

		        echo "
		        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
		        	<script type=\"text/javascript\">
		        	alert(\"Falha! Não foi possível cadastrar o depoimento.\");
		        	</script>
		      	";	    

			} else {

		        echo "
		        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
		        	<script type=\"text/javascript\">
		        	alert(\"Sucesso! O depoimento foi cadastrado com sucesso.\");
			        window.location = \"index\";		        	
		        	</script>
		      	";	

		    }

		}

	}

	######################################################################  
	######################################################################  
	######################################################################

	# Sessão FAQ'S - CADASTRAR
	function insere_faq(){

		$pergunta = $_POST['pergunta'];
		$resposta = $_POST['resposta'];
		$paginas = $_POST['paginas'];
		$status = $_POST['publicado'];

		if(($pergunta && $resposta && $paginas) != ''){

			if($status != null) {

				global $pdo;
				$sql = "INSERT INTO tb_faqs VALUES ('', '$pergunta', '$resposta', '$paginas', '$status', NOW())";
				$query = $pdo->query($sql);

				if(!$query){

			        echo "
			        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
			        	<script type=\"text/javascript\">
			        	alert(\"Erro ao tentar cadastrar as perguntas.\");
			        	</script>
			      	";

				} else {

			       echo "
			        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
			        	<script type=\"text/javascript\">
			        	alert(\"Pergunta cadastrada com sucesso.\");
			        	window.location = \"index\";			        	
			        	</script>
			      	";

				}

			} else {

		        echo "
		        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
		        	<script type=\"text/javascript\">
		        	alert(\"Erro ao tentar cadastrar as perguntas.\");
		        	</script>
		      	";	

			}

		} else {

	        echo "
	        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
	        	<script type=\"text/javascript\">
	        	alert(\"Erro ao tentar cadastrar as perguntas.\");
	        	</script>
	      	";	

		}

	}

	# Sessão FAQ'S - ATUALIZAR
	function atualizar_faq(){

		$id = $_POST['faqs_id'];
		$pergunta = $_POST['pergunta'];
		$resposta = $_POST['resposta'];
		$paginas = $_POST['paginas'];
		$status = $_POST['publicado'];

		if(($pergunta && $resposta && $paginas) != ''){

			if($status != null) {

				global $pdo;

				$sql = "UPDATE tb_faqs SET pergunta = '$pergunta', resposta = '$resposta', id_pagina = '$paginas', status = '$status' WHERE ID = '$id'";
				$query = $pdo->query($sql);

				if(!$query){

			        echo "
			        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
			        	<script type=\"text/javascript\">
			        	alert(\"Erro ao tentar atualizar as perguntas.\");
			        	</script>
			      	";

				} else {

			       echo "
			        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
			        	<script type=\"text/javascript\">
			        	alert(\"Pergunta atualizada com sucesso.\");
			        	window.location = \"index\";
			        	</script>
			      	";

				}

			} else {

		        echo "
		        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
		        	<script type=\"text/javascript\">
		        	alert(\"Erro ao tentar atualizar a pergunta.\");
		        	</script>
		      	";	

			}

		} else {

	        echo "
	        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
	        	<script type=\"text/javascript\">
	        	alert(\"Erro ao tentar atualizar a pergunta.\");
	        	</script>
	      	";	

		}

	}

	######################################################################  
	######################################################################  
	######################################################################	

    # Populando cidades
	function populando_cidades(){

		global $pdo;
		$id 	= $_POST['estados'];
		$sql 	= "SELECT * FROM city WHERE state_id = '$id'";

		foreach ($pdo->query($sql) as $cidade) {
			echo '<option value="'.$cidade['id'].'">'.$cidade['name'].'</option>';
		}

    }

	######################################################################  
	######################################################################  
	######################################################################	

    # Sessão Clínicas
    # Adicionando nova clínica
    function nova_clinica(){

		$nome_clinica 	= $_POST['nome_clinica'];
		$end_1 			= $_POST['end_1'];
		$end_2 			= $_POST['end_2'];
		$estados 		= $_POST['estados'];
		$cidades 		= $_POST['cidades'];
		$tel_1 			= $_POST['tel_1'];
		$tel_2 			= $_POST['tel_2'];
		$coordenadas 	= $_POST['coordenadas'];
		$responsavel 	= $_POST['responsavel'];
		$cro 			= $_POST['cro'];
		$info_adicional = $_POST['info_adicional'];
		$status 		= $_POST['status'];

		if(($nome_clinica && $end_1 && $estados && $cidades && $coordenadas && $responsavel && $cro) != ''){

			global $pdo;
			$sql = "INSERT INTO tb_clinicas VALUES ('', '$nome_clinica', '$end_1', '$end_2', '$cidades', '$estados', '$tel_1', '$tel_2', '$coordenadas', '$responsavel', '$cro', '$info_adicional', '$status', NOW())";
			$query = $pdo->query($sql);

			if(!$query){

		        echo "
		        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
		        	<script type=\"text/javascript\">
		        	alert(\"Erro ao inserir a nova clínica. Tente novamente.\");
		        	</script>
		      	";

			} else {

		        echo "
		        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
		        	<script type=\"text/javascript\">
		        	alert(\"A clínica foi cadastrada com sucesso.\");
		        	window.location = \"index\";
		        	</script>
		      	";

			}


		} else {

	        echo "
	        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
	        	<script type=\"text/javascript\">
	        	alert(\"Erro ao inserir a nova clínica. Tente novamente.\");
	        	</script>
	      	";	

		}

    }

    function atualiza_clinica(){

		$id_clinica 	= $_POST['clinica_id'];
		$nome_clinica 	= $_POST['nome_clinica'];
		$end_1 			= $_POST['end_1'];
		$end_2 			= $_POST['end_2'];
		$estados 		= $_POST['estados'];
		$cidades 		= $_POST['cidades'];
		$tel_1 			= $_POST['tel_1'];
		$tel_2 			= $_POST['tel_2'];
		$coordenadas 	= $_POST['coordenadas'];
		$responsavel 	= $_POST['responsavel'];
		$cro 			= $_POST['cro'];
		$info_adicional = $_POST['info_adicional'];
		$status 		= $_POST['status'];

		if(($nome_clinica && $end_1 && $estados && $cidades && $coordenadas && $responsavel && $cro) != ''){

			global $pdo;
			$sql 	= "UPDATE tb_clinicas SET nome_clinica = '$nome_clinica', end_linha_um = '$end_1', end_linha_dois = '$end_2', cidade = '$cidades', estado = '$estados', telefone_um = '$tel_1', telefone_dois = '$tel_2', coordenadas = '$coordenadas', responsavel = '$responsavel', cro = '$cro', info_adicional = '$info_adicional', status = '$status' WHERE ID = '$id_clinica'";
			$query 	= $pdo->query($sql);

			if(!$query){

		        echo "
		        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
		        	<script type=\"text/javascript\">
		        	alert(\"Erro ao inserir a nova clínica. Tente novamente.\");
		        	</script>
		      	";

			} else {

		        echo "
		        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
		        	<script type=\"text/javascript\">
		        	alert(\"A clínica foi atualizada com sucesso.\");
			        window.location = \"index\";		        	
		        	</script>
		      	";

			}


		} else {

	        echo "
	        	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
	        	<script type=\"text/javascript\">
	        	alert(\"Erro ao inserir a nova clínica. Tente novamente.\");
	        	</script>
	      	";	

		}

    }

	######################################################################  
	######################################################################  
	######################################################################	

    if(isset($_POST['nova_clinica'])){ nova_clinica(); }
    if(isset($_POST['estados']) && !isset($_POST['nova_clinica'])){ populando_cidades(); }
	if(isset($_POST['addUsuario'])){ addUsuario(); }
	if(isset($_POST['updidusuario'])){ updUsuario(); }
	if(isset($_POST['lostpass'])){ recuperarSenha(); }
	if(isset($_POST['l_novasenha'])){ redefinirsenha(); }
	if(isset($_POST['respondercontato'])){ respondercontatos(); }
	if(isset($_POST['cad_depoimentos'])){ cadastar_deps(); }
	if(isset($_POST['update_deps'])){ update_deps(); }
	if(isset($_POST['insere_faq'])){ insere_faq(); }
	if(isset($_POST['atualiza_faq'])){ atualizar_faq(); }
	if(isset($_POST['atualiza_clinica'])){ atualiza_clinica(); }
	
	######################################################################  
	######################################################################  
	######################################################################