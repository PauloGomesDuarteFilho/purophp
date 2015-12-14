	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-md-12" style="max-width:800px">
					<h1 style="float:left">Nova <small>clínica ...</small></h1>
					<a class="floatButton btn btn-success btn-lg" href="<?php echo map_url(); ?>index">Listar clínicas</a>
				</div>
				<div class="col-md-12" style="max-width:800px">	
					<form action="" id="clinicas" name="clinicas" method="POST" enctype="multipart/form-data">

						<div id="msg"></div>

						<label for="nome_clinica">Nome da clínica: </label>
						<input type="text" name="nome_clinica" class="form-control" required><br>

						<div class="row">
							<div class="col-md-6">
								<label for="end_1">Endereço (linha 1): </label>
								<input type="text" name="end_1" class="form-control" required>	
							</div>
							<div class="col-md-6">
								<label for="end_2">Endereço (linha 2): </label>
								<input type="text" name="end_2" class="form-control">	
							</div>
						</div><br>
							<?php populando_estados(); ?>
							<div class="col-md-6">
								<label for="cidades">Selecione uma cidade: </label>
								<select name="cidades" id="cidades" class="form-control" required>
									<option value="">Selecione uma cidade ...</option>
								</select>
							</div>
						</div><br>

						<div class="row">
							<div class="col-md-6">
								<label for="tel_1">Telefone: </label>
								<input type="text" id="tel_1" name="tel_1" class="form-control" required>	
							</div>
							<div class="col-md-6">
								<label for="end_2">Telefone adicional: </label>
								<input type="text" id="tel_2" name="tel_2" class="form-control">	
							</div>
						</div><br>

						<div class="row">
							<div class="col-md-12">
								<label for="coordenadas">Latitude e longitude do endereço no Google Maps. Ex: -20.437453, -54.557214</label>
								<input type="text" name="coordenadas" class="form-control" required>
							</div>
						</div><br>

						<div class="row">
							<div class="col-md-12">
								<label for="responsavel">Responsável pela clínica - Atuação: </label>
								<input type="text" name="responsavel" class="form-control" required>
							</div>
						</div><br>

						<div class="row">
							<div class="col-md-6">
								<label for="cro">CRO do responsável: </label>
								<input type="text" name="cro" class="form-control" required>
							</div>							
							<div class="col-md-6">
								<label for="info_adicional">Informção adicional. Ex: EPAO </label>
								<input type="text" name="info_adicional" class="form-control">
							</div>
						</div><br>

						<div class="row">
							<div class="col-md-12">
								<label for="status">Esta clínica vai aparecer no site?</label>
								<select name="status" class="form-control" required>
									<option value="">Selecione uma opção ...</option>
									<option value="0">Não</option>
									<option value="1">Sim</option>
								</select>
							</div>
						</div><br>
						
						<input type="hidden" name="nova_clinica" value="nova_clinica">
						<input type="submit" name="nova_clinica" class="btn btn-success btn-lg btn-block" value="Adicionar clínica">
					</form>
				</div>
			</div>
		</div>  
	</div>    
</div>