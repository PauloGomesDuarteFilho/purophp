<?php 

require('header.php');
#############################################
$tratAllFaqs 	= trat_all_faqs();
$dadosfaqs		= $tratAllFaqs['array'];
$countfaqs 		= $tratAllFaqs['contador'];
########################################## ?>

<div id="faq" class="clear2">
	<div id="aparelhos-titulo-pagina">
		<p class="Oswald fs-38 azul fw700">PERGUNTAS FREQUENTES (FAQ)</p>
	</div>
	<?php if($countfaqs >= 1) : ?>
		<?php foreach ($dadosfaqs as $dadosfaq) : ?>
			<div class="question">
				<div class="q">
					<p class="fs-16 Cycle"><?=$dadosfaq['pergunta']?></p>	
				</div>
				<div class="s">
					<a href="#" class="mostra_resposta">
						<img class="ativar" src="imagens/acessa-servico-desativado.png" alt="">
					</a>
				</div>
				<div class="resposta">
					<p class="Cycle fs-16"><?=$dadosfaq['resposta']?></p>
				</div>
			</div>
		<?php endforeach ?>
	<?php else : ?>
		<div class="question">
			<div class="q">
				<p class="fs-16 Cycle">Nenhuma faq cadastrada no banco de dados.</p>	
			</div>
			<div class="s">
				<a href="#" class="mostra_resposta">
					<img class="ativar" src="imagens/acessa-servico-desativado.png" alt="">
				</a>
			</div>
			<div class="resposta">
				<p class="Cycle fs-16"><?=$dadosfaq['resposta']?></p>
			</div>
		</div>
	<?php endif; ?>
	<div class="clear" style="margin-bottom:50px"></div>
</div>

<?php include('footer.php'); ?>