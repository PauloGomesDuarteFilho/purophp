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

    <title>Recuperar senha - Administração da Dental Arte</title>

    <!-- Bootstrap core CSS -->
    <link href="login/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="login/css/signin.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="login/css/login.css" rel="stylesheet">    
  </head>

  <body>
    <div class="container">
      <form id="form_lost" action="" method="POST" name="form_signin" class="form-signin">
        
        <!-- img src="http://dental.axitech.com.br/imagens/agendamento.png" alt="Dental Arte" title="Dental Arte" -->
        <h1 class="form-signin-heading center centerH1">Dental Arte - Admin</h1>
        <h4 class="form-signinheading center centerH4">SGBDARTE - Sistema de Gerenciamento Dental Arte
        <br><br><p><strong>Sua senha chegará no e-mail cadastrado no sistema.</strong></p></h4>
    
        <div id="msg"></div>

        <label for="emaillost" class="sr-only">Email address</label>
        <input type="text" id="emaillost" name="emaillost" class="form-control" placeholder="Insira o e-mail cadastrado">
        <div class="checkbox">
          <!-- label>
            <input type="checkbox" value="remember-me"> Remember me
          </label -->
        </div>
        <p><a href="login.php"><strong>Accessar área administrativa</strong></a></p>
        <input type="hidden" name="lostpass" value="lostpass" />
        <input class="btn btn-lg btn-success btn-block btn-lg" type="submit" value="Recuperar" />
      </form>
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="login/js/ie10-viewport-bug-workaround.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="admin/assets/js/admin.js"></script> 
    <script src="login/js/scripts.js"></script> 
  </body>
</html>