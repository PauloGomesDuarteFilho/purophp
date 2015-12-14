<?php include('header-trat.php');

if(isset($_POST['trat_enviar'])){

	$nome = strip_tags(trim($_POST['trat_nome']));
	$email = strip_tags(trim($_POST['trat_email']));
	$cidade = strip_tags(trim($_POST['trat_cidade']));
	$fone = strip_tags(trim($_POST['trat_fone']));
	$asunto = strip_tags(trim($_POST['trat_assunto']));	
	$mensagem = strip_tags(trim($_POST['trat_assunto']));
	# $asunto = "Seja um franqueado";

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
		    	alert(\"Obrigado. Entraremos em contato para confirmar a sua avaliação.\");
		    	window.location = \"http://dent.axitech.com.br/home\";
		    	</script>
		  	";

		}
	
	}

}

?>

<div id="aparelhos">
	<div id="aparelhos-titulo-pagina" class="fecha">
		<p class="Oswald fs-38 azul fw700"></p>
	</div>
	<div class="aparelhos-content">

		<div class="p-topo Cycle fs-20 conteudo_tratamento">
			<?php foreach ($tratamentos as $tratamento) { ?>
				<?=$tratamento['conteudo']; ?>
				<?php $idTrat = $tratamento['ID']; ?>
				<?php $titulo = $tratamento['titulo']; ?>
			<?php } ?>
		</div>

		<?php 

		############################################
		$tratfaqs 	= trat_faqs( $idTrat );
		$tratdados 	= $tratfaqs['array'];
		$contador 	= $tratfaqs['contador'];
		############################################
		############################################
		$slidertrats 	= slider_trat();
		$sliderdados 	= $slidertrats['array'];
		$slidercount 	= $slidertrats['contador'];
		############################################
		############################################
		$trat_related	= trat_related($slug_trat);
		$trat_reldados	= $trat_related['array'];
		$trat_relcount	= $trat_related['contador'];
		############################################		
		############################################
		$deps		= depoimentos();
		$depsdados	= $deps['array'];
		$depscount	= $deps['contador'];
		############################################

		?>

		<?php if($contador > 0) { ?>
		<p class="Oswald fs-26 azul fw700 upper textcenter" style="padding:40px 0">perguntas frenquentes</p>	
			<?php foreach ($tratdados as $tratdado) : ?>
				<div id="faq" class="clear2 faqhome">
					<div class="question">
						<div class="q">
							<p class="fs-16 Cycle"><?=$tratdado['pergunta']?></p>	
						</div>
						<div class="s">
							<a href="" class="mostra_resposta">
								<img class="ativar" src="imagens/acessa-servico-desativado.png" alt="">
							</a>
						</div>
						<div class="resposta">
							<p class="Cycle fs-16"><?=$tratdado['resposta']?></p>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			<?php endforeach ?>
		<?php } ?>

		<div class="slider-trat">
			<p class="Oswald fs-26 azul fw700 upper textcenter">outros tratamentos</p>
		</div>
		<div id="box">
			<div class="intratamento Oswald fs-16 fw400">
				<?php if($slidercount >= 1) : ?>
					<?php foreach ($sliderdados as $sliderdado): ?>
						<div class="slider_conteudos">
							<a href="tratamentos/<?=$sliderdado['url_amigavel']; ?>">
								<?=$sliderdado['titulo']; ?>
							</a>
						</div>
					<?php endforeach ?>
				<?php endif; ?>
			</div>				
		</div>
		<div id="noticias-aparelhos">
			<?php if ($trat_relcount >= 1) { ?>
				<p class="Oswald fs-26 azul fw700 upper textcenter clear">Postagens sobre esse tratamento</p>
				<div class="clear" style="margin:40px auto"></div>
				<?php $i = 1; ?>
				<?php foreach ($trat_reldados as $trat_reldado) : ?>
					<?php $i++; ?>
					<div class="blog-ap2 artigos-ap <?php if($i % 2 ==0){ echo 'floatleft'; } else { echo 'floatright'; } ?>">
						<?php if($trat_reldado['imagem'] != null) { ?><a name="imagem_destacada"><img src="admin/images/<?=$trat_reldado['imagem']?>" class="autow" alt="<?=$trat_reldado['titulo']?>"></a><?php } ?>			
						<h1 class="Cycle fs-24"><?php echo $trat_reldado['titulo']; ?></h1>
						<div class="Cycle fs-18"><?php echo post_counter($trat_reldado['conteudo']); ?></div>
						<a href="blog/<?php echo $trat_reldado['url_amigavel']; ?>">
							<img style="margin-left:-4px; margin-top:20px" src="imagens/bot-leiamais-blog.png">
						</a>
					</div>
				<?php endforeach ?>				
			<?php } ?>
			<div class="clear"></div>	
		</div>
	</div>
	<div class="aparelhos-sidebar">
		<p class="tform Oswald fs-24 fw700 branco">Estou interessado<br /> nesse tratamento</p>
		<p class="Cycle fs-18 branco titleContato">Preencha o formulário para ver valores e informações sobre o tratamentos</p>
		<form id="contato" action="" method="POST" enctype="application/x-www-form-urlencoded">
			<input type="text" name="trat_nome" id="nome" placeholder="Nome*" required />
			<input type="text" name="trat_email" id="email" placeholder="Email*" required />
			<input type="text" name="trat_cidade" id="cidade" placeholder="Cidade*" required />
			<input type="text" name="trat_fone" id="telefone" placeholder="Telefone*" required />
			<input type="hidden" name="trat_assunto" value="Tratamento - <?php echo $titulo; ?>" />
			<input type="hidden" name="trat_enviar" />
			<button type="submit" class="enviar">
				<img src="imagens/bota_contato.png" alt="Enviar contato para Dental Arte">
			</button>
		</form>
		<div class="clear">&nbsp;</div>
		<a href="#verpreco-popup" class="open-popup-verpreco-link"><img class="icon" src="imagens/ver_preco.png" alt="Ver preço"></a>
		<a href="#agende-popup" class="open-popup-agenda-link"><img class="icon" src="imagens/agende_avaliacao.png" alt="Agende sua avaliação"></a>
		<!-- a href="/perguntas-frequentes" -->
		<a href="/contato">
			<img class="icon" src="imagens/tenho_duvidas.png" alt="Tenho dúvidas">
		</a>
		
		<?php if($depscount >= 1) { ?>
			<div class="depoimentos-ap">
				<h2 style="margin-bottom:0" class="Oswald fs-18 bolder azul">Depoimentos</h2>
				<img class="quote-sidebar" src="imagens/quote.png" alt="">
				<div id="depsi">
					<?php foreach ($depsdados as $depsdado) { ?>
						<div class="deps-unity">
							<p class="Cycle fs-16 cinza"><?php echo $depsdado['depoimento']; ?></p>
							<p class="Cycle fs-12">
								<span class="Cycle fs-18 azul"><?php echo $depsdado['nome']; ?></span>
								<br /><span class="cinza"><?php echo $depsdado['profissao']; ?> 
								<br><?php echo $depsdado['idade']; ?> anos</span>
							</p>
						</div>		
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<?php include('footer.php'); ?>