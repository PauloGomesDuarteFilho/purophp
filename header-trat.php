<?php include('includes/pre-header.php'); ?>
<?php $tratamentos = tratamento_pages(); ?>

	<div class="content">

		<div id="aparelhos-titulo-pagina" style="margin:0 auto 60px auto !important">
			<?php foreach ($tratamentos as $tratamento) { ?>
				<p class="Oswald fs-38 azul fw700"><?=$tratamento['titulo']?></p>
			<?php } ?>
		</div>

		<?php include('includes/banners.php'); ?>

		<div class="clear" style="margin-bottom:50px"></div>