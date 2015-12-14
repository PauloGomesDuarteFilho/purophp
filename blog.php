<?php include('header.php'); ?>
<?php $blog_posts = blog_posts(); 

############################################
$deps		= depoimentos();
$depsdados	= $deps['array'];
$depscount	= $deps['contador'];
############################################

?>

<div id="aparelhos">
	<div id="aparelhos-titulo-pagina">
		<p class="Oswald fs-38 azul fw700">blog</p>
	</div>

	<div class="aparelhos-content">
		<?php foreach ($blog_posts as $posts) { ?>
			<article>
				<h2 class="Oswald fs-24 fw400 azul mt0"><?=$posts['titulo']?></h2>
				<h3 class="Cycle fs-16 fw400"><?=BDtoBR($posts['datacad'])?> por <b><?=$posts['autor']?></b><?php if($posts['categoria'] != null) { ?> | <b><?=Categorias($posts['categoria'])?></b><?php } ?></h3>
				<?php if($posts['imagem'] != null) { ?>
					<a href="blog/<?=$posts['url_amigavel']?>" name="imagem_destacada">
						<img src="admin/images/<?=$posts['imagem']?>" class="autow" alt="<?=$posts['titulo']?>">
					</a>
				<?php } ?>
				<div class="postagem-dental p-topo Cycle fs-20 justfy" style="margin:25px 0"><?=limit_text($posts['conteudo'], 50)?></div>	
				<a href="blog/<?=$posts['url_amigavel']?>"><img src="imagens/ler_mais.png"></a>
				<hr class="hr-blog">
			</article>
		<?php } ?>
	</div>

	<div class="categorias-sidebar">
		<p class="title-cat-sidebar Oswald fs-20 upper branco textcenter bkg-azul">categorias</p>
		<ul class="menu-sidebar">
			<li><a href="">Aparelhos dentários</a></li>
			<li><a href="">Implantes</a></li>
			<li><a href="">Restaurações</a></li>
			<li><a href="">Próteses</a></li>
			<li><a href="">Clareamento</a></li>
			<li><a href="">Extrações</a></li>
			<li><a href="">Tratamento de canal</a></li>
			<li><a href="">Restaurações</a></li>
		</ul>
	</div>

	<div class="aparelhos-sidebar" style="background:none !important">

		<div class="fecha">
			<p class="tform Oswald fs-24 fw700 branco">Estou interessado<br /> nesse tratamento</p>
			<p class="Cycle fs-18 branco titleContato">Preencha o formulário para ver valores e informações sobre o tratamentos</p>
			<form id="contato" action="" method="POST">
				<input type="text" name="nome" id="nome" placeholder="Nome*" required />
				<input type="text" name="email" id="email" placeholder="Email*" required />
				<input type="text" name="cidade" id="cidade" placeholder="Cidade*" required />
				<input type="text" name="fone" id="fone" placeholder="Telefone*" required />
				<button type="submit" class="enviar">
					<img src="imagens/bota_contato.png" alt="Enviar contato para Dental Arte">
				</button>
			</form>
		</div>

		<div class="clear">&nbsp;</div>
			<a href="#verpreco-popup" class="open-popup-verpreco-link fecha"><img class="icon" src="imagens/ver_preco.png" alt="Ver preço"></a>
			<a href="#agende-popup" class="open-popup-agenda-link"><img class="icon" src="imagens/agende_avaliacao.png" alt="Agende sua avaliação"></a>
			<a href="/contato"><img class="icon" src="imagens/tenho_duvidas.png" alt="Tenho dúvidas"></a>
		<div class="clear">&nbsp;</div>

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