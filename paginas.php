<?php 

####################################
include('header.php'); 
####################################
$inpaginas = paginas();
$pagedados = $inpaginas['array'];
$pagecount = $inpaginas['contador'];
####################################
############################################
$slidertrats 	= slider_trat();
$sliderdados 	= $slidertrats['array'];
$slidercount 	= $slidertrats['contador'];
############################################
$trat_related	= pages_related($slug_trat);
$trat_reldados	= $trat_related['array'];
$trat_relcount	= $trat_related['contador'];
############################################

?>

<div id="aparelhos">
	<div id="aparelhos-titulo-pagina">
		<?php foreach ($pagedados as $pagedado) { ?>
			<p class="Oswald fs-38 azul fw700"><?php echo $pagedado['titulo'] ?></p>
		<?php } ?>
	</div>
	<div class="aparelhos-content">
		<?php foreach ($pagedados as $pagedado) { ?>
			<div class="p-topo Cycle fs-20">
				<?php echo $pagedado['conteudo']; ?>
			</div>
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

	<div class="quem-somos-sidebar floatright">

		<p class="tform Oswald fs-22 fw700 branco upper textcenter" style="padding:25px 10px 0 10px">missão</p>
		<p class="Cycle fs-18 branco textcenter">Tornar pessoas realizadas através de um sorriso bonito e saudável.</p>
		<img src="imagens/rabisco.jpg" alt="">

		<p class="tform Oswald fs-22 fw700 branco upper textcenter">visão</p>
		<p class="Cycle fs-18 branco textcenter">Queremos ser referência na gestão de clínicas odontológicas e promover a expansão da rede Dental Arte através de parcerias com profissionais empreendedores que se identifiquem com nossos valores.</p>
		<img src="imagens/rabisco.jpg" alt="">

		<p class="tform Oswald fs-22 fw700 branco upper textcenter">valores</p>
		<p class="Cycle fs-18 branco textcenter">Cliente satisfeito; Qualidade e garantia dos serviços; Transparência e ética nas relações; Trabalho em equipe.</p>
		<p class="Cycle fs-18 branco textcenter">Venha para a Dental Arte e valorize o que você tem de melhor!</p>
	
	</div>

	</div>

</div>

<?php include('footer.php'); ?>