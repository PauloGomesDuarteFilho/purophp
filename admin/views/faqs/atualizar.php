	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-md-12" style="max-width:800px">
					<h1 style="float:left">Editar <small>faq ...</small></h1>
	                <a class="floatButton btn btn-success btn-lg" href="<?php echo map_url(); ?>index">
	                	Listar faqs
	                </a>
	                <div class="row">
	                	<div class="col-md-12">	
	                		<div id="msg"></div>
							<?php 
						    if(isset($_GET['funcao']) && $_GET['funcao'] == 'atualizar'){
						      if (!empty($_GET['tipo']) && 
						          !empty($_GET['funcao']) &&
						          $_GET['funcao'] == 'atualizar'){

						            $id   = $_GET['id'];
						            $tipo = $_GET['tipo'];
						            list_specific_faqs($id, $tipo);

						      }
						    }
							?>

	                	</div>
	                </div>