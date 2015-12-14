          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div id="page-wrapper">
             <div class="row">
              <div class="col-md-12" style="max-width:800px">
               <h1 style="float:left">Depoimentos <small>Inserir depoimento</small></h1>
               <a class="floatButton btn btn-success btn-lg" href="<?php echo map_url(); ?>index">
                Listar depoimentos 
              </a>
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-12 infos_cadastro" style="max-width:800px">
              <div class="row">
                <div class="col-md-12">
                  <div class="branco radius pp15">
                    <?php 
                      echo '<h4>Insira um depoimento para ser mostrado no site ...</h4><br>';
                      echo '<form action="" id="cad_deps" method="POST" enctype="application/x-www-form-urlencoded">';
                      echo '<div class="row">';
                      echo '<div class="col-md-8">';
                      echo '<label for="nome">Nome: </label>';
                      echo '<input type="text" name="nome" class="form-control" value="" required><br>';
                      echo '<label for="email">E-mail: </label>';
                      echo '<input type="text" name="email" class="form-control" value="" required><br>';
                        echo '<div class="row">';
                          echo '<div class="col-md-8">';
                            echo '<label for="profissao">Profissão: </label>';
                            echo '<input type="text" name="profissao" class="form-control" value="" required>';
                          echo '</div>';
                          echo '<div class="col-md-4">';
                            echo '<label for="idade">Idade: </label>';
                            echo '<select name="idade" class="form-control">';
                            for($num = 0; $num <= 100; $num++){
                              ?><option value="<?=$num?>" <?php if($num == 18){ echo "selected"; }; ?>><?=$num?></option><?php
                            }
                            echo '</select>';
                          echo '</div>';
                        echo '</div><br>';                  
                      echo '<label for="idade">Publicado: </label>';
                      echo '<select id="publicado" name="publicado" class="form-control">';
                        echo '<option value="">Selecione um status...</option>';
                        echo '<option value="0">Em revisão</option>';
                        echo '<option value="1">Publicado</option>';
                      echo '</select><br>';
                      echo '</div>';
                      echo '<div class="col-md-12">';
                      echo '<label for="depoimento">Comentário:</label>';
                      echo '<textarea name="depoimento" class="form-control" cols="30" rows="5" required></textarea><br>';
                      echo '<input type="hidden" name="cad_depoimentos" value="inserirdepoimento">';
                      echo '<div id="msg"></div>';
                      echo '<input type="submit" class="btn btn-success btn-block btn-lg" value="Adicionar depoimento">';
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