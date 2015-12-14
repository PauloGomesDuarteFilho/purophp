<?php include('header.php'); 

###################################################################################
###################################################################################
$slug 	= "imprensa";
$sql 	= "SELECT * FROM tb_paginas WHERE url_amigavel = '$slug' AND status = '1'";
$exec 	= $pdo->query($sql);
$count 	= $exec->rowCount();

if(1 != $count){ die("<script>location.href = '/home'</script>"); }
###################################################################################
###################################################################################
$slidertrats 	= slider_trat();
$sliderdados 	= $slidertrats['array'];
$slidercount 	= $slidertrats['contador'];
###################################################################################
###################################################################################
$trat_related	= trat_imprensa_related();
$trat_reldados	= $trat_related['array'];
$trat_relcount	= $trat_related['contador'];
###################################################################################
###################################################################################

?>

<div id="imprensa">

	<?php foreach ($exec as $arr) { ?>

	<?php echo $id = $arr['ID']; ?>

	<div id="aparelhos-titulo-pagina">
		<p class="Oswald fs-38 azul fw700"><?php echo $arr['titulo']; ?></p>
	</div>

	<div class="imprensa-content p-topo Cycle fs-20"><?php echo $arr['conteudo']; ?></div>	

	<?php } ?>

	<?php 
	###################################################################################
	###################################################################################
	$tratfaqs 	= trat_faqs( $id );
	$tratdados 	= $tratfaqs['array'];
	$contador 	= $tratfaqs['contador'];
	###################################################################################
	###################################################################################
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
	<div style="width: 620px; margin:0 auto">
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
	</div>			
	<div style="width: 620px; margin:0 auto">
		<div id="noticias-aparelhos">
			<?php if ($trat_relcount >= 1) { ?>
				<p class="Oswald fs-26 azul fw700 upper textcenter clear">Postagens sobre a imprensa</p>
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
</div>

<?php include('footer.php'); ?></p>