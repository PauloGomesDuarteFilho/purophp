<?php

	require('../admin/classes/Database.php');
	$pdo 	= Database::connect();

	function encrypt_pass($parametro)
	{
		$parametro 	= md5($parametro);
		$senhadb 	= md5($parametro);
		return $senhadb;
	}

	if( $_SERVER["REQUEST_METHOD"] == "POST" ){

		$password	= $_POST['passnick'];
		$encsenha	= encrypt_pass($password);
		$userlogs	= $_POST['usernick'];

	    if (!($pdo)) 
	    {
	        echo 'Não foi possível se conectar ao banco de dados';
	    } else {

	    	// Tá conectado, vamos buscar os dados de acesso para comprar.
			$consulta		= "SELECT * FROM tb_usuarios WHERE email = '$userlogs'";
			$resultado 		= $pdo->query($consulta);
			$dados 			= $resultado->fetch();

			if ($resultado->rowCount() == 1) {

		    	if($dados["senha"] == $encsenha){

		    		if($dados["status"] == 1){

						session_start();
						$_SESSION['usuarioPassw'] 	= $dados["senha"];
						$_SESSION['usuarioEmail'] 	= $dados["email"];
						$_SESSION['usuarioNomes'] 	= $dados["nome"];
						$_SESSION['usuarioNivel'] 	= $dados["nivel"];
						$_SESSION['usuarioStatus'] 	= $dados["status"];

						echo '<script>window.location = "admin/home/index";</script>';

		    		} else {

						echo '<div class="msg alert alert-danger alert-dismissible hidden" role="alert">';
						echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						echo '<strong>Falha! </strong>Não foi possível entrar no sistema. Entre em contato com administrador.';
						echo '</div>';

		    		}

		    	} else {

					echo '<div class="msg alert alert-danger alert-dismissible hidden" role="alert">';
					echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
					echo '<strong>Falha! </strong>Não foi possível entrar no sistema. Verifique os seus dados.';
					echo '</div>';

		    	}

			} else {

				echo '<div class="msg alert alert-danger alert-dismissible hidden" role="alert">';
				echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
				echo '<strong>Falha! </strong>Não foi possível entrar no sistema. Verifique os seus dados.';
				echo '</div>';

			}

		}

	}

?>