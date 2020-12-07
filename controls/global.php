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
	case 'user-team':
		if(!SESSION_('connecte')){
			header('location: '.site_url.'/?page=connexion');
			die();
		}
		$error=Teams::type();
		echo $error;
		$team=false;
		if(GET_('id')){
			$teams_id=intval(GET_('id'));
			$team=Bdd::prepare([
				'type'=>'SELECT',
				'table'=>'teams',
				'retour'=>'teams_id,teams_name,teams_city',
				'where'=>[
					['teams_id',$teams_id,'INT'],
				],
			]);
		}
		include __VUES_DIR__.'/user-header.php';
		include __VUES_DIR__.'/user-team.php';
		include __VUES_DIR__.'/user-footer.php';
	break;
	case 'user-team-delete':
		if(!SESSION_('connecte')){
			header('location: '.site_url.'/?page=connexion');
			die();
		}
		$error=Teams::type();
		echo $error;
		$team=false;
		if(GET_('id')){
			$teams_id=intval(GET_('id'));
			$team=Bdd::prepare([
				'type'=>'DELETE',
				'table'=>'teams',
				'where'=>[
					['teams_id',$teams_id,'INT'],
				],
			]);
		}
		include __VUES_DIR__.'/user-header.php';
		include __VUES_DIR__.'/user-tableau-de-bord.php';
		include __VUES_DIR__.'/user-footer.php';
		
		header('location: '.site_url.'/?page=tableau-de-bord');
	break;
	case 'tableau-de-bord':
		if(!SESSION_('connecte')){
			header('location: '.site_url.'/?page=connexion');
			die();
		}
		$teams=Bdd::prepare([
			'type'=>'SELECT-ALL',
			'table'=>'teams',
			'retour'=>'teams_id,teams_name',
			'order'=>[
				['teams_id','DESC'],
			],
		]);
		include __VUES_DIR__.'/user-header.php';
		include __VUES_DIR__.'/user-tableau-de-bord.php';
		include __VUES_DIR__.'/user-footer.php';
	break;
	default:
		header('location: '.site_url.'/?page=404');
		die();
	break;
}
