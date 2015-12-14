<?php include('header.php');

if(isset($_POST['cntt_enviar'])){

	$nome = strip_tags(trim($_POST['cntt_nome']));
	$email = strip_tags(trim($_POST['cntt_email']));
	$cidade = strip_tags(trim($_POST['cntt_cidade']));
	$fone = strip_tags(trim($_POST['cntt_fone']));
	$mensagem = strip_tags(trim($_POST['cntt_mensagem']));
	$asunto = "Página de contato Dental Arte";

	$sql = "INSERT INTO tb_contatos VALUES('', '$nome', '$email', '$cidade', '$fone', '$mensagem', '$asunto', '0', NOW())";
	$exc = $pdo->query($sql);

	if($exc){

		include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/assets/phpmailer/PHPMailerAutoload.php');
		
		$subject 			= 'Contatos e interessados em tratamentos - Dental Arte';
		$mail       		= new PHPMailer();

		$mail->IsSMTP();
		$mail->SMTPAuth   	= true;
		$mail->Host       	= "mail.axitech.com.br";
		$mail->Port       	= 465;
		$mail->Username   	= "contato@axitech.com.br";
		$mail->Password   	= "3755d43776";
		$mail->SMTPSecure 	= 'ssl';
		$mail->SetFrom('contato@axitech.com.br', 'Dental Arte');
		$mail->AddReplyTo("contato@axitech.com.br","Dental Arte");
		$mail->Subject    	= $subject;
		$mail->Body       	= utf8_decode("
		<!DOCTYPE html>
		<html lang=\"en\">
		<head>
			<meta charset=\"UTF-8\">
		</head>
		<body>
			<div style='width:500px; margin:40px auto; border:1px solid #ccc; border-radius:5px; box-shadown:2px 2px 2px #ccc; padding:25px'>
				<h1 style='font-size:32px; color:#2ca3d2; font-weight:bolder'>Dental Arte Clínica odontológica</h1>
				<p>Você solicitou recentemente um agendamento ou contato com a Dental Arte.</p>	
				<p>Em breve entraremos em contato para confirmar a sua visita com hora marcada em nossa clínica mais próxima para sua comodidade ou simplesmente para esclarecer suas dúvidas.</p>
				<br><br><p><strong>Atenciosamente,</strong></p>
				<p><strong>Dental Arte</strong></p>
			</div>	
		</body>
		</html>
		");
		
		$mail->IsHTML(true); 
		$mail->AddAddress($email, $nome);
		$mail->AddAddress('alexandre@altgrupo.com.br', 'ALT Grupo');

		if(!$mail->Send()) {
		    echo "
		    	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
		    	<script type=\"text/javascript\">
		    	alert(\"Não foi possível enviar sua mensagem.\");
		    	window.location = \"http://dent.axitech.com.br/home\";
		    	</script>
		  	";		
		} else {
		    echo "
		    	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
		    	<script type=\"text/javascript\">
		    	alert(\"Obrigado. Entraremos em contato para confirmar a sua avaliação ou esclarecer as dúvidas relacionadas ao contato.\");
		    	window.location = \"http://dent.axitech.com.br/home\";
		    	</script>
		  	";

		}
	
	}

}

?>

<div id="imprensa">
	<div id="aparelhos-titulo-pagina">
		<p class="Oswald fs-38 azul fw700">contato</p>
	</div>

	<div class="imprensa-content">

		<p class="p-topo Cycle fs-20">Escreva para a Dental Arte, mande suas dúvidas, reclamações, sugestões e saiba tudo que a Dental Arte tem para lhe oferecer.</p>

		<div class="contato-pg">
			<form id="contato-pg" action="" method="POST" enctype="application/x-www-form-urlencoded">
				<input type="text" name="cntt_nome" id="nome" placeholder="Nome*" required />
				<input type="text" name="cntt_email" class="floatright" id="email" placeholder="Email*" required />
				<input type="text" name="cntt_cidade" id="cidade" placeholder="Cidade*" required />
				<input type="text" name="cntt_fone" class="floatright" id="fone" placeholder="Telefone*" required />
				<input type="hidden" name="cntt_enviar" />
				<textarea name="cntt_mensagem" id="mensagem" placeholder="Mensagem*" required></textarea>
				<button type="submit" class="enviar">
					<img src="imagens/bota_contato.png" alt="Enviar contato para Dental Arte">
				</button>
			</form>

		</div>

		<div class="enderecos floatleft">

			<p class="Cycle fs-16"> <span class="Cycle fs-20 azul fw700 upper">novo hamburgo</span><br />
			Dr. Magalhães Calvet 62<br />
			1º andar - Centro<br />
			<span class="Cycle fs-18 fw700">(51) 3065 6503  / (51) 9999 9999</span>&nbsp;<img src="imagens/whatsapp.png" /></P>
			<a href=""></a><img src="imagens/ver_mapa.png" alt="Ver mapa localização" /></a>

		</div>
		
		<div class="enderecos floatright">

			<p class="Cycle fs-16"> <span class="Cycle fs-20 azul fw700 upper">cachoeirinha</span><br />
			Av. Flores da Cunha 1102 - 1º andar<br />
			Centro<br />
			<span class="Cycle fs-18 fw700">(51) 3041 4878 / (51) 9999 9999</span>&nbsp;<img src="imagens/whatsapp.png" /></P>
			<a href=""><img src="imagens/ver_mapa.png" alt="Ver mapa localização" /></a>
			
		</div>

		<div class="enderecos floatleft">

			<p class="Cycle fs-16"> <span class="Cycle fs-20 azul fw700 upper">alvorada</span><br />
			Av. Presidente Getúlio Vargas 1860<br />
			Centro<br />
			<span class="Cycle fs-18 fw700">(51) 3442 8000 / (51) 9999 9999</span>&nbsp;<img src="imagens/whatsapp.png" /></P>
			<a href=""><img src="imagens/ver_mapa.png" alt="Ver mapa localização" /></a>
			
		</div>

		<div class="enderecos floatright">

			<p class="Cycle fs-16"> <span class="Cycle fs-20 azul fw700 upper">porto alegre</span><br />
			Rua dos Andradas 1464 - Sala 20<br />
			Centro<br />
			<span class="Cycle fs-18 fw700">(51) 3029 2908 / (51) 9999 9999</span>&nbsp;<img src="imagens/whatsapp.png" /></P>
			<a href=""><img src="imagens/ver_mapa.png" alt="Ver mapa localização" /></a>

			<div class="clear">&nbsp;</div>
			
		</div>		

	</div>

</div>

<?php include('footer.php'); ?></p>

		