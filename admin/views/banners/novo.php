	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-md-12" style="max-width:638px">
					<h1 style="float:left">Adicionar <small>banner ...</small></h1>
	                <a class="floatButton btn btn-success btn-lg" href="<?php echo map_url(); ?>index">
	                	Listar banners
	                </a>
					<form action="" id="inserir_banner" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-12"><div id="msg"></div></div>
							<div class="col-md-12">
								<label for="campanha">Nome da campanha</label>
								<input type="text" name="campanha" class="form-control" required><br>
								<div class="row">
									<div class="col-md-6">
										<label for="destino">Link de destino</label>
										<input type="text" name="destino" class="form-control" required>
									</div>
									<div class="col-md-6">
										<label for="status">Status do banner</label>
										<select name="status" class="form-control" required>
												<option value="">Selecione uma opção...</option>
												<option value="0">Em revisão</option>
												<option value="1">Publicado</option>
										</select>	
									</div>
								</div><br>
								<label for="frase1">Insira o título ou chamada</label>
								<input type="text" name="frase1" class="form-control" required><br>
								<label for="frase2">Insira o subtítulo ou chamada</label>
								<input type="text" name="frase2" class="form-control" required><br>
								<label for="arquivo">Insira a imagem destacada do banner ... ela deve ter exatamente 960x440 pixels</label>								
								<input type="file" name="arquivo" id="arquivo" class="form-control" required><br>								
								<input type="hidden" name="insere_banner"><br>								
								<input type="submit" name="insert_banner" value="Adicionar banner" class="btn btn-success btn-lg btn-block">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>  
	</div>    
</div>