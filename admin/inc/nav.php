  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
     <div class="container-fluid">
      <div class="navbar-header">
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo url_admin(); ?>home/index">
        Dental Arte - Administração
      </a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
     <ul class="nav navbar-nav navbar-right">
      <li><a href="<?php echo url_admin(); ?>configs/index">Configurações</a></li>
      <li><a href="<?php echo url_admin(); ?>usuarios/perfil=ID">Perfil</a></li>
      <li><a href="<?php echo url_admin(); ?>logout.php">Logout</a></li>
    </ul>
    <form class="navbar-form navbar-right">
      <input type="text" class="form-control" placeholder="Pesquisar...">
    </form>
  </div>
</div>
</nav>