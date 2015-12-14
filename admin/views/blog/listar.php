          <?php

          ###################################
          $asdados  = list_all_pages();
          $topages  = $asdados['array'];
          $control  = $asdados['url_controle'];
          #####################################

          ?>

          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div id="page-wrapper">
             <div class="row">
              <div class="col-md-12">
               <h1 style="float:left">Artigos <small>Listar artigos</small></h1>
               <a class="floatButton btn btn-success btn-lg" href="<?php echo map_url(); ?>novo">
                Adicionar novo artigo
               </a>
             </div>
             <div class="col-md-12"></div>
             <div class="col-md-12">
               <div class="table-responsive">
                <table class="table table-striped">
                 <thead>
                  <tr>
                   <th width="45" class="center">ID</th>
                   <th>Título</th>
                   <th width="100">Data</th>
                   <th width="100">Status</th>
                   <th width="260">Funções</th>
                 </tr>
               </thead>
               <tbody id="lista_dados">
                <?php foreach($topages as $dado){ ?>
                  <tr>
                    <td class="center" valign="middle"><?=$dado['ID']?></td>
                    <td valign="middle"><?=$dado['titulo']?></td>
                    <td valign="middle"><?=formata_data($dado['datacad'])?></td>
                    <?php if ($dado['status'] == 0) { ?>
                      <td valign="middle"><strong>Suspenso</strong></td>
                    <?php } else if ($dado['status'] == 1) { ?>
                      <td valign="middle"><strong>Ativo</strong></td>
                    <?php } ?>
                    <td valign="middle">
                      <a href="<?php echo map_url(); ?>atualizar&tipo=<?php echo $control; ?>&funcao=atualizar&id=<?=$dado['ID']?>" class="btn btn-primary btn-primary">Editar</a>
                    <?php if ($dado['status'] == 0) { ?>
                      <a href="<?php echo map_url(); ?>index&tipo=<?php echo $control; ?>&funcao=ativar&id=<?=$dado['ID']?>" class="btn btn-primary btn-info" onclick="confirm('Tem certeza que deseja ativar esta publicação?'); return;">&nbsp;&nbsp;&nbsp;Publicar&nbsp;&nbsp;&nbsp;</a>
                    <?php } elseif ($dado['status'] == 1) { ?>
                      <a href="<?php echo map_url(); ?>index&tipo=<?php echo $control; ?>&funcao=desativar&id=<?=$dado['ID']?>" class="btn btn-primary btn-warning" onclick="confirm('Tem certeza que deseja desativar esta publicação?'); return;">Despublicar</a>
                    <?php } ?>
                      <a href="<?php echo map_url(); ?>index&tipo=<?php echo $control; ?>&funcao=excluir&id=<?=$dado['ID']?>" class="btn btn-primary btn-danger" onclick="confirm('Tem certeza que deseja excluir esta publicação?'); return;">Apagar</a>
                    </td>
                  </tr>    
                <?php } ?>              
              </tbody>
            </table>
          </div>
        </div>
      </div>  
    </div>    
  </div>