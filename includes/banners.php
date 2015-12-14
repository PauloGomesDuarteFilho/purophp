<?php 

	#########################
	$banners = pull_banner(); 
	#########################

	echo '<div id="banner" style="position:relative">';
		foreach ($banners as $banner){
			echo '<div class="o-banner relativo">';
				echo '<img class="back-top-banner" src="'.url_admin_images().$banner['imagem'].'" alt="Dental Arte">';
				echo '<div class="infos-banner">';
					echo '<p class="Oswald fs-46 azul">'.$banner['frase1'].'<br>';
						echo '<span class="bolder azul-claro">'.$banner['frase2'].'</span>';
					echo '</p>';
					echo '<a class="ler-mais-top" href="'.$banner['destino'].'"><img src="'.url_site_images().'ler_mais.png" alt=""></a>';
				echo '</div>';
			echo '</div>	';
		}
	echo '</div>';