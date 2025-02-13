<?php defined($alea) or die(header('location: ../index.php'));

function verif_users_ident_mdp($ident=false,$mdp=false){
	sleep(rand(.2,.5));
	if(is_string($ident)&&is_string($mdp)){
		$retour=Bdd::prepare([
			'type'=>'SELECT',
			'table'=>'users',
			'retour'=>'users_pwd',
			'where'=>[
				['users_ident',$ident,'STR'],
			],
		]);
		if($retour){
			return password_verify($mdp,$retour['users_pwd']);
		}
	}
	return false;
}
