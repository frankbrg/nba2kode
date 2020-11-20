<?php defined($alea) or die(header('location: ../index.php'));

$page = GET_('page');
// echo SESSION_('connecte');
switch($page){
	case false:
		include __VUES_DIR__.'/header.php';
		include __VUES_DIR__.'/connexion.php';
		include __VUES_DIR__.'/footer.php';
	break;
	case 'connexion':
		if(SESSION_('connecte')){
			header('location: '.site_url.'/?page=tableau-de-bord');
			die();
		}
		$error=0;
		if( POST_('ident') && POST_('mdp') && POST_('token') ){
			$error=1;
			if(TOKEN_VERIF_(POST_('token'),'reirhergreh')){
				$error=2;
				if(verif_users_ident_mdp(POST_('ident'),POST_('mdp'))){
					$_SESSION['connecte']=true;
					header('location: '.site_url.'/?page=tableau-de-bord');
					die();
				}
			}
		}
		include __VUES_DIR__.'/header.php';
		include __VUES_DIR__.'/connexion.php';
		include __VUES_DIR__.'/footer.php';
	break;
	case 'deconnexion':
		if(SESSION_('connecte')){
			session_destroy();
		}
		header('location: '.site_url.'/?page=connexion');
		die();
	break;
	case 'tableau-de-bord':
		if(!SESSION_('connecte')){
			header('location: '.site_url.'/?page=connexion');
			die();
		}
		include __VUES_DIR__.'/admin-header.php';
		include __VUES_DIR__.'/admin-tableau-de-bord.php';
		include __VUES_DIR__.'/admin-footer.php';
	break;
	default:
		header('location: '.site_url.'/?page=404');
		die();
	break;
}
