<?php

function post_counter($parametro){

	$parametro = strip_tags($parametro);

	if (strlen($parametro) > 250) {
		$stringCut = substr($parametro, 0, 250);
		$parametro = substr($stringCut, 0, strrpos($stringCut, '.')) . '.';
	}

	return $parametro;

}

function post_counter_dep($parametro){

	$parametro = strip_tags($parametro);

	if (strlen($parametro) > 200) {
		$stringCut = substr($parametro, 0, 200);
		$parametro = substr($stringCut, 0, strrpos($stringCut, '.')) . '...';
	}

	return $parametro;

}

function limit_text($text, $limit) {
  	if (str_word_count($text, 0) > $limit) {
      	$words = str_word_count($text, 2);
      	$pos = array_keys($words);
      	$text = substr($text, 0, $pos[$limit]) . '...';
  	}
    return $text;
}

######################################################################################
#### FORMATA CATEGORIAS VINDAS DO BANCO ##############################################
######################################################################################

function Categorias($parametro){

	$parametro = str_replace(",", ", ", $parametro);
	$parametro = ucfirst($parametro);
	return $parametro;

}

######################################################################################
#### DATA DO BANCO DE DADOS PARA O SISTEMA ###########################################
######################################################################################

function BDtoBR($parametro){

	$novadata 	= date('d F Y', strtotime(str_replace("/", "-", $parametro)));
	$array   	= explode(" ", $novadata);
	$mes   		= $array[1];

	switch ($array[1]) {
		case 'January':
			$array[1] = 'Janeiro';
			break;
		case 'February':
			$array[1] = 'Fevereiro';
			break;
		case 'March':
			$array[1] = 'Março';
			break;
		case 'April':
			$array[1] = 'Abril';
			break;
		case 'May':
			$array[1] = 'Maio';
			break;
		case 'June':
			$array[1] = 'Junho';
			break;
		case 'July':
			$array[1] = 'Julho';
			break;
		case 'August':
			$array[1] = 'Agosto';
			break;
		case 'September':
			$array[1] = 'Setembro';
			break;
		case 'October':
			$array[1] = 'Outubro';
			break;
		case 'November':
			$array[1] = 'Novembro';
			break;
		case 'December':
			$array[1] = 'Dezembro';
			break;
		default:
			$array[1] = '';
		break;
	}

	$novadata  = $array[0] . " ";
	$novadata .= $array[1] . " ";
	$novadata .= $array[2];
	return $novadata;

}

######################################################################################
#### RETORNA O MENU TRATAMENTOS ######################################################
######################################################################################

function menu_tratamentos(){

	global $pdo;

	$sql = "SELECT * FROM tb_paginas WHERE tipo = 'tratamentos' AND status = '1' ORDER BY subtitulo ASC, datacad DESC";
	$exec = $pdo->query($sql);
	$count = $exec->rowCount();

	echo '<li class="atvdo">';
		echo '<a class="sub-menu pointer">tratamentos</a>';
		echo '<img class="sub-menu" src="'.url_site().'imagens/sub-menu.png" alt="">';
			echo '<ul class="insub-menu">';
				echo '<img class="img-submenu" src="'.url_site().'imagens/top-submenu.png" alt="">';
				foreach ($exec as $tratamento) {
					echo '<li><a href="'.url_site().'tratamentos/'.friendly_url($tratamento['titulo']).'">'.$tratamento['titulo'].'</a></li>';
				}
			echo '</ul>';
	echo '</li>';

}

######################################################################################
#### RETORNA OS BANNERS ##############################################################
######################################################################################

function pull_banner(){

	global $pdo;

	$sql 	= "SELECT * FROM tb_banners WHERE status = '1'";
	$exc 	= $pdo->query($sql);
	$cnt 	= $exc->rowCount();
	$array 	= $exc->fetchAll(PDO::FETCH_ASSOC);

	return $array;

}

######################################################################################
#### FUNÇÕES DE ROTEAMENTO DO BLOG ###################################################
######################################################################################

function blog_posts($slug_post = null){

	global $pdo;
	$slug_post = $_GET['slug_post'];

	if($slug_post != null && $slug_post != ""){
		$sql = "SELECT * FROM tb_paginas WHERE tipo = 'blog' AND url_amigavel = '$slug_post' AND status = '1'";
	} else {
		$sql = "SELECT * FROM tb_paginas WHERE tipo = 'blog' AND status = '1'"; 	
	}

	$exc 	= $pdo->query($sql);
	$cnt 	= $exc->rowCount();
	$array 	= $exc->fetchAll(PDO::FETCH_ASSOC);
	$hpg 	= url_site().'blog';

	if ($cnt >= 1)
		return $array;
	else 
		die("<script>location.href = '/erro404'</script>");

}

######################################################################################
#### POSTS RELACIONADOS ##############################################################
######################################################################################

function related_posts($slug_post = null){

	global $pdo;
	$slug_post = $_GET['slug_post'];

	$sql = "SELECT * FROM tb_paginas WHERE tipo = 'blog' AND status = '1' AND url_amigavel <> '$slug_post' ORDER BY rand() LIMIT 3";

	$exc 	= $pdo->query($sql);
	$cnt 	= $exc->rowCount();
	$array 	= $exc->fetchAll(PDO::FETCH_ASSOC);

	return $array;

}

function related_posts_home(){

	global $pdo;

	$sql = "SELECT * FROM tb_paginas WHERE tipo = 'blog' AND status = '1' ORDER BY rand() LIMIT 2";

	$exc 	= $pdo->query($sql);
	$cnt 	= $exc->rowCount();
	$array 	= $exc->fetchAll(PDO::FETCH_ASSOC);

	return array('array' => $array, 'contador' => $cnt);

}

######################################################################################
######################################################################################
######################################################################################

function paginas(){

	global $pdo;

	$slug = $_GET['slug_pages'];

	$sql = "SELECT * FROM tb_paginas WHERE tipo = 'paginas' AND url_amigavel = '$slug' AND status = '1'";
	$exc = $pdo->query($sql);
	$cnt = $exc->rowCount();
	$array 	= $exc->fetchAll(PDO::FETCH_ASSOC);

	if($cnt == 1)
		return array('array' => $array, 'contador' => $cnt);
	else
		die("<script>location.href = '/erro404'</script>");

}

function tratamento_pages(){

	global $pdo;

	$slug = $_GET['slug_trat'];

	$sql = "SELECT * FROM tb_paginas WHERE tipo = 'tratamentos' AND url_amigavel = '$slug' AND status = '1'";
	$exc = $pdo->query($sql);
	$cnt = $exc->rowCount();
	$array 	= $exc->fetchAll(PDO::FETCH_ASSOC);

	if($cnt == 1)
		return $array;
	else
		die("<script>location.href = '/erro404'</script>");

}

function trat_related(){

	global $pdo;
	$slug_trat = $_GET['slug_trat'];

	$sql = "SELECT * FROM tb_paginas WHERE categoria LIKE '%$slug_trat%' AND tipo = 'blog' AND status = '1' ORDER BY rand() LIMIT 2";
	$exc = $pdo->query($sql);
	$cnt = $exc->rowCount();
	$array 	= $exc->fetchAll(PDO::FETCH_ASSOC);	

	return array('array' => $array, 'contador' => $cnt);

}

function trat_imprensa_related(){

	global $pdo;
	$slug_trat = 'imprensa';

	$sql = "SELECT * FROM tb_paginas WHERE categoria LIKE '%$slug_trat%' AND tipo = 'blog' AND status = '1' ORDER BY rand() LIMIT 2";
	$exc = $pdo->query($sql);
	$cnt = $exc->rowCount();
	$array 	= $exc->fetchAll(PDO::FETCH_ASSOC);	

	return array('array' => $array, 'contador' => $cnt);

}

function tratamentos_home(){

	global $pdo;

	$sql = "SELECT * FROM tb_paginas WHERE tipo = 'tratamentos' AND status = '1' ORDER BY subtitulo ASC, datacad DESC LIMIT 7";
	$exc = $pdo->query($sql);
	$cnt = $exc->rowCount();
	$array 	= $exc->fetchAll(PDO::FETCH_ASSOC);	

	return array('array' => $array, 'contador' => $cnt);

}

function pages_related(){

	global $pdo;
	$slug_trat = $_GET['slug_pages'];

	$sql = "SELECT * FROM tb_paginas WHERE categoria LIKE '%$slug_trat%' AND tipo = 'blog' OR tipo = 'paginas' AND status = '1' AND url_amigavel <> '$slug_trat' ORDER BY rand() LIMIT 2";
	$exc = $pdo->query($sql);
	$cnt = $exc->rowCount();
	$array 	= $exc->fetchAll(PDO::FETCH_ASSOC);	

	return array('array' => $array, 'contador' => $cnt);

}

function franqueado(){

	global $pdo;

	$slug_franquia = $_SERVER['REQUEST_URI'];
	$slug_franquia = explode('/', $slug_franquia);
	$slug_franquia = $slug_franquia[2];

	$sql = "SELECT * FROM tb_paginas WHERE url_amigavel = '$slug_franquia'";
	$exc = $pdo->query($sql);
	$cnt = $exc->rowCount();
	$array 	= $exc->fetchAll(PDO::FETCH_ASSOC);

	if($cnt == 1)
		return array('array' => $array, 'contador' => $cnt);
	else
		die("<script>location.href = '/erro404'</script>");

}

######################################################################################
######################################################################################
######################################################################################

function trat_faqs( $parametro ){

	global $pdo;

	$sql = "SELECT * FROM tb_faqs WHERE id_pagina = '$parametro' AND status = '1'";
	$exc = $pdo->query($sql);
	$cnt = $exc->rowCount();
	$array 	= $exc->fetchAll(PDO::FETCH_ASSOC);

	return array('array' => $array, 'contador' => $cnt);

}

function trat_all_faqs(){

	global $pdo;

	$sql = "SELECT * FROM tb_faqs WHERE id_pagina = '99999' AND status = '1'";
	$exc = $pdo->query($sql);
	$cnt = $exc->rowCount();
	$array 	= $exc->fetchAll(PDO::FETCH_ASSOC);

	return array('array' => $array, 'contador' => $cnt);

}

function slider_trat(){

	global $pdo;

	$sql = "SELECT * FROM tb_paginas WHERE tipo = 'tratamentos' AND status = '1'";
	$exc = $pdo->query($sql);
	$cnt = $exc->rowCount();
	$array 	= $exc->fetchAll(PDO::FETCH_ASSOC);

	return array('array' => $array, 'contador' => $cnt);

}

######################################################################################
######################################################################################
######################################################################################

function depoimentos(){

	global $pdo;

	$sql = "SELECT * FROM tb_depoimentos WHERE status = '1'";
	$exc = $pdo->query($sql);
	$cnt = $exc->rowCount();
	$array 	= $exc->fetchAll(PDO::FETCH_ASSOC);

	return array('array' => $array, 'contador' => $cnt);

}

######################################################################################
######################################################################################
######################################################################################

function carrega_estados(){

	global $pdo;
	// $sql = "SELECT * FROM tb_clinicas tc, state st WHERE tc.estado = st.id GROUP BY tc.estado";
	$sql = "SELECT * FROM tb_clinicas tc, city ct WHERE tc.cidade = ct.id";
	$exc = $pdo->query($sql);
	$array = $exc->fetchAll();

	echo '<select id="tcidades"  name="cidades" class="Cycle fs-18">';
		echo '<option selected>Selecione uma cidade ...</option>';
		foreach ($array as $arr) {
			echo '<option value="'.$arr['id'].'" '.(($arr['id'] == '4314902') ? "selected='selected'" : "" ).'>'.$arr['name'].'</option>';
		}
    echo '</select>';

}

function clinica_inicial(){

	global $pdo;

	// $sql = "SELECT tb_clinicas.*, city.name AS ctnm FROM tb_clinicas, city WHERE tb_clinicas.estado = '43' AND tb_clinicas.cidade = '4314902' AND status = '1'";
	$sql = "SELECT tb_clinicas.*, city.name AS ctnm FROM tb_clinicas, city WHERE tb_clinicas.cidade = '4314902' AND tb_clinicas.cidade = city.id AND status = '1'";
	$exc = $pdo->query($sql);
	$cnt = $exc->rowCount();
	$array = $exc->fetchAll(PDO::FETCH_ASSOC);

	
	return array('array' => $array, 'contador' => $cnt);

}

function carrega_clinicas($parametro){

	include('/home/axitech/www/dent/admin/classes/Database.php');
	$pdo = Database::connect();

	if(!$pdo) { echo 'Não conectado'; }

	$sql = "SELECT tb_clinicas.*, city.name AS ctnm FROM tb_clinicas, city WHERE tb_clinicas.cidade = '$parametro' AND tb_clinicas.cidade = city.id AND status = '1'";
	$exc = $pdo->query($sql);
	$cnt = $exc->rowCount();
	$array = $exc->fetchAll(PDO::FETCH_ASSOC);

	$i = 0;
	foreach ($array as $arr) { $i++; ?>
		<div class="<?php if(($i % 2 == 0) && ($i < 4)) { echo 'rodape-direito'; } else { echo 'rodape'; } ?> ajuste_<?php echo $i; ?>" style="min-height:304px">
			<p class="cyti Cycle fs-22 azul-claro"><?php if($i == 1) { echo $arr['ctnm']; } ?></p><br />
			<p class="Cycle fs-14 branco">
				<?php echo $arr['end_linha_um']; ?>
				<br><?php echo $arr['end_linha_dois']; ?>
				<br>
				<span class="Cycle fs-20 branco"><?php echo $arr['telefone_um']; ?>
					<br /><?php echo $arr['telefone_dois']; ?>
					<img src="http://dent.axitech.com.br/imagens/wapps.jpg" alt="">
				</span>
				<br />
				<a href="<?php echo $arr['coordenadas']; ?>" target="_blank" style="color:#2ca3d2 !important">Localize no mapa</a>
			</p>
			<p class="Cycle fs-12 branco">
				<?php echo $arr['responsavel']; ?>
				<br /><?php echo $arr['cro']; ?>
				<br /><?php echo $arr['info_adicional']; ?>
			</p>
			<div id="mapa-popup" class="white-popup mfp-hide">
				Localize no mapa
			</div>	
		</div>
	<?php }

}

######################################################################################
######################################################################################
######################################################################################

function popup_contato(){

	include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/assets/phpmailer/PHPMailerAutoload.php');
	include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/classes/Database.php');
	$pdo = Database::connect(); 

	$nome 			= $_POST['nome'];
	$email 			= $_POST['email'];
	$telefone 		= $_POST['telefone'];
	$msgs 			= $_POST['msgs'];
	$cidade 		= "Não especificado";

	if(isset($_POST['quersaberpreco'])){
		$mensagem = "Deseja receber orçamentos e valores referente a tratamentos";
	} else {
		$mensagem = "Desejo ser atendido no dia " .$_POST['data']." de preferência ".$_POST['horario'];
		$mensagem .= "<strong> ... " . $msgs . "</strong>";
	}

	$paginaorigem 	= "Lightbox";	
	$status			= 0;

	$sql = "INSERT INTO tb_contatos VALUES ('', '$nome', '$email', '$cidade', '$telefone', '$mensagem', '$paginaorigem', '$status', NOW())";
	$exc = $pdo->query($sql);

	if($exc){

		$subject 			= 'Agendamento e Consultas - Dental Arte';
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
				<p>Você solicitou recentemente um agendamento com a Dental Arte.</p>	
				<p>Em breve entraremos em contato para confirmar a sua visita com hora marcada em nossa clínica mais próxima para sua comodidade.</p>
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

######################################################################################
######################################################################################
######################################################################################

if(isset($_POST['cidades']) && $_POST['cidades'] != ""){
	$parametro = $_POST['cidades']; carrega_clinicas($parametro);
}

if(isset($_POST["enviarpopup"]) && $_POST['enviarpopup'] != ""){
	popup_contato();
}