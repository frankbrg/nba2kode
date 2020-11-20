<?php defined($alea) or die(header('location: ../index.php'));

$page = GET_('page');
// echo SESSION_('connecte');
switch($page){
	case false:
		include __VUES_DIR__.'/header.php';
		include __VUES_DIR__.'/home.php';
		include __VUES_DIR__.'/footer.php';
	break;
	case 'connexion':
		include __VUES_DIR__.'/header.php';
		include __VUES_DIR__.'/connexion.php';
		include __VUES_DIR__.'/footer.php';
	break;
	default:
		header('location: '.site_url.'/?page=404');
		die();
	break;
}
