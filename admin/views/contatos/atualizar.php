	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div id="page-wrapper">
			<div class="row">
	  			<div class="col-md-12" style="max-width:800px">
	  				<h1 style="float:left">Contatos <small>Enviar e-mail ...</small></h1>
	  				<a class="floatButton btn btn-success btn-lg" href="<?php echo map_url(); ?>index">
	  					Listar contatos
	  				</a>
	  			</div>
  				<div class="col-md-12"></div>
  				<div class="col-md-12 infos_cadastro" style="max-width:800px">
					<div class="branco radius pp15">
					<?php 
						if(isset($_GET['funcao']) && $_GET['funcao'] == 'lereresponder'){
						    if (!empty($_GET['tipo']) && 
						        !empty($_GET['funcao']) &&
						        $_GET['funcao'] == 'lereresponder'){

						        $id = $_GET['id'];
						        $tipo = $_GET['tipo'];
						        list_specific_contatos($id, $tipo);

						    }
						}
					?>
					</div>
				</div>
			</div>
		</div>  
	</div>    
</div>