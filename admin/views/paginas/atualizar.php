	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-md-12" style="max-width:638px">
					<h1 style="float:left">Editar <small>página ...</small></h1>
	                <a class="floatButton btn btn-success btn-lg" href="<?php echo map_url(); ?>index">
	                	Listar páginas
	                </a>
	                <span class="clear floatPreview"><?php preview($_GET['id'], $_GET['tipo']); ?></span>
	            </div>
	            <div class="col-md-12" style="max-width:638px">
					<?php 
				    if(isset($_GET['funcao']) && $_GET['funcao'] == 'atualizar'){
				        if (!empty($_GET['tipo']) && 
				            !empty($_GET['funcao']) &&
				            $_GET['funcao'] == 'atualizar'){

			              	$id   = $_GET['id'];
			              	$tipo = $_GET['tipo'];
			              	list_upt_btp_conteudo($id, $tipo); 
				        }
				    }
					?>
				</div>
			</div>
		</div>  
	</div>    
</div>