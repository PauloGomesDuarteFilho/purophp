<?php

ob_start();
header('Content-Type: text/html; charset=utf-8');

$senha 	= $_SESSION['usuarioPassw'];
$email 	= $_SESSION['usuarioEmail'];
$nome 	= $_SESSION['usuarioNomes'];
$nivel 	= $_SESSION['usuarioNivel'];
$ativo 	= $_SESSION['usuarioStatus'];

if(!isset($_SESSION['usuarioPassw']) &&
   !isset($_SESSION['usuarioEmail']) &&
   !isset($_SESSION['usuarioNomes']) &&
   !isset($_SESSION['usuarioNivel']) &&
   !isset($_SESSION['usuarioStatus'])
){
	unset(
	$_SESSION['usuarioPassw'],			
	$_SESSION['usuarioEmail'],			
	$_SESSION['usuarioNomes'], 		
	$_SESSION['usuarioNivel'], 
	$_SESSION['usuarioNivel'],
	$_SESSION['usuarioStatus']);
	header("Location: ../login.php");
}