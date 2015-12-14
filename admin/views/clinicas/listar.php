          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div id="page-wrapper">
             <div class="row">
              <div class="col-md-12">
               <h1 style="float:left">Clínicas <small>Listar clínicas</small></h1>
               <a class="floatButton btn btn-success btn-lg" href="<?php echo map_url(); ?>novo">
                Adicionar nova clínica
               </a>
             </div>
             <div class="col-md-12"></div>
             <div class="col-md-12">
               <div class="table-responsive">
                <table class="table table-striped">
                 <thead>
                  <tr>
                   <th width="45" class="center">ID</th>
                   <th>Nome da clínica</th>
                   <th>Endereço</th>
                   <th width="260">Funções</th>
                 </tr>
               </thead>
               <tbody id="lista_dados">
                <?php listar_all_clinicas(); ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>  
    </div>    
  </div>