<?php 

########################################
include('header-home.php');
########################################
$rel_posts = related_posts_home();
$relatedDados = $rel_posts['array']; 
$relatedCount = $rel_posts['contador'];  
########################################
#######################################
$deps		= depoimentos();
$depsdados	= $deps['array'];
$depscount	= $deps['contador'];
#######################################
$trat_home	= tratamentos_home();
$showtrats	= $trat_home['array'];
$counttrats	= $trat_home['contador'];
#######################################

?>

	</div>

	<div class="full-bgfranqueado">
		<div class="content-fqd">
			<div class="fqd-texto">
				<h2 class="Oswald">SEJA UM FRANQUEADO</h2>
			</div>
			<div class="fqd-bot">
				<a href="franquia/seja-um-franqueado">
					<img src="imagens/saibamais-franqueado.png" alt="Seja um Franqueado" />
				</a>
			</div>

		</div>
	</div>
	<div id="tratamentos">
		<div class="tratamento01 relativo">
			<p class="titulo Oswald fs-28 branco fw700" style="margin-top:95px">Tratamentos</p>
			<p class="Cycle fs-18 branco">Veja alguns de nossos<br /> principais tratamentos</p>
			<!-- a href="/institucional/quem-somos">
				<img src="imagens/bot-tratamentos.png" alt="tratamentos" />
			</a -->
		</div>
		<?php if($counttrats >= 7) : ?>
			<?php foreach ($showtrats as $showtrat) : ?>
				<div class="tratamento relativo" style="overflow:hidden">
					<a href="tratamentos/<?=$showtrat['url_amigavel']; ?>">
						<img src="admin/images/<?=$showtrat['imagem']; ?>" class="autoh" alt="tratamentos/<?=$showtrat['titulo']; ?>">
					</a>
					<div class="trat-descr absoluto bottom-zero">
						<a href="tratamentos/<?=$showtrat['url_amigavel']; ?>">	
							<p style="margin:7px 0 0 10px" class="fs-16 Cycle branco"><?=$showtrat['titulo']; ?></p>
							<span class="seta">></span>
						</a>
					</div>
				</div>			
			<?php endforeach ?>
		<?php endif; ?>
		<div class="clear"></div>
	</div>
	<div class="full-bgdepoimento">
		<div class="depoimentos relativo">
			<div id="deps">
				<?php if($depscount >= 1) { ?>
					<?php foreach ($depsdados as $depsdado) : ?>
						<div class="deps-unity">
							<p class="Cycle fs-24 branco"><?php echo post_counter_dep($depsdado['depoimento']); ?></p>
							<p class="Cycle fs-12"> 
								<span class="Cycle fs-18 branco"><?php echo $depsdado['nome']; ?></span>
								<br /><span><?php echo $depsdado['profissao']; ?></span> <?php echo $depsdado['idade']; ?> anos
							</p>
						</div>		
					<?php endforeach; ?>
				<?php } ?>
			</div>
			<img class="aspas" src="imagens/aspas-dp.png">
		</div>
	</div>
	<div id="noticias">
		<?php if($relatedCount >= 1) : ?>
			<p class="blog Oswald azul fs-40">blog dental arte</p>
			<?php $i = 1; ?>
			<?php foreach ($relatedDados as $relatedDado) : ?>
				<?php $i++; ?>
				<div class="artigos <?php if($i % 2 ==0){ echo 'floatleft'; } else { echo 'floatright'; } ?>">
					<?php if($relatedDado['imagem'] != null) { ?>
						<a href="blog/<?=$relatedDado['url_amigavel']?>" name="imagem_destacada">
							<img src="admin/images/<?=$relatedDado['imagem']?>" class="notic autow" alt="<?=$relatedDado['titulo']?>">
						</a>
					<?php } ?>
					<h1 class="Cycle fs-24">
						<a href="blog/<?=$relatedDado['url_amigavel']?>" style="color:#3f3f3f !important">
							<?=$relatedDado['titulo']?>
						</a>
					</h1>
					<div class="Cycle fs-20"><?=limit_text($relatedDado['conteudo'], 45); ?></div>
					<a href="blog/<?=$relatedDado['url_amigavel']?>">
						<img src="imagens/bot-leiamais-blog.png" alt="<?=$relatedDado['titulo']?>" style="margin-left:-4px; margin-top:20px" />
					</a>
				</div>	
			<?php endforeach ?>
		<?php endif; ?>
		<div class="clear"></div>
	</div>

<?php include('footer.php'); ?>