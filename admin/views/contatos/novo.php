<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  	<div id="page-wrapper">
  		<div class="row">
  			<div class="col-md-12" style="max-width:800px">
  				<h1 style="float:left">Contatos <small>Enviar e-mail</small></h1>
  				<a class="floatButton btn btn-success btn-lg" href="<?php echo map_url(); ?>index">
  					Listar contatos
  				</a>
  			</div>
  			<div class="col-md-12"></div>
  			<div class="col-md-12 infos_cadastro" style="max-width:800px">
  				<div class="row">
  					<div class="col-md-12">
  						<div class="branco radius pp15">
							<?php 
							    echo '<h4>Envie uma mensagem de forma simples e rápida ...</h4><br>';
							    echo '<form action="" id="respondercontato" method="POST" enctype="application/x-www-form-urlencoded">';
							      echo '<div class="row">';
							        echo '<div class="col-md-8">';
									  echo '<label for="assunto">Nome: </label>';
									  echo '<input type="text" name="nome" class="form-control" value="" required><br>';
									  echo '<label for="assunto">E-mail: </label>';
							          echo '<input type="text" name="email" class="form-control" value="" required><br>';
							          echo '<label for="assunto">Assunto da mensagem: </label>';
							          echo '<input type="text" class="form-control" name="assunto" required><br>';
							        echo '</div>';
							        echo '<div class="col-md-12">';
							          echo '<label for="assunto">Corpo da mensagem</label>';
							          echo '<textarea name="mensagem" class="form-control" cols="30" rows="5" required></textarea><br>';
							          echo '<input type="hidden" name="respondercontato" value="respondercontato">';
							            echo '<div id="msg"></div>';
							            echo '<input type="submit" class="btn btn-success btn-block btn-lg" value="Enviar e-mail">';
							        echo '</div>';
							      echo '</div>';
							    echo '</form>';
							?>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>  
  	</div>    
</div>