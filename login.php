<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>Acessar o painel - Administração da Dental Arte</title>

    <!-- Bootstrap core CSS -->
    <link href="login/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="login/css/signin.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="login/css/login.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <?php if(isset($_GET['senhaperdida']) && $_GET['senhaperdida'] != '') { ?>
          <form id="form_senhaperdida" action="" method="POST" name="form_signin" class="form-signin">
            
            <!-- img src="http://dental.axitech.com.br/imagens/agendamento.png" alt="Dental Arte" title="Dental Arte" -->
            <h1 class="form-signin-heading center centerH1">Dental Arte - Admin</h1>
            <h4 class="form-signinheading center centerH4">SGBDARTE - Sistema de Gerenciamento Dental Arte</h4>
        
            <div id="msglost"></div>

            <label for="l_pass" class="sr-only">Password</label>
            <input type="password" id="l_pass" name="l_pass" class="form-control" placeholder="Insira a nova senha" autocomplete="off">            
            <label for="lc_pass" class="sr-only">Password</label>
            <input type="password" id="lc_pass" name="lc_pass" class="form-control" placeholder="Confirme a nova senha" autocomplete="off">
            <div class="checkbox">
              <!-- label>
                <input type="checkbox" value="remember-me"> Remember me
              </label -->
            </div>
            <input type="hidden" name="l_usuario" value="<?php echo $_GET['usuario']; ?>">
            <input type="hidden" name="l_senha" value="<?php echo $_GET['senhaperdida']; ?>">
            <input type="hidden" name="l_novasenha" value="l_novasenha">
            <input class="btn btn-lg btn-success btn-block btn-lg" type="submit" value="Cadastrar nova senha" />
          </form>
      <?php } else { ?>
          <form id="form_signin" action="" method="POST" name="form_signin" class="form-signin">
            
            <!-- img src="http://dental.axitech.com.br/imagens/agendamento.png" alt="Dental Arte" title="Dental Arte" -->
            <h1 class="form-signin-heading center centerH1">Dental Arte - Admin</h1>
            <h4 class="form-signinheading center centerH4">SGBDARTE - Sistema de Gerenciamento Dental Arte</h4>
        
            <div id="msg"></div>

            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="text" id="usernick" name="usernick" class="form-control" placeholder="Insira o usuário"  autocomplete="off">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="passnick" name="passnick" class="form-control" placeholder="Insira a senha"  autocomplete="off">
            <div class="checkbox">
              <!-- label>
                <input type="checkbox" value="remember-me"> Remember me
              </label -->
            </div>
            <p><a href="recuperar.php" class="lostpassword"><strong>Esqueci minha senha</strong></a></p>
            <input class="btn btn-lg btn-success btn-block btn-lg" type="submit" value="Entrar" />
          </form>
      <?php } ?>
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="login/js/ie10-viewport-bug-workaround.js"></script>
    <script src="login/js/jquery.min.js"></script>
    <script src="login/js/bootstrap.min.js"></script>
    <script src="login/js/scripts.js"></script>
  </body>
</html>