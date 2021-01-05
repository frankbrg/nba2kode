<?php defined($alea) or die(header('location: ../index.php'));?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title><?=$page?></title>
	<link rel="stylesheet" type="text/css" href="<?=site_url.'/css/style.css'?>">
</head>
<body class="body body-<?=$page?>">
<header>
	<ul class="menu">
		<li class="menu-item"><a href="<?=site_url.'/?page=user-teams'?>">NBA2KODE</a></li>
		<li class="menu-item"><a href="<?=site_url.'/?page=user-teams'?>">Teams</a></li>
		<li class="menu-item"><a href="<?=site_url.'/?page=user-matches'?>">Matches</a></li>
		<li class="menu-item"><a href="<?=site_url.'/?page=deconnexion'?>">Déconnexion</a></li>
	</ul>
</header>
