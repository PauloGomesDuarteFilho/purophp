<?php require('admin/configs/configs.php'); ?>
<?php require('includes/functions.php'); ?>

<!DOCTYPE html> 
<html lang="pt-br"> 
	<head>
		<!-- Inserção das metas para o marketing digital -->
		<meta charset="UTF-8">
		<title><?php echo (($title == '') ? 'Dental Arte - Satisfação no sorrir' : $title); ?></title>
		<meta name="description" content="<?php echo (($description == '') ? 'Garantimos um sorriso lindo e qualidade nos serviços. Dental Arte, satisfação garantida.' : $description); ?>" />
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" type="image/png" href="<?php echo url_site().'imagens/favicon.png' ?>" />
		<!-- Fim Inserção das metas para o marketing digital -->
		<base href="<?php echo "http://" . $_SERVER['HTTP_HOST']; ?>">
		<link rel="stylesheet" href="<?=url_site(); ?>js/slick/slick.css?v=<?=geraSenha();?>" />
		<link rel="stylesheet" href="<?=url_site(); ?>js/slick/slick-theme.css?v=<?=geraSenha();?>" />
		<link rel="stylesheet" href="<?=url_site(); ?>css/magnific-popup.css?v=<?=geraSenha();?>">
		<link rel="stylesheet" href="<?=url_site(); ?>css/style.css?v=<?=geraSenha();?>" />
		<link rel="stylesheet" href="<?=url_site(); ?>css/jquery-ui.css?v=<?=geraSenha();?>" />
	</head>
	<body>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.5&appId=819471254829914";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

		<div id="menu-fixed" class="minhaclasse">
			<div class="menu-fixed">
				<div class="logo-fixed">
					<a href="/"><img class="l-fixed" src="<?=url_site(); ?>imagens/logo-fixed.png" alt="Dental Arte"></a>
					<nav id="menu-e" class="f-menu m-esquerda ajuste-esq">
						<ul id="ul-menu" class="m-fixed Oswald">
							<li><a href="<?=url_site()?>">início</a></li>
							<?php menu_tratamentos(); ?>
							<li><a href="<?=url_site()?>institucional/quem-somos">a dental arte</a></li>
						</ul>
					</nav>					
					<nav id="menu-e" class="f-menu m-direita ajuste-dir">
						<ul class="m-fixed Oswald">
							<li><a href="<?=url_site()?>blog">Blog</a></li>
							<li><a href="<?=url_site()?>franquia/seja-um-franqueado">seja um franqueado</a></li>
							<li><a href="<?=url_site()?>contato">contato</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>

		<?php include('includes/modal.php'); ?>

		<div class="full-color">
			<div id="interface">
				<div id="top">
					<div class="topo">
						<header id="cabecalho">
							<a href="<?=url_site()?>"><img class="logo" src="<?=url_site(); ?>imagens/logo.png" alt="logo" /></a>
							<nav id="menu" class="top-menu m-esquerda ajuste-esq">
								<ul id="ul-menu" class="Oswald">
									<li><a href="<?=url_site()?>">Início</a></li>
									<?php menu_tratamentos(); ?>									
									<li><a href="<?=url_site()?>institucional/quem-somos">a dental arte</a></li>
								</ul>
							</nav>							
							<nav id="menu" class="top-menu m-direita">
								<ul class="Oswald">
									<li><a href="<?=url_site()?>blog">Blog</a></li>
									<li><a href="<?=url_site()?>franquia/seja-um-franqueado">Seja um Franqueado</a></li>
									<li><a href="<?=url_site()?>contato">Contato</a></li>
								</ul>
							</nav>
						</header>
					</div>
				</div>