<?php 

#######################################
require('header.php');
#######################################
#######################################
$franquia = franqueado();
$franquiadados = $franquia['array'];
$franquiacount = $franquia['contador'];
#######################################
$deps		= depoimentos();
$depsdados	= $deps['array'];
$depscount	= $deps['contador'];
#######################################

if(isset($_POST['sjf_enviar'])){

	$nome = strip_tags(trim($_POST['sjf_nome']));
	$email = strip_tags(trim($_POST['sjf_email']));
	$cidade = strip_tags(trim($_POST['sjf_cidade']));
	$fone = strip_tags(trim($_POST['sjf_fone']));
	$mensagem = strip_tags(trim($_POST['sjf_mensagem']));
	$asunto = "Seja um franqueado";

	$sql = "INSERT INTO tb_contatos VALUES('', '$nome', '$email', '$cidade', '$fone', '$mensagem', '$asunto', '0', NOW())";
	$exc = $pdo->query($sql);

	if($exc){ 

		echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=home'>
			<script type=\"text/javascript\">
			alert(\"Sua mensagem foi enviada com sucesso. Entraremos em contato em breve.\");
			window.location = \"home\";
			</script>
		";

	} else { 

			echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=home'>
			<script type=\"text/javascript\">
			alert(\"Sua mensagem não foi enviada. Tente mais tarde.\");
			window.location = \"home\";
			</script>
		";

	}

}

?>

<div id="aparelhos">
	<div id="aparelhos-titulo-pagina">
		<p class="Oswald fs-38 azul fw700">
			<?php foreach ($franquiadados as $franquiadado) { ?>
				<?php echo $franquiadado['titulo']; ?>
			<?php } ?>
		</p>
	</div>
	<div class="aparelhos-content">
		<div class="p-topo Cycle fs-20" >
			<?php foreach ($franquiadados as $franquiadado) { ?>
				<?php $id = $franquiadado['ID']; ?>
				<?php echo $franquiadado['conteudo']; ?>
			<?php } ?>
		</div>
		<div class="pqdentalarte">
			<p class="Oswald fs-26 azul fw700 upper textcenter upper">porque a dental arte</p>
			<div id="franquia" class="videos-dental">
				<iframe width="487" height="274" src="https://www.youtube.com/embed/hRH7gdhferQ" frameborder="0" allowfullscreen></iframe>	
				<iframe width="487" height="274" src="https://www.youtube.com/embed/hRH7gdhferQ" frameborder="0" allowfullscreen></iframe>	
			</div>
			<img src="imagens/new-video-fanrqueado.png" style="margin-top:-40px" alt="">
		</div>

		<?php

		#######################################
		$tratfaqs 	= trat_faqs( $id );
		$tratdados 	= $tratfaqs['array'];
		$contador 	= $tratfaqs['contador'];
		#######################################

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
		<div id="depoimentos-franqueados" style="padding-bottom:50px">
			<div class="slider-trat">
				<p class="Oswald fs-26 azul fw700 upper textcenter">depoimentos franqueados</p>
			</div>
			<div id="depoimentos-suf">
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
	</div>
	<div class="aparelhos-sidebar">
		<p class="tform Oswald fs-24 fw700 branco">Estou interessado<br /> nesse tratamento</p>
		<p class="Cycle fs-18 branco titleContato">Preencha o formulário para mais informações sobre como ser o nosso franqueado.</p>
		<form action="" id="contato" method="POST" enctype="application/x-www-form-urlencoded">
			<input type="text" name="sjf_nome" id="nome" placeholder="Nome*" required />
			<input type="text" name="sjf_email" id="email" placeholder="Email*" required />
			<input type="text" name="sjf_cidade" id="cidade" placeholder="Cidade*" required />
			<input type="text" name="sjf_fone" id="fone" placeholder="Telefone*" required />
			<input type="hidden" name="sjf_enviar" />
			<textarea name="sjf_mensagem" id="mensagem" placeholder="Insira uma mensagem"></textarea>
			<button type="submit" class="enviar" style="margin-top:20px">
				<img src="imagens/bota_contato.png" alt="Enviar contato para Dental Arte">
			</button>
		</form>
		<div class="clear">&nbsp;</div>
			<a href="/contato">
				<img class="icon" src="imagens/tenho_duvidas.png" alt="Perguntas Frequentes">
			</a>
		<div class="clear">&nbsp;</div>
	</div>
</div>

<?php include('footer.php'); ?>