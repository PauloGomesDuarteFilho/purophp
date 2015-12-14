	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-md-12" style="max-width:800px">
					<h1 style="float:left">Adicionar <small>faq ...</small></h1>
	                <a class="floatButton btn btn-success btn-lg" href="<?php echo map_url(); ?>index">
	                	Listar faqs
	                </a>
	                <div class="row">
	                	<div class="col-md-12">	
	                		<div id="msg"></div>
							<form action="" id="inserir_faq" method="POST" enctype="application/x-www-form-urlencoded">
		                		<label for="pergunta">Digite a pergunta:</label>
		                		<input type="text" name="pergunta" class="form-control" required><br>
		                		<label for="resposta">Digite a resposta:</label>
		                		<textarea name="resposta" cols="30" rows="7" class="form-control" required></textarea><br>
								<?php listar_cad_paginas(); ?><br>
		                		<label for="publicado">Esta pergunta será publicada?</label>
								<select name="publicado" class="form-control" required>
									<option value="">Selecione uma opção ...</option>
									<option value="0">Em revisão</option>
									<option value="1">Publicada</option>
								</select><br>
								<input type="hidden" name="insere_faq" value="insere_faq">
								<input type="submit" class="btn btn-success btn-lg btn-block" value="Cadastrar FAQ">
							</form>
	                	</div>
	                </div>