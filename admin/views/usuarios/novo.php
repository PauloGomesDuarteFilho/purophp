	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-md-12" style="max-width:800px">
					<h1 style="float:left">Adicionar <small>usuário ...</small></h1><hr>
	                <a class="floatButton btn btn-success btn-lg" href="<?php echo map_url(); ?>index">
	                	Listar usuários
	                </a>
	            </div>
	            <div class="col-md-12" style="max-width:800px">
					<form action="" id="upusuario" name="upusuario" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-12"><div id="msg"></div></div>
							<div class="col-md-12">
								<label for="nome">Nome completo</label>
								<input type="text" name="nome" value="" class="form-control bott">

								<label for="email">E-mail de acesso</label>
								<input type="email" name="email" value="" class="form-control bott" required>
							</div>							
							<div class="col-md-6">
								<label for="nome">Senha</label>
								<input type="text" name="senha" value="" class="form-control bott" required>
							</div>							
							<div class="col-md-6">
								<label for="nome">Confirmar senha</label>
								<input type="text" name="csenha" value="" class="form-control bott" required>
							</div>
							<div class="col-md-6">
								<label for="nivel">Nível de acesso</label>
								<select name="nivel" class="form-control" required>
									<option value="">Selecione nível de acesso...</option>
									<option value="0">Administrador</option>
									<option value="1">Usuário</option>
								</select>
							</div>							
							<div class="col-md-6">
								<label for="status">Status do perfil</label>
								<select name="status" class="form-control" required>
									<option value="">Selecione status da conta...</option>
									<option value="0">Desativado</option>
									<option value="1">Ativado</option>
								</select>							
							</div>
							<div class="col-md-12">								
								<label for="enviar"></label>
								<input type="hidden" name="addUsuario">
								<input type="submit" name="novousuario" class="btn btn-success btn-block btn-lg" value="Adicionar usuário">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>  
	</div>    
</div>