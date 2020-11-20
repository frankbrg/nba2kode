<?php defined($alea) or die(header('location: ../index.php'));?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title><?=$page?></title>
	<link rel="stylesheet" type="text/css" href="<?=site_url.'/css/style.css'?>">
</head>
<body class="body-<?=$page?>">
<header>
	<a href="<?=site_url.'/?page=deconnexion'?>">deconnexion</a>
	<a href="<?=site_url.'/?page=tableau-de-bord'?>">Mon tableau de bord</a>
	<a href="<?=site_url.'/?page=admin-utilisateurs'?>">Liste des utilisateurs</a>
</header>
