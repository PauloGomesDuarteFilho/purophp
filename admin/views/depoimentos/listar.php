          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div id="page-wrapper">
             <div class="row">
              <div class="col-md-12">
               <h1 style="float:left">Depoimentos <small>Listar depoimentos</small></h1>
               <a class="floatButton btn btn-success btn-lg" href="<?php echo url_admin(); ?>depoimentos/novo">
                Inserir novo depoimento
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
                   <th width="100">Data</th>
                   <th width="200">Status</th>
                   <th width="205">Funções</th>
                 </tr>
               </thead>
               <tbody id="lista_dados">
                <?php list_all_depoimentos(); ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>  
    </div>    
  </div>