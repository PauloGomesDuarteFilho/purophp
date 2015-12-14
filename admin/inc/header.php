<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="http://realfavicongenerator.net/demo_favicon_sample.png">

	<title>Painel administrativo</title>

	<!-- Bootstrap core CSS -->
	<link href="<?php echo url_admin(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="<?php echo url_admin(); ?>assets/css/dashboard.css" rel="stylesheet">    

	<!-- Custom styles for this template -->
	<link href="<?php echo url_admin(); ?>assets/css/customs.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="<?php echo url_admin(); ?>assets/css/signin.css" rel="stylesheet">    

	<!-- Custom styles for this template -->
	<link href="<?php echo url_admin(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo url_admin(); ?>assets/css/css-tags.css" rel="stylesheet">

    <script src="<?php echo url_admin(); ?>assets/js/jquery.min.js?<?=geraSenha()?>"></script>
    <script src="<?php echo url_admin(); ?>assets/js/jquery.input-tags.js?<?=geraSenha()?>"></script>
	<script type="text/javascript">

	    function onAddTag(tag) {
	      alert("Added a tag: " + tag);
	    }
	    function onRemoveTag(tag) {
	      alert("Removed a tag: " + tag);
	    }

	    function onChangeTag(input,tag) {
	      alert("Changed a tag: " + tag);
	    }

	    jQuery(function($) {

	      	$('#tags').tagsInput({width:'auto'});

	    });

	</script>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>