	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-md-12" style="max-width:638px">
					<h1 style="float:left">Novo <small>artigo ...</small></h1>
					<a class="floatButton btn btn-success btn-lg" href="<?php echo map_url(); ?>index">Listar artigos</a>
				</div>
				<div class="col-md-12" style="max-width:638px">
					<form action="" id="artigos" name="artigos" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-6">
								<label for="titulo">Título: </label>
								<input type="text" name="titulo" class="form-control bott" required>

								<label for="subtitulo">Subtítulo: </label>
								<input type="text" name="subtitulo" class="form-control bott" required>

								<label for="status">Status do artigo: </label>
								<select name="status" id="status" class="form-control" required>
									<option value="">Selecione um status</option>
									<option value="1">Publicado</option>
									<option value="0">Em revisão</option>
								</select>
							</div>
							<div class="col-md-6">
								<label for="categorias">Categorias: </label>
								<input type="text" id="tags" name="categorias" class="form-control" required><br>

								<label for="arquivo">Imagem destacada: </label>
								<input type="file" id="arquivo" name="arquivo" class="form-control bott" required>
							</div>
						</div>
						<label for="destacada">Conteúdo: </label>
						<textarea name="conteudo" id="conteudo" cols="30" rows="10"></textarea><br>
						<input name="image" type="file" id="upload" class="hidden" onchange="">
						<input type="hidden" name="inserir_conteudo_bpt" value="inserir_conteudo_bpt" >
						<input type="hidden" name="conteudo_tipo" value="blog" >
						<input type="submit" name="novo_artigo" class="btn btn-success btn-lg  btn-block" value="Adicionar artigo">
					</form>
				</div>
			</div>
		</div>  
	</div>    
</div>