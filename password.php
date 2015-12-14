<?php 

function encrypt_pass($parametro)
{
	$parametro 	= md5($parametro);
	$senhadb 	= md5($parametro);
	return $senhadb;
}

echo encrypt_pass('3755d43776');