<?php 

session_start();

unset(
$_SESSION['usuarioPassw'],			
$_SESSION['usuarioEmail'],			
$_SESSION['usuarioNomes'], 		
$_SESSION['usuarioNivel'], 
$_SESSION['usuarioNivel'],
$_SESSION['usuarioAtivo']);

session_destroy();
header("Location: ../login.php");