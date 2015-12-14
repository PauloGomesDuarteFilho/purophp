          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div id="page-wrapper">
             <div class="row">
              <div class="col-md-12">
               <h1 style="float:left">Contatos <small>Listar mensagens</small></h1>
               <a class="floatButton btn btn-success btn-lg" href="novo">
                Enviar uma mensagem
               </a>
             </div>
             <div class="col-md-12"></div>
             <div class="col-md-12">
               <div class="table-responsive">
                <table class="table table-striped">
                 <thead>
                  <tr>
                   <th width="45" class="center">ID</th>
                   <th>Nome</th>
                   <th>E-mail</th>
                   <th width="100">Recebimento</th>
                   <th width="150">Status</th>
                   <th width="222">Funções</th>
                 </tr>
               </thead>
               <tbody id="lista_dados">
                <?php list_all_contatos('tb_contatos'); ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>  
    </div>    
  </div>