<?php

    # Configurações
    # Esta separação de 3 linhas apresentada abaixo representa a separação
    # das sessões da área administrativa do site que tem as funcionalidades
    # para cada parte do sistema de backednd e frontend.
    ######################################################################  
    ###################################################################### 
    ######################################################################  

    # Funções de uso abstrato em qualquer parte do sistema
    # Formata a data do banco de dados para data hora do Brasil
    function formata_data( $datacad ){
        $datacad = explode(' ', $datacad);
        $datacad = $datacad[0];
        $datacad = explode("-", $datacad);
        $datacad = $datacad[2]."-".$datacad[1]."-".$datacad[0];
        return $datacad;
    }

    # Troca o paramentro status das tabelas do banco de dados
    # executando a tarefa de habilitar ou ativar quando status = 0
    # executando a tarefa de desabilitar ou desativar quando status = 1
    function ativar(){

        global $pdo;
        $pages = array('blog', 'tratamentos', 'paginas');

        if(in_array($_GET['tipo'], $pages)){

            $pdo->query("UPDATE tb_paginas SET status = 1 WHERE ID = " . $_GET['id'] . "");

        }

        $pdo->query("UPDATE tb_" . $_GET['tipo'] . " SET status = 1 WHERE ID = " . $_GET['id'] . "");

          echo "
              <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
              <script type=\"text/javascript\">
                alert(\"O regitro foi ativado com sucesso.\");
          ";

    }    

    function desativar(){

      global $pdo;
      $pages = array('blog', 'tratamentos', 'paginas');

        if(in_array($_GET['tipo'], $pages)){

            $pdo->query("UPDATE tb_paginas SET status = 0 WHERE ID = " . $_GET['id'] . "");

        }

        $pdo->query("UPDATE tb_" . $_GET['tipo'] . " SET status = 0 WHERE ID = " . $_GET['id'] . "");

          echo "
              <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
              <script type=\"text/javascript\">
                alert(\"O regitro foi desativado com sucesso.\");
          ";

    }

    # Exclui qualquer tipo de registro no banco de dados
    # executando a função DELETE de forma generalizada
    function excluir(){

      global $pdo;
      $pages = array('blog', 'tratamentos', 'paginas');

      if(in_array($_GET['tipo'], $pages)){

          $pdo->query("DELETE FROM tb_paginas WHERE ID = " . $_GET['id'] . "");

          echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
            <script type=\"text/javascript\">
              alert(\"O registro foi excluido com sucesso.\");
          ";

          print_r($pdo);

      } else {

          $pdo->query("DELETE FROM tb_" . $_GET['tipo'] . " WHERE ID = " . $_GET['id'] . "");

          echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
            <script type=\"text/javascript\">
              alert(\"O registro foi excluido com sucesso.\");
          ";

          print_r($pdo);

      }

    }

    ######################################################################  
    ######################################################################  
    ######################################################################

    # Populando estados
    function populando_estados(){

        global $pdo;
        
        $sql = "SELECT * FROM state ORDER BY name ASC";

        echo '<div class="row">';
          echo '<div class="col-md-6">';
            echo '<label for="estados">Escolha um estado: </label>';
            echo '<select name="estados" id="estados" class="form-control" required>';
              echo '<option value="">Selecione um estado ...</option>' ;
              foreach ($pdo->query($sql) as $estado) {
                echo '<option value="'.$estado['id'].'">'. $estado['name'] . ' ' . '(' .$estado['uf']. ')' .'</option>';
              }
            echo '</select>';
          echo '</div>';

    }

    ######################################################################  
    ######################################################################  
    ######################################################################

    # Sessão Conteúdo
    # Listagem de conteúdos presentes no sistema
    function list_all_pages() {

        global $pdo;

        $url_controle = $_SERVER['REQUEST_URI'];
        $url_controle = explode('/', $url_controle);
        $url_controle = $url_controle[2];

        $sql    = "SELECT * FROM tb_paginas WHERE tipo = '$url_controle' ORDER BY ID DESC";
        $exc    = $pdo->query($sql);
        $cnt    = $exc->rowCount();
        $array  = $exc->fetchAll(PDO::FETCH_ASSOC);

        return array('array' => $array, 'url_controle' => $url_controle);

    }

    # Cadastro de artigos, tratamentos e páginas 
    # como conteúdo no banco de dados
    function inserir_conteudo_bpt(){
          
        $titulo       = trim($_POST['titulo']);
        $subtitulo    = trim($_POST['subtitulo']);
        $conteudo     = trim($_POST['conteudo']);
        $arquivo      = $_FILES['arquivo']['name'];
        $categorias   = trim($_POST['categorias']);
        $autor        = $_POST['autor'];
        $tipo         = $_POST['conteudo_tipo'];
        $status       = $_POST['status'];
        $friendlyurl  = friendly_url($_POST['titulo']);
        $datacad      = date('Y-m-d H:i:s');

        /*
        list($width, $height) = getimagesize($tmp_imagem);

        echo '<strong>Width: </strong>' . $width . '<br>';
        echo '<strong>Height:  </strong>' . $height . '<br>';
        echo '<strong>Nome da imagem:  </strong>' . $_FILES['arquivo']['name'] . '<br>';
        echo '<strong>Arquivo temporário:  </strong>' . $_FILES['arquivo']['tmp_name'] . '<br>';
        echo '<strong>Tipo da imagem:  </strong>' . $_FILES['arquivo']['type'] . '<br>';
        echo '<strong>Erro:  </strong>' . $_FILES['arquivo']['error'] . '<br>';
        echo '<strong>Tamanho em bytes:  </strong>' . $_FILES['arquivo']['size'] . '<br>';
        */
       
        //Pasta onde o arquivo vai ser salvo
        $_UP['pasta'] = '../admin/images/';
        
        //Tamanho máximo do arquivo em 3MB
        $_UP['tamanho'] = 1024 * 1024 * 0.3;
         //3mb
        
        //Array com as extensoes permitidas
        $_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');
        
        //Renomeia o arquivo? (se true, o arquivo será salvo como .jpg e em nome único)
        $_UP['renomeia'] = true;
        
        //Array com os tipos de erros de upload do PHP
        $_UP['erros'][0] = 'Não houve erro';
        $_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
        
        //Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
        if ($_FILES['arquivo']['error'] != 0) {
            die("Não foi possivel fazer o upload, erro: <br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
            exit;   
        }
        
        //Faz a verificação da extensao do arquivo
        $extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
        
        if (array_search($extensao, $_UP['extensoes']) === false) {
          echo "
          <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://dent.axitech.com.br/admin/blog/novo'>
          <script type=\"text/javascript\">
          alert(\"Por favor, envie arquivos coma as seguintes extensões: png, jpg, jpeg e gif.\");
          </script>
        ";
        }
        
        //Faz a verificação do tamanho do arquivo
        else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
          echo "
          <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
          <script type=\"text/javascript\">
          alert(\"O arquivo é muito grande. Escolha um arquivo menor e envie novamente.\");
          </script>
        ";

        } else {
                
            //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
            $imagem = md5($_FILES['arquivo']['name'].time()) . '.jpg';
            
            //Verificar se é possivel mover o arquivo para a pasta escolhida
            if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $imagem)) {

                global $pdo;

                $sql          = "INSERT INTO tb_paginas VALUES ('', '$titulo', '$subtitulo', '$conteudo', '$imagem', '$categorias', '$autor', '$tipo', '$status', '$friendlyurl', '$datacad')";
                $query        = $pdo->query($sql);

                if($query == true){

                    echo "
                      <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
                      <script type=\"text/javascript\">
                        alert(\"Cadastro do artigo efetuado com sucesso.\");
                        window.location = \"/admin/$tipo/index\";
                      </script>
                    ";

                }

            } else {
           
              //Upload não efetuado com sucesso, exibe a mensagem
              echo "
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
                <script type=\"text/javascript\">
                alert(\"A imagem não foi processada e o conteúdo não pôde ser inserido.\");
                window.location = \"/admin/blog/index\";
                </script>
              ";
            }

        }

    }

    function list_upt_btp_conteudo($id, $tipo){

      global $pdo;

      $sql          = "SELECT * FROM tb_paginas WHERE ID = '$id'";
      $query        = $pdo->query($sql);
      $contador     = $query->rowCount();
      $resultado    = $query->fetch();

      echo '<form action="" id="upt_artigos" method="POST" enctype="multipart/form-data">';
        echo '<div class="row">';
          echo '<div class="col-md-6">';
            echo '<label for="titulo">Título: </label>';
            echo '<input type="text" name="titulo" value="'.$resultado['titulo'].'" class="form-control bott" required>';

            echo '<label for="subtitulo">Ordem no menu: </label>';
            echo '<select name="subtitulo" id="subtitulo" class="form-control" required>';
            for ($i = 1; $i < 100; $i++) {
                  echo '<option value="'.$i.'">'.$i.'</option>';
            }
            echo '</select><br>';

            echo '<label for="status">Status do artigo: </label>';
            echo '<select name="status" id="status" class="form-control" required>';
              echo '<option value="">Selecione uma opção ...</option>';
              echo '<option value="1" '.(($resultado['status'] == 1) ? 'selected="selected"' : "").'>Publicado</option>';
              echo '<option value="0" '.(($resultado['status'] == 0) ? 'selected="selected"' : "").'>Em revisão</option>';
            echo '</select>';
          echo '</div>';
          echo '<div class="col-md-6">';
            echo '<label for="categorias">Categorias: </label>';
            echo '<input type="text" id="tags" name="categorias" value="'.$resultado['categoria'].'" class="form-control" required><br>';

            echo '<label for="arquivo">Imagem destacada: </label>';
            echo '<input type="file" id="arquivo" name="arquivo" class="form-control bott">';
          echo '</div>';
        echo '</div>';
        echo '<label for="destacada">Conteúdo: </label>';
        echo '<textarea name="conteudo" id="conteudo" cols="30" rows="10">'.$resultado['conteudo'].'</textarea><br>';
        echo '<input name="image" type="file" id="upload" class="hidden" onchange="">';
        echo '<input type="hidden" name="conteudo_id" value="'.$id.'">';
        echo '<input type="hidden" name="conteudo_tipo" value="'.$tipo.'">';
        echo '<input type="hidden" name="atualizar_conteudo_bpt" value="atualizar_conteudo_bpt" >';
        echo '<input type="submit" name="upt_artigos" class="btn btn-success btn-lg right" onclick="return confirm(\'Tem certeza que deseja efetuar a atualização do conteúdo?\');" value="Atualizar conteúdo">';
      echo '</form>';

    }

    function atualizar_conteudo_bpt() {

        $id           = trim($_POST['conteudo_id']);
        $titulo       = trim($_POST['titulo']);
        $subtitulo    = trim($_POST['subtitulo']);
        $conteudo     = trim($_POST['conteudo']);
        $arquivo      = $_FILES['arquivo']['name'];
        $categorias   = trim($_POST['categorias']);
        $autor        = "Dental Arte";
        $tipo         = $_POST['conteudo_tipo'];
        $friendlyurl  = friendly_url($_POST['titulo']);
        $status       = $_POST['status'];
        $datacad      = date('Y-m-d H:i:s');

        if(isset($_FILES['arquivo']) && $_FILES['arquivo']['name'] != null) {

            //Pasta onde o arquivo vai ser salvo
            $_UP['pasta'] = '../admin/images/';
            
            //Tamanho máximo do arquivo em 3MB
            $_UP['tamanho'] = 1024 * 1024 * 0.3;
            
            //Array com as extensoes permitidas
            $_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');
            
            //Renomeia o arquivo? (se true, o arquivo será salvo como .jpg e em nome único)
            $_UP['renomeia'] = true;
            
            //Array com os tipos de erros de upload do PHP
            $_UP['erros'][0] = 'Não houve erro';
            $_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
            $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
            $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
            $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
            
            //Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
            if ($_FILES['arquivo']['error'] != 0) {
                die("Não foi possivel fazer o upload, erro: <br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
                exit;   
            }
            
            //Faz a verificação da extensao do arquivo
            $extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
            
            if (array_search($extensao, $_UP['extensoes']) === false) {
              echo "
              <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://dent.axitech.com.br/admin/blog/novo'>
              <script type=\"text/javascript\">
              alert(\"Por favor, envie arquivos coma as seguintes extensões: png, jpg, jpeg e gif.\");
              </script>
            ";
            }
            
            //Faz a verificação do tamanho do arquivo
            else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
              echo "
              <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
              <script type=\"text/javascript\">
              alert(\"O arquivo é muito grande. Escolha um arquivo menor e envie novamente.\");
              </script>
            ";

            } else {
                    
                //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
                $imagem = md5($_FILES['arquivo']['name'].time()) . '.jpg';
                
                //Verificar se é possivel mover o arquivo para a pasta escolhida
                if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $imagem)) {

                    global $pdo;

                    $sql          = "UPDATE tb_paginas SET titulo = '$titulo', subtitulo = '$subtitulo', conteudo = '$conteudo', imagem = '$imagem', categoria = '$categorias', autor = '$autor', tipo = '$tipo', status = '$status', url_amigavel = '$friendlyurl', datacad = '$datacad' WHERE ID = '$id'";
                    $query        = $pdo->query($sql);

                    if($query == true){

                        echo "
                          <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
                          <script type=\"text/javascript\">
                            alert(\"Cadastro do artigo efetuado com sucesso.\");
                            window.location = \"/admin/$tipo/index\";
                          </script>
                        ";

                    }

                } else {
               
                  //Upload não efetuado com sucesso, exibe a mensagem
                  echo "
                    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
                    <script type=\"text/javascript\">
                    alert(\"A imagem não foi processada e o conteúdo não pôde ser inserido.\");
                    window.location = \"/admin/blog/index\";
                    </script>
                  ";
                }

            }

        } else {

            global $pdo;

            $sql          = "UPDATE tb_paginas SET titulo = '$titulo', subtitulo = '$subtitulo', conteudo = '$conteudo', categoria = '$categorias', autor = '$autor', tipo = '$tipo', status = '$status', url_amigavel = '$friendlyurl', datacad = '$datacad' WHERE ID = '$id'";
            $query        = $pdo->query($sql);

            if($query == true){

                echo "
                  <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
                  <script type=\"text/javascript\">
                    alert(\"Atualização do conteúdo efetuada com sucesso.\");
                    window.location = \"/admin/$tipo/index\";
                  </script>
                ";

            } else {

                echo "
                  <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
                  <script type=\"text/javascript\">
                    alert(\"Não foi possível atualizar o conteúdo.\");
                    window.location = \"/admin/$tipo/index\";
                  </script>
                ";

            }

        }

    }

    ######################################################################  
    ######################################################################  
    ######################################################################

    # Sessão clínicas
    function listar_all_clinicas(){

      global $pdo;

      $sql          = "SELECT * FROM tb_clinicas ORDER BY ID DESC";
      $query        = $pdo->query($sql);
      $contador     = $query->rowCount();

      if($contador >= 1){
          foreach ($query as $linha) { ?>
          <tr>
            <td class="center" valign="middle"><?php echo $linha['ID']; ?></td>
            <td valign="middle"><?php echo $linha['nome_clinica']; ?></td>
            <td valign="middle"><?php echo $linha['end_linha_um']; ?></td>

            <td valign="middle">

            <a href="<?php echo map_url(); ?>atualizar&tipo=clinicas&funcao=atualizar&id=<?=$linha['ID']; ?>" class="btn btn-primary btn-primary">Editar</a>
            <?php if($linha['status'] == 0) { ?>
              <a href="<?php echo map_url(); ?>index&tipo=clinicas&funcao=ativar&id=<?=$linha['ID']; ?>" class="btn btn-primary btn-info" onclick="return confirm('Tem certeza que deseja habilitar esta clínica?');">&nbsp;&nbsp;Habilitar&nbsp;&nbsp;</a>
            <?php } elseif ($linha['status'] == 1) { ?>
              <a href="<?php echo map_url(); ?>index&tipo=clinicas&funcao=desativar&id=<?=$linha['ID']; ?>" class="btn btn-primary btn-warning" onclick="return confirm('Tem certeza que deseja desabilitar esta clínica?');">Desabilitar</a>
            <?php } ?>
            <a href="<?php echo map_url(); ?>index&tipo=clinicas&funcao=excluir&id=<?=$linha['ID']; ?>" class="btn btn-primary btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta clínica?');">Apagar</a>

            </td>

          </tr>
        <?php 

        } 

      } else {
          echo '<tr>';
            echo '<td colspan="5">Nenhuma clínica foi encontrada. <a href="'.map_url().'novo"><strong>Inserir clínica.</strong></a></td>';
          echo '</tr>';
      }

    }

    ######################################################################  
    ######################################################################  
    ######################################################################

    # Sessão Usuários
    # Retornando a listagem de usuários cadastrados no sistema
    function listar_usuarios(){

      global $pdo;

      $sql          = "SELECT * FROM tb_usuarios ORDER BY ID DESC";
      $query        = $pdo->query($sql);
      $contador     = $query->rowCount();

      if($contador >= 1){
          foreach ($query as $linha) { ?>
          <tr>
            <td class="center" valign="middle"><?php echo $linha['ID']; ?></td>
            <td valign="middle"><?php echo $linha['nome']; ?></td>
            <td valign="middle"><?php echo $linha['email']; ?></td>
            <td valign="middle"><?php echo formata_data($linha['datacad']); ?></td>

            <?php if($linha['status'] == 0) { ?>
              <td valign="middle"><strong>Suspenso</strong></td>
            <?php } else if ($linha['status'] == 1) { ?>
              <td valign="middle"><strong>Ativo</strong></td>
            <?php } ?>

            <?php if($linha['nivel'] == 0) { ?>
              <td valign="middle"><strong>Administrador</strong></td>
            <?php } elseif ($linha['nivel'] == 1) { ?>
              <td valign="middle"><strong>Usuário</strong></td>
            <?php } ?>

            <td valign="middle">
            <!-- a href="<?php echo map_url(); ?>index&tipo=usuarios&funcao=atualizar&id=<?php // echo $linha['ID']?>" class="btn btn-primary btn-primary" onclick="return confirm('Deseja realmente atualizar este cadastro?'); return;">Editar</a -->
            <a href="<?php echo map_url(); ?>atualizar&tipo=usuarios&funcao=atualizar&id=<?php echo $linha['ID']; ?>" class="btn btn-primary btn-primary">
              Editar
            </a>
            <?php if($linha['status'] == 0) { ?>
              <a href="<?php echo map_url(); ?>index&tipo=usuarios&funcao=ativar&id=<?=$linha['ID']; ?>" class="btn btn-primary btn-info" onclick="return confirm('Tem certeza que deseja habilitar este usuário?');">
                &nbsp;&nbsp;Habilitar&nbsp;&nbsp;
              </a>
            <?php } elseif ($linha['status'] == 1) { ?>
              <a href="<?php echo map_url(); ?>index&tipo=usuarios&funcao=desativar&id=<?=$linha['ID']; ?>" class="btn btn-primary btn-warning" onclick="return confirm('Tem certeza que deseja desabilitar este usuário?');">
                Desabilitar
              </a>
            <?php } ?>
            <a href="<?php echo map_url(); ?>index&tipo=usuarios&funcao=excluir&id=<?=$linha['ID']; ?>" class="btn btn-primary btn-danger" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">            
              Apagar
            </a>
            </td>

          </tr>
        <?php 

        } 

      } else {
          echo '<tr>';
            echo '<td colspan="5">Nenhuma publicação foi encontrada. <a href="'.map_url().'novo"><strong>Inserir artigo.</strong></a></td>';
          echo '</tr>';
      }

    }

    # Atualizando informações de usuários no banco de dados
    function atualizar_usuario(){

      global $pdo;

      $sql         = "SELECT * FROM tb_" . $_GET['tipo'] . " WHERE ID = " . $_GET['id'] . "";
      $query       = $pdo->query($sql);
      $resultado   = $query->fetch(PDO::FETCH_ASSOC);
      $contador    = $query->rowCount();

      echo '<form action="" id="upusuario" name="upusuario" method="POST" enctype="multipart/form-data">';
        echo '<div class="row">';
          echo '<div class="col-md-12"><div id="msg"></div></div>';
          echo '<div class="col-md-12">';
            echo '<label for="nome">Nome completo</label>';
            echo '<input type="text" name="nome" value="'.$resultado['nome'].'" class="form-control bott">';

            echo '<label for="email">E-mail de acesso</label>';
            echo '<input type="email" name="email" value="'.$resultado['email'].'" class="form-control bott" required>';
          echo '</div>';
          echo '<div class="col-md-6">';
            echo '<label for="nivel">Nível de acesso</label>';
            echo '<select name="nivel" class="form-control" required>';
              echo '<option value="">Selecione nível de acesso...</option>';
              echo '<option value="0" '.(($resultado['nivel'] == 0) ? 'selected="selected"' : "").'>Administrador</option>';
              echo '<option value="1" '.(($resultado['nivel'] == 1) ? 'selected="selected"' : "").'>Usuário</option>';
            echo '</select>';
          echo '</div>';
          echo '<div class="col-md-6">';
            echo '<label for="status">Status do perfil</label>';
            echo '<select name="status" class="form-control" required>';
              echo '<option value="">Selecione status da conta...</option>';
              echo '<option value="0" '.(($resultado['status'] == 0) ? 'selected="selected"' : "").'>Desativado</option>';
              echo '<option value="1" '.(($resultado['status'] == 1) ? 'selected="selected"' : "").'>Ativado</option>';
            echo '</select>';             
          echo '</div>';
          echo '<div class="col-md-4">';                
            echo '<label for="enviar"></label>';
            echo '<input type="hidden" name="updidusuario" value="'.$resultado['ID'].'">';
            echo '<input type="submit" name="updUsuario" class="btn btn-success btn-lg btn-block" value="Atualizar usuário">';
          echo '</div>';
        echo '</div>';
      echo '</form>';

    }

    ######################################################################  
    ######################################################################  
    ######################################################################

    # Sessão Contatos
    # Retornando a listagem de dados
    function list_all_contatos( $tbl ){

      global $pdo;

      $sql          = "SELECT * FROM {$tbl} ORDER BY ID DESC";
      $query        = $pdo->query($sql);
      $contador     = $query->rowCount();

      if($contador >= 1){
          foreach ($query as $linha) { ?>
          <tr>
            <td class="center" valign="middle"><?php echo $linha['ID']; ?></td>
            <td valign="middle"><?php echo $linha['nome']; ?></td>
            <td valign="middle"><?php echo $linha['email']; ?></td>
            <td valign="middle"><?php echo formata_data($linha['datacad']); ?></td>

            <?php if($linha['status'] == 0) { ?>
              <td valign="middle"><strong>Não respondida</strong></td>
            <?php } else if ($linha['status'] == 1) { ?>
              <td valign="middle"><strong>Respondida</strong></td>
            <?php } ?>

            <td valign="middle">

            <?php if($linha['status'] == 0) { ?>
              <a href="<?php echo map_url(); ?>atualizar&tipo=contatos&funcao=lereresponder&id=<?php echo $linha['ID']; ?>" class="btn btn-primary btn-primary">Ler e responder</a>
            <?php } else if ($linha['status'] == 1) { ?>
              <a href="<?php echo map_url(); ?>atualizar&tipo=contatos&funcao=lereresponder&id=<?php echo $linha['ID']; ?>" class="btn btn-primary btn-success">&nbsp;&nbsp;&nbsp;Respondida&nbsp;&nbsp;&nbsp;</a>
            <?php } ?>

            <a href="<?php echo map_url(); ?>index&tipo=contatos&funcao=excluir&id=<?=$linha['ID']; ?>" class="btn btn-primary btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta mensagem?');">Apagar</a>

            </td>

          </tr>
        <?php 

        } 

      } else {
          echo '<tr>';
            echo '<td colspan="6">Nenhum contato foi encontrado.</td>';
          echo '</tr>';
      }

    }

    function list_specific_contatos($id, $tipo){

      global $pdo;
      $tabela = "tb_".$tipo;

      $sql            = "SELECT * FROM $tabela WHERE ID = $id ORDER BY ID DESC";
      $query          = $pdo->query($sql);
      $contador       = $query->rowCount();
      $resultado      = $query->fetch();

      echo '<strong>Nome: </strong>' . '<div class="emaildados">' . $resultado['nome'] . '</div>';
      echo '<br><strong>E-mail: </strong>' . '<div class="emaildados">' . $resultado['email'] . '</div>';
      echo '<br><strong>Cidade: </strong>' . '<div class="emaildados">' . $resultado['cidade'] . '</div>';
      echo '<br><strong>Telefone: </strong>' . '<div class="emaildados">' . $resultado['telefone'] . '</div>';
      echo '<br><strong>Assunto: </strong>' . '<div class="emaildados">' . $resultado['paginaorigem'] . '</div>';

      echo '<br><br><strong>Mensagem: </strong><br>' . '<div class="justify">' . $resultado['mensagem'] . '</div>';
      echo '<hr>';
      echo '<h4>Responder a esta mensagem ...</h4><br>';
      echo '<form action="" id="respondercontato" method="POST" enctype="application/x-www-form-urlencoded">';
        echo '<div class="row">';
          echo '<div class="col-md-8">';
            echo '<label for="assunto">Assunto da mensagem</label>';
            echo '<input type="text" class="form-control" name="assunto" required><br>';
          echo '</div>';
          echo '<div class="col-md-12">';
            echo '<label for="assunto">Corpo da mensagem</label>';
            echo '<textarea name="mensagem" class="form-control" cols="30" rows="5" required></textarea><br>';
            echo '<input type="hidden" name="id" value="'.$resultado['ID'].'">';
            echo '<input type="hidden" name="nome" value="'.$resultado['nome'].'">';
            echo '<input type="hidden" name="email" value="'.$resultado['email'].'">';
            echo '<input type="hidden" name="respondercontato" value="respondercontato">';
              echo '<div id="msg"></div>';
              echo '<input type="submit" class="btn btn-success btn-block btn-lg" value="Enviar resposta">';
          echo '</div>';
        echo '</div>';
      echo '</form>';

    }

    ######################################################################  
    ######################################################################  
    ######################################################################

    # Sessão Depoimentos
    # Montado a view dos depoimentos para chamar na template listar.php
    function list_all_depoimentos(){

      global $pdo;

      $sql          = "SELECT * FROM tb_depoimentos ORDER BY ID DESC";
      $query        = $pdo->query($sql);
      $contador     = $query->rowCount();

      if($contador >= 1){

          foreach ($query as $linha) {

          echo '<tr>';
            echo '<td class="center" valign="middle">'.$linha["ID"].'</td>';
            echo '<td valign="middle">'.$linha["nome"].'</td>';
            echo '<td valign="middle">'.$linha["email"].'</td>';
            echo '<td valign="middle">'.formata_data($linha['datacad']).'</td>';
            if($linha['status'] == 0) {
              echo '<td valign="middle"><strong>Em revisão</strong></td>';
            } else if ($linha['status'] == 1) {
              echo '<td valign="middle"><strong>Publicado</strong></td>';
            } ?>
            <td valign="middle">
              <?php if($linha['status'] == 0) { ?>
              <a href="<?=map_url()?>atualizar&tipo=depoimentos&funcao=atualizar&id=<?=$linha['ID']?>" class="btn btn-primary btn-primary">Ler e aprovar</a>
              <?php } else { ?>
              <a href="<?=map_url()?>atualizar&tipo=depoimentos&funcao=atualizar&id=<?=$linha['ID']?>" class="btn btn-primary btn-success">&nbsp;&nbsp;&nbsp;Aprovado&nbsp;&nbsp;&nbsp;</a>
              <?php } ?>
              <a href="<?=map_url()?>index&tipo=depoimentos&funcao=excluir&id=<?=$linha['ID']?>" class="btn btn-primary btn-danger" onclick="return confirm('Tem certeza que deseja excluir este depoimento?');">Apagar</a><?php
            echo '</td>';
          echo '</tr>';

        } 

      } else {
          echo '<tr>';
            echo '<td colspan="6">Nenhum depoimento foi encontrado. <a href="'.map_url().'novo"><strong>Inserir depoimento.</strong></a></td>';
          echo '</tr>';
      }

    }

    # Sessão Depoimentos
    # Montado a view do depoimento para chamar na template atualizar.php
    function list_specific_depoimentos($id, $tipo){

      global $pdo;
      $sql = "SELECT * FROM tb_depoimentos WHERE ID = '$id'";
      $query = $pdo->query($sql);
      $contador = $query->rowCount();
      $resultado = $query->fetch();

      echo '<h4>Insira um depoimento para ser mostrado no site ...</h4><br>';
      echo '<form action="" id="update_deps" method="POST" enctype="application/x-www-form-urlencoded">';
      echo '<div class="row">';
      echo '<div class="col-md-8">';
      echo '<label for="nome">Nome: </label>';
      echo '<input type="text" name="nome" class="form-control" value="'.$resultado['nome'].'" required><br>';
      echo '<label for="email">E-mail: </label>';
      echo '<input type="text" name="email" class="form-control" value="'.$resultado['email'].'" required><br>';
        echo '<div class="row">';
          echo '<div class="col-md-8">';
            echo '<label for="profissao">Profissão: </label>';
            echo '<input type="text" name="profissao" class="form-control" value="'.$resultado['profissao'].'" required>';
          echo '</div>';
          echo '<div class="col-md-4">';
            echo '<label for="idade">Idade: </label>';
            echo '<select name="idade" class="form-control">';
            for($num = 0; $num <= 100; $num++){
              ?><option value="<?=$num?>" <?php if($num == $resultado['idade']){ echo "selected"; }; ?>><?=$num?></option><?php
            }
            echo '</select>';
          echo '</div>';
        echo '</div><br>';                  
      echo '<label for="idade">Publicado: </label>';
      echo '<select id="publicado" name="publicado" class="form-control">';
        echo '<option value="">Selecione uma opção...</option>';
        echo '<option value="0" ' . (($resultado['status'] == 0) ? 'selected=selected' : '') . '>Em revisão</option>';
        echo '<option value="1" ' . (($resultado['status'] == 1) ? 'selected=selected' : '') . '>Publicado</option>';
      echo '</select><br>';
      echo '</div>';
      echo '<div class="col-md-12">';
      echo '<label for="depoimento">Comentário:</label>';
      echo '<textarea name="depoimento" class="form-control" cols="30" rows="5" required>'.$resultado['depoimento'].'</textarea><br>';
      echo '<input type="hidden" name="id_dep" value="'.$resultado['ID'].'">';
      echo '<input type="hidden" name="update_deps" value="update_deps">';
      echo '<div id="msg"></div>';
      echo '<input type="submit" class="btn btn-success btn-block btn-lg" value="Aprovar depoimento">';
      echo '</div>';
      echo '</div>';
      echo '</form>';

    }

    ######################################################################  
    ######################################################################  
    ######################################################################

    # Sessão Usuários
    # Retornando a listagem de usuários cadastrados no sistema
    function listar_banners(){

      global $pdo;

      $sql          = "SELECT * FROM tb_banners ORDER BY ID DESC";
      $query        = $pdo->query($sql);
      $contador     = $query->rowCount();

      if($contador >= 1){

          foreach ($query as $linha) {

          echo '<tr>';
            echo '<td class="center" valign="middle">'.$linha['ID'].'</td>';
            echo '<td valign="middle">'.$linha['campanha'].'</td>';
            echo '<td valign="middle"><a href="'.$linha['destino'].'" target="_blank"><strong>'.$linha['destino'].'</strong></a></td>';
            echo '<td valign="middle">'.formata_data($linha['datacad']).'</td>';
            if($linha['status'] == 0) {
              echo '<td valign="middle"><strong>Inativo</strong></td>';
            } else if ($linha['status'] == 1) {
              echo '<td valign="middle"><strong>Ativo</strong></td>';
            }
            echo '<td valign="middle">'; ?>
              <a href="<?php echo map_url(); ?>atualizar&tipo=banners&funcao=atualizar&id=<?php echo $linha['ID']; ?>" class="btn btn-primary btn-primary">Editar</a>
              <?php if($linha['status'] == 0) { ?>
              <a href="<?php echo map_url(); ?>index&tipo=banners&funcao=ativar&id=<?=$linha['ID']; ?>" class="btn btn-primary btn-info" onclick="return confirm('Tem certeza que deseja habilitar este banner?');">&nbsp;&nbsp;Habilitar&nbsp;&nbsp;</a>
              <?php } elseif ($linha['status'] == 1) { ?>
              <a href="<?php echo map_url(); ?>index&tipo=banners&funcao=desativar&id=<?=$linha['ID']; ?>" class="btn btn-primary btn-warning" onclick="return confirm('Tem certeza que deseja desabilitar este banner?');">Desabilitar</a>
              <?php } ?>
              <a href="<?php echo map_url(); ?>index&tipo=banners&funcao=excluir&id=<?=$linha['ID']; ?>" class="btn btn-primary btn-danger" onclick="return confirm('Tem certeza que deseja excluir este banner?');">Apagar</a>
            <?php echo '</td>';
          echo '</tr>';

        } 

      } else {
          echo '<tr>';
            echo '<td colspan="6">Nenhum banner foi encontrado. <a href="'.map_url().'novo"><strong>Inserir banner.</strong></a></td>';
          echo '</tr>';
      }

    }
    
    function registrar_banner(){

        $campanha = $_POST['campanha'];
        $destino = $_POST['destino'];
        $status = $_POST['status'];
        $frase1 = $_POST['frase1'];
        $frase2 = $_POST['frase2'];
        $tmp_imagem = $_FILES['arquivo']['tmp_name'];

          if(isset($_FILES['arquivo']['name'])){

              list($width, $height) = getimagesize($tmp_imagem);

              $width;
              $height;
              $_FILES['arquivo']['name'];
              $_FILES['arquivo']['type'];
              $_FILES['arquivo']['error'];
              $_FILES['arquivo']['size'];

              $_UP['pasta']       = '../admin/images/';
              $_UP['tamanho']     = 1024 * 1024 * 3;
              $_UP['extensoes']   = array('png', 'jpg', 'jpeg', 'gif');
              $_UP['erros'][0]    = 'Não houve erro';
              $_UP['erros'][1]    = 'O arquivo no upload é maior que o limite do PHP';
              $_UP['erros'][2]    = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
              $_UP['erros'][3]    = 'O upload do arquivo foi feito parcialmente';
              $_UP['erros'][4]    = 'Não foi feito o upload do arquivo';

              if ($_FILES['arquivo']['error'] != 0) {

                  # die("Não foi possivel fazer o upload, erro: <br />" . $_UP['erros'][$_FILES['arquivo']['error']]); exit;
                  echo "
                    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
                    <script type=\"text/javascript\">
                    alert(\"Ocorreu um erro no upload da imagem.\");
                    </script>
                  ";

              } elseif ($width != 960 || $height != 440) {

                  echo "
                    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
                    <script type=\"text/javascript\">
                    alert(\"Tamanho inválido. Solicite ao designer uma imagem de 960x440 pixels para que ela seja compatível com os banner da página inicial.\");
                    </script>
                  ";

              } elseif ($_UP['tamanho'] < $_FILES['arquivo']['size']) {

                  echo "
                    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
                    <script type=\"text/javascript\">
                    alert(\"O arquivo é muito pesado. Escolha um arquivo menor e envie novamente.\");
                    </script>
                  ";

              } else {

                  $extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));

                  if (array_search($extensao, $_UP['extensoes']) === false) {

                    echo "
                        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
                        <script type=\"text/javascript\">
                        alert(\"O arquivo enviado é inválido e pode ser malicioso. Por favor, envie arquivos coma as seguintes extensões: png, jpg, jpeg e gif.\");
                        </script>
                    ";

                  } else {

                      $imagem = md5($_FILES['arquivo']['name'].time()) . '.jpg';

                      if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $imagem)) {

                          # echo 'A imagen foi enviada para a pasta images';
                          global $pdo;

                          $sql          = "INSERT INTO tb_banners (campanha, imagem, destino, frase1, frase2, status, datacad) VALUES ('$campanha', '$imagem', '$destino', '$frase1', '$frase2', '$status', NOW())";
                          $query        = $pdo->query($sql);
                          $contador     = $query->rowCount();

                          if(!$query){

                              echo 'O banner não foi cadastrado com sucesso.';

                          } else {

                              echo "
                                  <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
                                  <script type=\"text/javascript\">
                                  alert(\"O banner foi cadastrado com sucesso no sistema.\");
                                  </script>
                              ";

                          }

                      }

                  }

              }

          }

      }

    function list_upd_specific_banner($id, $tipo){

        global $pdo;

        $sql          = "SELECT * FROM tb_banners WHERE ID = '$id'";
        $query        = $pdo->query($sql);
        $contador     = $query->rowCount();
        $resultado    = $query->fetch();

        echo '<form action="" id="atualizar_banner" method="POST" enctype="multipart/form-data">';
          echo '<div class="row">';
            echo '<div class="col-md-12"><div id="msg"></div></div>';
            echo '<div class="col-md-12">';
              echo '<label for="campanha">Nome da campanha</label>';
              echo '<input type="text" name="campanha" value="'.$resultado['campanha'].'" class="form-control" required><br>';
              echo '<div class="row">';
                echo '<div class="col-md-6">';
                  echo '<label for="destino">Link de destino</label>';
                  echo '<input type="text" name="destino" class="form-control" value="'.$resultado['destino'].'" required>';
                echo '</div>';
                echo '<div class="col-md-6">';
                  echo '<label for="status">Status do banner</label>';
                  echo '<select name="status" class="form-control" required>';
                      echo '<option value="0"' . (($resultado['status'] == 0) ? 'selected=selected' : '') . '>Em revisão</option>';
                      echo '<option value="1"' . (($resultado['status'] == 0) ? 'selected=selected' : '') . '>Publicado</option>';
                  echo '</select>';
                echo '</div>';
              echo '</div><br>';
              echo '<label for="frase1">Insira o título ou chamada</label>';
              echo '<input type="text" name="frase1" value="'.$resultado['frase1'].'" class="form-control" required><br>';
              echo '<label for="frase2">Insira o subtítulo ou chamada</label>';
              echo '<input type="text" name="frase2" value="'.$resultado['frase2'].'" class="form-control" required><br>';
              echo '<label for="arquivo">Insira a imagem destacada do banner ... ela deve ter exatamente 960x440 pixels</label>';               
              echo '<input type="file" name="arquivo" id="arquivo" class="form-control" required><br>';           
              echo '<input type="hidden" name="atualizar_banner" value="'.$resultado['ID'].'"><br>';            
              echo '<input type="submit" name="atualiza_banner" value="Atualizar banner" class="btn btn-success btn-lg btn-block">';
            echo '</div>';
          echo '</div>';
        echo '</form>';

    }

    function atualizar_banner(){

        $id = $_POST['atualizar_banner'];
        $campanha = $_POST['campanha'];
        $destino = $_POST['destino'];
        $status = $_POST['status'];
        $frase1 = $_POST['frase1'];
        $frase2 = $_POST['frase2'];
        $tmp_imagem = $_FILES['arquivo']['tmp_name'];

        if(isset($_FILES['arquivo']['name'])){

            list($width, $height) = getimagesize($tmp_imagem);

            $width;
            $height;
            $_FILES['arquivo']['name'];
            $_FILES['arquivo']['type'];
            $_FILES['arquivo']['error'];
            $_FILES['arquivo']['size'];

            $_UP['pasta']       = '../admin/images/';
            $_UP['tamanho']     = 1024 * 1024 * 3;
            $_UP['extensoes']   = array('png', 'jpg', 'jpeg', 'gif');
            $_UP['erros'][0]    = 'Não houve erro';
            $_UP['erros'][1]    = 'O arquivo no upload é maior que o limite do PHP';
            $_UP['erros'][2]    = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
            $_UP['erros'][3]    = 'O upload do arquivo foi feito parcialmente';
            $_UP['erros'][4]    = 'Não foi feito o upload do arquivo';

            if ($_FILES['arquivo']['error'] != 0) {

                # die("Não foi possivel fazer o upload, erro: <br />" . $_UP['erros'][$_FILES['arquivo']['error']]); exit;
                echo "
                  <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
                  <script type=\"text/javascript\">
                  alert(\"Ocorreu um erro no upload da imagem.\");
                  </script>
                ";

            } elseif ($width != 960 || $height != 440) {

                echo "
                  <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
                  <script type=\"text/javascript\">
                  alert(\"Tamanho inválido. Solicite ao designer uma imagem de 960x440 pixels para que ela seja compatível com os banner da página inicial.\");
                  </script>
                ";

            } elseif ($_UP['tamanho'] < $_FILES['arquivo']['size']) {

                echo "
                  <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
                  <script type=\"text/javascript\">
                  alert(\"O arquivo é muito pesado. Escolha um arquivo menor e envie novamente.\");
                  </script>
                ";

            } else {

                $extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));

                if (array_search($extensao, $_UP['extensoes']) === false) {

                  echo "
                      <META HTTP-EQUIV=REFRESH CONTENT = '0;URL='>
                      <script type=\"text/javascript\">
                      alert(\"O arquivo enviado é inválido e pode ser malicioso. Por favor, envie arquivos coma as seguintes extensões: png, jpg, jpeg e gif.\");
                      </script>
                  ";

                } else {

                    $imagem = md5($_FILES['arquivo']['name'].time()) . '.jpg';

                    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $imagem)) {

                        # echo '<h1>'.$id.' - '.$imagem.'</h1>';
                        # echo 'A imagen foi enviada para a pasta images';
                        global $pdo;

                        $sql          = "UPDATE tb_banners SET campanha = '$campanha', destino = '$destino', status = '$status', frase1 = '$frase1', frase2 = '$frase2', imagem = '$imagem' WHERE ID = '$id'";
                        $query        = $pdo->query($sql); 

                        if(!$query){

                            echo "
                              <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
                              <script type=\"text/javascript\">
                              alert(\"O banner não foi atualizado. Tente novamente.\");
                              </script>
                            ";

                        } else {

                            echo "
                                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index'>
                                <script type=\"text/javascript\">
                                alert(\"O banner foi atualizado com sucesso no sistema.\");
                                </script>
                            ";

                        }

                    }

                }

            }

        }

    }

    ######################################################################  
    ######################################################################  
    ######################################################################

    # Foi usada para criar um dropdown select em outros
    # formulários tal como cadastro e atualização de faqs
    function listar_cad_paginas(){

        global $pdo;

        $sql    = "SELECT * FROM tb_paginas";
        $query  = $pdo->query($sql);

        echo '<label for="pagina">Escolha a página aonde este FAQ deve aparecer:</label>';
        echo '<select name="paginas" class="form-control" required>';
          echo '<option value="">Selecione uma opção ...</option>';
          echo '<option value="XX"> --- PÁGINA PERGUNTAS FREQUENTES --- </option>';
          foreach ($pdo->query($sql) as $pagina) {
            echo '<option value="'.$pagina['ID'].'">'.$pagina['titulo'].'</option>';
          }
        echo '</select>';

    }

    # Foi usada para criar um dropdown select em outros
    # formulários tal como cadastro e atualização de faqs
    function listar_upd_paginas($id){

        global $pdo;

        $pages  = "SELECT * FROM tb_paginas WHERE tipo != 'blog'";
        $faq    = "SELECT tb_faqs.*, tb_faqs.id_pagina AS idpag FROM tb_faqs WHERE tb_faqs.ID = '$id'"; 
        $query  = $pdo->query($faq);
        $faqs   = $query->fetch();
        $count  = $query->rowCount();

        echo '<label for="pagina">Escolha a página aonde este FAQ deve aparecer:</label>';
        echo '<select name="paginas" class="form-control" required>';
            echo '<option value="">Selecione uma opção ...</option>';
            echo '<option value="XX"> --- PÁGINA PERGUNTAS FREQUENTES --- </option>';            
            foreach ($pdo->query($pages) as $page) {
              echo '<option value="' . $page['ID'] . '" ' . (($faqs['idpag'] == $page['ID']) ? 'selected="selected"' : "") . '>' . $page['titulo'] . '</option>';
            }
        echo '</select><br>';

    }

    ######################################################################  
    ######################################################################  
    ######################################################################

    function listar_all_faqs(){

        global $pdo;

        $sql          = "SELECT tb_faqs.*, tb_faqs.ID AS idfaq, tb_faqs.status AS idsts, tb_paginas.*, tb_paginas.ID AS idpag FROM (tb_faqs INNER JOIN tb_paginas) WHERE tb_faqs.id_pagina = tb_paginas.ID ORDER BY tb_faqs.ID DESC";
        $query        = $pdo->query($sql);
        $contador     = $query->rowCount();

        if($contador >= 1){

            foreach ($query as $linha) {

              echo '<tr>';
                echo '<td class="center" valign="middle">'.$linha['idfaq'].'</td>';
                echo '<td valign="middle">'.$linha['pergunta'].'</td>';
                echo '<td valign="middle"><strong>'.$linha['titulo'].'</strong></td>';
                if($linha['idsts'] == 0) {
                  echo '<td valign="middle"><strong>Inativo</strong></td>';
                } else if ($linha['idsts'] == 1) {
                  echo '<td valign="middle"><strong>Ativo</strong></td>';
                }
                echo '<td valign="middle">'; ?>
                  <a href="<?php echo map_url(); ?>atualizar&tipo=faqs&funcao=atualizar&id=<?php echo $linha['idfaq']; ?>" class="btn btn-primary btn-primary">Editar</a>
                  <?php if($linha['idsts'] == 0) { ?>
                  <a href="<?php echo map_url(); ?>index&tipo=faqs&funcao=ativar&id=<?php echo $linha['idfaq']; ?>" class="btn btn-primary btn-info" onclick="return confirm('Tem certeza que deseja habilitar este FAQ?');">&nbsp;&nbsp;Habilitar&nbsp;&nbsp;</a>
                  <?php } elseif ($linha['idsts'] == 1) { ?>
                  <a href="<?php echo map_url(); ?>index&tipo=faqs&funcao=desativar&id=<?php echo $linha['idfaq']; ?>" class="btn btn-primary btn-warning" onclick="return confirm('Tem certeza que deseja desabilitar este FAQ?');">Desabilitar</a>
                  <?php } ?>
                  <a href="<?php echo map_url(); ?>index&tipo=faqs&funcao=excluir&id=<?php echo $linha['idfaq']; ?>" class="btn btn-primary btn-danger" onclick="return confirm('Tem certeza que deseja excluir este FAQ?');">Apagar</a>
                <?php echo '</td>';
              echo '</tr>';

            } 

        } else {

              echo '<tr>';
                echo '<td colspan="6">Nenhum banner foi encontrado. <a href="'.map_url().'novo"><strong>Inserir faqs.</strong></a></td>';
              echo '</tr>';

        }

    }

    function list_specific_faqs($id, $tipo){

        global $pdo;

        $sql          = "SELECT tb_faqs.*, tb_paginas.* FROM (tb_faqs INNER JOIN tb_paginas) WHERE tb_faqs.ID = '$id' AND tb_faqs.id_pagina = tb_paginas.ID";
        $query        = $pdo->query($sql);
        $resultado    = $query->fetch();
      
        echo '<div id="msg"></div>';
        echo '<form action="" id="atualizar_faq" method="POST" enctype="application/x-www-form-urlencoded">';
            echo '<label for="pergunta">Digite a pergunta:</label>';
            echo '<input type="text" name="pergunta" value="'.$resultado['pergunta'].'" class="form-control" required><br>';
            echo '<label for="resposta">Digite a resposta:</label>';
            echo '<textarea name="resposta" cols="30" rows="7" class="form-control" required>'.$resultado['resposta'].'</textarea><br>';
            listar_upd_paginas($id);
            echo '<label for="publicado">Esta pergunta será publicada?</label>';
            echo '<select name="publicado" class="form-control" required>';
                echo '<option value="">Selecione uma opção ...</option>';
                echo '<option value="0" '.(($resultado['status'] == 0) ? 'selected="selected"' : "").'>Em revisão</option>';
                echo '<option value="1" '.(($resultado['status'] == 1) ? 'selected="selected"' : "").'>Publicada</option>';
            echo '</select><br>';
            echo '<input type="hidden" name="atualiza_faq" value="atualiza_faq">';
            echo '<input type="hidden" name="faqs_id" value="' .$id. '">';
            echo '<input type="submit" class="btn btn-success btn-lg btn-block" value="Atualizar FAQ">';
        echo '</form>';

    }

    function list_update_clinica($id, $tipo){

        global $pdo;

        $sql          = "SELECT * FROM tb_clinicas WHERE ID = '$id'";
        $query        = $pdo->query($sql);
        $resultado    = $query->fetch();

        echo '<form action="" id="atualizar_clinica" name="atualizar_clinica" method="POST" enctype="multipart/form-data">';
          echo '<!-- div id="msg"></div -->';

          echo '<label for="nome_clinica">Nome da clínica: </label>';
          echo '<input type="text" name="nome_clinica" value="'.$resultado['nome_clinica'].'" class="form-control" required><br>';

          echo '<div class="row">';
            echo '<div class="col-md-6">';
              echo '<label for="end_1">Endereço (linha 1): </label>';
              echo '<input type="text" name="end_1" value="'.$resultado['end_linha_um'].'" class="form-control" required>';  
            echo '</div>';
            echo '<div class="col-md-6">';
              echo '<label for="end_2">Endereço (linha 2): </label>';
              echo '<input type="text" name="end_2" value="'.$resultado['end_linha_dois'].'" class="form-control">';
            echo '</div>';
          echo '</div><br>';

          populando_estados();

          echo '<div class="col-md-6">';
            echo '<label for="cidades">Selecione uma cidade: </label>';
            echo '<select name="cidades" id="cidades" class="form-control" required>';
              echo '<option value="">Selecione uma cidade ...</option>';
            echo '</select>';
          echo '</div>';
        echo '</div><br>';

        echo '<div class="row">';
          echo '<div class="col-md-6">';
            echo '<label for="tel_1">Telefone: </label>';
            echo '<input type="text" id="tel_1" name="tel_1" value="'.$resultado['telefone_um'].'" class="form-control" required>';
          echo '</div>';
          echo '<div class="col-md-6">';
            echo '<label for="end_2">Telefone adicional: </label>';
            echo '<input type="text" id="tel_2" name="tel_2" value="'.$resultado['telefone_dois'].'" class="form-control">'; 
          echo '</div>';
        echo '</div><br>';

        echo '<div class="row">';
          echo '<div class="col-md-12">';
            echo '<label for="coordenadas">Latitude e longitude do endereço no Google Maps. Ex: -20.437453, -54.557214</label>';
            echo '<input type="text" name="coordenadas" value="'.$resultado['coordenadas'].'" class="form-control" required>';
          echo '</div>';
        echo '</div><br>';

        echo '<div class="row">';
          echo '<div class="col-md-12">';
            echo '<label for="responsavel">Responsável pela clínica - Atuação: </label>';
            echo '<input type="text" name="responsavel" value="'.$resultado['responsavel'].'" class="form-control" required>';
          echo '</div>';
        echo '</div><br>';

        echo '<div class="row">';
          echo '<div class="col-md-6">';
            echo '<label for="cro">CRO do responsável: </label>';
            echo '<input type="text" name="cro" value="'.$resultado['cro'].'" class="form-control" required>';
          echo '</div>';              
          echo '<div class="col-md-6">';
            echo '<label for="info_adicional">Informção adicional. Ex: EPAO </label>';
            echo '<input type="text" name="info_adicional" value="'.$resultado['info_adicional'].'" class="form-control">';
          echo '</div>';
        echo '</div><br>';

        echo '<div class="row">';
          echo '<div class="col-md-12">';
            echo '<label for="status">Esta clínica vai aparecer no site?</label>';
            echo '<select name="status" class="form-control" required>';
              echo '<option value="">Selecione uma opção ...</option>';
              echo '<option value="0" '.(($resultado['status'] == 0) ? 'selected="selected"' : "").'>Não</option>';
              echo '<option value="1" '.(($resultado['status'] == 1) ? 'selected="selected"' : "").'>Sim</option>';
            echo '</select>';
          echo '</div>';
        echo '</div><br>';

        echo '<input type="hidden" name="clinica_id" value="' .$id. '">';
        echo '<input type="hidden" name="atualiza_clinica" value="atualiza_clinica">';
        echo '<input type="submit" class="btn btn-success btn-lg btn-block" value="Atualizar clínica">';
      echo '</form>';

    }

    ######################################################################  
    ######################################################################  
    ######################################################################

    function preview($id, $tipo){

        global $pdo;

        $sql    = "SELECT * FROM tb_paginas WHERE ID = '$id' AND tipo = '$tipo'";
        $exc    = $pdo->query($sql);
        $cnt    = $exc->rowCount();
        $array  = $exc->fetchAll(PDO::FETCH_ASSOC);

        if($tipo == 'paginas') { $url = "institucional"; }
        else if($tipo == 'tratamentos') { $url = "tratamentos"; }
        else if($tipo == 'blog') { $url = "blog"; }

        foreach ($array as $arr) { ?> 
            <a href="<?=url_site().$url.'/'.$arr['url_amigavel']?>" target="_blank">
                VISUALIZAR
            </a>       
        <?php }
    }

    ######################################################################  
    ######################################################################  
    ######################################################################

    if(isset($_POST['insere_banner'])){ registrar_banner(); }
    if(isset($_POST['atualiza_banner'])){ atualizar_banner(); }
    if(isset($_POST['inserir_conteudo_bpt'])){ inserir_conteudo_bpt(); }
    if(isset($_POST['atualizar_conteudo_bpt'])){ atualizar_conteudo_bpt(); }

    if(isset($_GET['funcao']) && $_GET['funcao'] == 'desativar'){
        if (!empty($_GET['tipo']) && 
            !empty($_GET['funcao']) && 
            $_GET['funcao'] == 'desativar'){

              echo $id   = $_GET['id'];
              echo $tipo = $_GET['tipo'];
              echo $url  = url_admin().$tipo.'/index';

              desativar($id, $tipo);
              header('Location: ' . $url);
        }
    }  

    if(isset($_GET['funcao']) && $_GET['funcao'] == 'ativar'){
        if (!empty($_GET['tipo']) && 
            !empty($_GET['funcao']) && 
            $_GET['funcao'] == 'ativar'){

              echo $id   = $_GET['id'];
              echo $tipo = $_GET['tipo'];
              echo $url  = url_admin().$tipo.'/index';

              ativar($id, $tipo);
              header('Location: ' . $url);
        }
    }

    if(isset($_GET['funcao']) && $_GET['funcao'] == 'atualizar'){
        if (!empty($_GET['tipo']) && 
            !empty($_GET['funcao']) &&
            $_GET['funcao'] == 'atualizar'){

              $id   = $_GET['id'];
              $tipo = $_GET['tipo'];

        }
    }

    if(isset($_GET['funcao']) && $_GET['funcao'] == 'excluir'){
        if (!empty($_GET['tipo']) && 
            !empty($_GET['funcao']) && 
            $_GET['funcao'] == 'excluir'){

              $id = $_GET['id'];
              $tipo = $_GET['tipo'];
              $url = url_admin().$tipo.'/index';

              excluir($id); 
              //header('Location: ' . $url);
        }
    }