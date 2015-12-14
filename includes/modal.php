<div id="agende-popup" class="white-popup mfp-hide">
	<div id="agendamento">
		<div id="msg"></div>
		<form action="" method="POST" id="agendarpopup" enctype="application/x-www-form-urlencoded">
			<label for="nome" class="novalinha">Nome: </label>
			<input type="text" name="nome" required>	
			<div class="fiftycent floatleft">
				<label for="email" class="novalinha">E-mail: </label>
				<input type="text" name="email" required>	
			</div>
			<div class="fiftycent floatright">
				<label for="telefone" class="novalinha">Telefone: </label>
				<input type="text" id="telefone" name="telefone" style="width:89%!important" required>
			</div>
			<div class="fiftycent floatleft">
				<label for="data" class="novalinha">Data desejada: </label>
				<input type="text" id="datahora" name="data" required>				
			</div>			
			<div class="fiftycent floatright">
				<label for="horario" class="novalinha">Horário: </label>
				<input type="text" name="horario" id="horario" style="width:89%!important" required>			
			</div>
			<label for="msgs">Memsagem: </label>
			<textarea name="msgs" id="msgs" rows="4" required></textarea>
			<div class="clear"></div>
			<input type="hidden" name="enviarpopup" value="enviarpopup">
			<button type="submit" class="enviar">
				<img src="imagens/bota_contato.png" alt="Enviar contato para Dental Arte">
			</button>
		</form>
	</div>
</div>		
<div id="verpreco-popup" class="white-popup mfp-hide">
	<div id="agendamento">
		<div id="msg"></div>
		<form action="" method="POST" id="agendarpopup" enctype="application/x-www-form-urlencoded">
			<label for="nome" class="novalinha">Nome: </label>
			<input type="text" name="nome" required>	
			<label for="email" class="novalinha">E-mail: </label>
			<input type="text" name="email" required>	
			<label for="telefone" class="novalinha">Telefone: </label>
			<input type="text" id="othertelefone" name="telefone" required>
			<input type="hidden" id="datahora" name="data">				
			<input type="hidden" id="horario" name="horario" value="">
			<div class="clear"></div>
			<input type="hidden" name="enviarpopup" value="enviarpopup">
			<input type="hidden" name="quersaberpreco" value="quersaberpreco">
			<button type="submit" class="enviar">
				<img src="imagens/bota_contato.png" alt="Enviar contato para Dental Arte">
			</button>
		</form>
	</div>
</div>
<div id="endereco-popup" class="white-popup mfp-hide">
		Localização das clínicas
</div>
<div id="test-popup" class="white-popup mfp-hide">
	Localize no mapa
</div>	