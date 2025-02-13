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
			header('location: '.site_url.'/?page=user-teams');
			die();
		}
		$error=0;
		if( POST_('ident') && POST_('mdp') && POST_('token') ){
			$error=1;
			if(TOKEN_VERIF_(POST_('token'),'reirhergreh')){
				$error=2;
				if(verif_users_ident_mdp(POST_('ident'),POST_('mdp'))){
					$_SESSION['connecte']=true;
					header('location: '.site_url.'/?page=user-teams');
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
	case 'user-matche':
		if(!SESSION_('connecte')){
			header('location: '.site_url.'/?page=connexion');
			die();
		}
		$error=Matches::type();
		$matches=false;
		if(GET_('id')){
			$matches_id=intval(GET_('id'));
			$matches=Bdd::prepare([
				'type'=>'SELECT',
				'table'=>'matches',
				'retour'=>'matches_id,matches_date,matches_location,teams_id_one,teams_id_two',
				'where'=>[
					['matches_id',$matches_id,'INT'],
				],
			]);
		}
		include __VUES_DIR__.'/user-header.php';
		include __VUES_DIR__.'/user-matche.php';
		include __VUES_DIR__.'/user-footer.php';
	break;
	case 'user-team-delete':
		if(!SESSION_('connecte')){
			header('location: '.site_url.'/?page=connexion');
			die();
		}
		$error=Teams::type();
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
		include __VUES_DIR__.'/user-user-teams.php';
		include __VUES_DIR__.'/user-footer.php';
		
		header('location: '.site_url.'/?page=user-teams');
	break;
	case 'user-teams':
		if(!SESSION_('connecte')){
			header('location: '.site_url.'/?page=connexion');
			die();
		}
		$teams=Bdd::prepare([
			'type'=>'SELECT-ALL',
			'table'=>'teams',
			'retour'=>'teams_id,teams_name,teams_city',
			'order'=>[
				['teams_id','DESC'],
			],
		]);
		include __VUES_DIR__.'/user-header.php';
		include __VUES_DIR__.'/user-teams.php';
		include __VUES_DIR__.'/user-footer.php';
	break;
	case 'user-matches':
		if(!SESSION_('connecte')){
			header('location: '.site_url.'/?page=connexion');
			die();
		}
		$matches=Bdd::prepare([
			'type'=>'SELECT-ALL',
			'table'=>'matches',
			'retour'=>'matches_id,matches_date,matches_location,teams_id_one,teams_id_two',
			'order'=>[
				['matches_id','DESC'],
			],
		]);

		for ($i=0; $i < count($matches); $i++) { 
			$sql=Bdd::prepare([
				'type'=>'SELECT',
				'table'=>'teams',
				'retour'=>'teams_name',
				'where'=>[
					['teams_id',intval($matches[$i]['teams_id_one']),'INT'],
				],
			]);
			$matches[$i]['teams_id_one'] = $sql['teams_name'];
		}

		for ($i=0; $i < count($matches); $i++) { 
			$sql=Bdd::prepare([
				'type'=>'SELECT',
				'table'=>'teams',
				'retour'=>'teams_name',
				'where'=>[
					['teams_id',intval($matches[$i]['teams_id_two']),'INT'],
				],
			]);
			$matches[$i]['teams_id_two'] = $sql['teams_name'];
		}

		include __VUES_DIR__.'/user-header.php';
		include __VUES_DIR__.'/user-matches.php';
		include __VUES_DIR__.'/user-footer.php';
	break;
	case 'user-matche-delete':
		if(!SESSION_('connecte')){
			header('location: '.site_url.'/?page=connexion');
			die();
		}
		$error=Matches::type();
		$matche=false;
		if(GET_('id')){
			$matches_id=intval(GET_('id'));
			$matche=Bdd::prepare([
				'type'=>'DELETE',
				'table'=>'matches',
				'where'=>[
					['matches_id',$matches_id,'INT'],
				],
			]);
		}
		include __VUES_DIR__.'/user-header.php';
		include __VUES_DIR__.'/user-user-matches.php';
		include __VUES_DIR__.'/user-footer.php';
		
		header('location: '.site_url.'/?page=user-matches');
	break;
	case 'json':
		
		//include __VUES_DIR__.'/user-header.php';
		include __VUES_DIR__.'/json.php';
		//include __VUES_DIR__.'/user-footer.php';
	break;

	/*case 'jsonTS':
		if(!SESSION_('connecte')){
			header('location: '.site_url.'/?page=connexion');
			die();
		}
		include __VUES_DIR__.'/user-header.php';
		include __VUES_DIR__.'/json.ts';
		include __VUES_DIR__.'/user-footer.php';
	break;*/

	default:
		header('location: '.site_url.'/?page=404');
		die();
	break;

}
