			</div>
				<div class="full-bgfooter">
					<div class="content-ftr">
						<div class="atend">
							<a href="">
								<img src="<?=url_site(); ?>imagens/atend-online.png" alt="logo" />
							</a>
						</div>
						<p class="title-rdp Oswald fs-26 branco fw700">
						<?php 

						$theclinicas = clinica_inicial();
						$theclinicasdados = $theclinicas['array'];
						$theclinicascount = $theclinicas['contador'];

						?>	
						Encontre uma clínica Dental Arte mais próxima de você.
						</p>
						<div class="rodape">
							<?php carrega_estados(); ?>
						</div>
						<div id="todas_clinicas">
						<?php
						$i = 0;
						foreach ($theclinicasdados as $arr) { $i++; ?>
							<div class="<?php if(($i % 2 == 0) && ($i < 4)) { echo 'rodape-direito'; } else { echo 'rodape'; } ?> ajuste_<?php echo $i; ?>" style="min-height:304px">
								<p class="cyti Cycle fs-22 azul-claro"><?php if($i == 1) { echo $arr['ctnm']; } ?></p><br />
								<p class="Cycle fs-14 branco">
									<?php echo $arr['end_linha_um']; ?>
									<br><?php echo $arr['end_linha_dois']; ?>
									<br>
									<span class="Cycle fs-20 branco"><?php echo $arr['telefone_um']; ?>
										<br /><?php echo $arr['telefone_dois']; ?>
										<img src="<?=url_site(); ?>imagens/wapps.jpg" alt="">
									</span>
									<br />
									<a href="<?php echo $arr['coordenadas']; ?>" target="_blank" style="color:#2ca3d2 !important">Localize no mapa</a>
								</p>
								<p class="Cycle fs-12 branco">
									<?php echo $arr['responsavel']; ?>
									<br /><?php echo $arr['cro']; ?>
									<br /><?php echo $arr['info_adicional']; ?>
								</p>
								<div id="link-popup" class="white-popup mfp-hide">
									<a class="link_localize" href="<?php echo $arr['coordenadas']; ?>" target="_blank" style="color:#2ca3d2 !important">
										Localize no mapa
									</a>	
								</div>									
							</div>
						<?php } ?>
						</div>
						<div class="clear"></div>
						<div class="facebook floatleft" style="width:480px; height:178px">
							<div class="fb-page" data-href="https://www.facebook.com/dentalarte" data-tabs="timeline" data-width="480" data-height="178" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true">
								<div class="fb-xfbml-parse-ignore">
									<blockquote cite="https://www.facebook.com/dentalarte">
										<a href="https://www.facebook.com/dentalarte">Dental Arte</a>
									</blockquote>
								</div>
							</div>
						</div>
						<div class="facebook floatright" style="width:480px; height:178px">
							<div class="final" style="width:480px">
								<p class="Cycle fs-14 branco fw700 txtcenter">De segunda a sexta-feira das 08:00 às 20:00<br />
								Aos sábados 08:00 às 13:00</p>
							</div>	
							<div class="final" style="width:480px">
								<div class="redess" style="width: 325px">
									<a href="https://www.facebook.com/dentalarte" target="_blank"><img src="<?=url_site(); ?>imagens/icon-face.jpg" /></a>
									<a href="" target="_blank"><img src="<?=url_site(); ?>imagens/icon-twitter.jpg" /></a>
									<a href="" target="_blank"><img src="<?=url_site(); ?>imagens/icon-googleplus.jpg" /></a>
									<a href="" target="_blank"><img src="<?=url_site(); ?>imagens/icon-linkedin.jpg" /></a>
								</div>
							</div>
						</div>					
					</div><!-- //.content-ftr -->
					<div class="fundo">
						<div class="final">
							<p class="Cycle fs-14 branco floatleft">Desenvolvido por <a class="Cycle fs-14 azul-claro" href="http://altcode.com.br" target="_blank">Alt Grupo</a></p>
						</div>
						<div class="final">
							<!-- p class="Cycle fs-14 branco fw700">De segunda a sexta-feira das 08:00 às 20:00<br />
							Aos sábados 08:00 às 13:00</p -->
						</div>
						<!-- div class="final">
							<a href="https://www.facebook.com/dentalarte" target="_blank"><img src="<?=url_site(); ?>imagens/icon-face.jpg" /></a>
							<a href="" target="_blank"><img src="<?=url_site(); ?>imagens/icon-twitter.jpg" /></a>
							<a href="" target="_blank"><img src="<?=url_site(); ?>imagens/icon-googleplus.jpg" /></a>
							<a href="" target="_blank"><img src="<?=url_site(); ?>imagens/icon-linkedin.jpg" /></a>
						</div -->
					</div>
				</div><!-- //.full-bgfooter -->
			</div><!-- //.interface -->
		</div><!-- //.full-color -->
		<a id="toTop" class="toTop"><img src="<?=url_site(); ?>imagens/totop.png" alt=""></a>
		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="<?=url_site(); ?>js/jquery-ui/jquery-ui.min.js?v=<?=geraSenha();?>"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.js"></script>
		<script src="<?=url_site(); ?>js/jquery.slides.min.js?v=<?=geraSenha();?>"></script>
		<script src="<?=url_site(); ?>js/slick/slick.min.js?v=<?=geraSenha();?>"></script>
		<script src="<?=url_site(); ?>js/jquery.magnific-popup.min.js?v=<?=geraSenha();?>"></script>
		<script src="<?=url_site(); ?>js/jquery.maskedinput.min.js?v=<?=geraSenha();?>"></script>
		<script src="<?=url_site(); ?>js/scripts.js?v=<?=geraSenha();?>"></script>
	</body>
</html>