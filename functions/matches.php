<?php defined($alea) or die(header('location: ../index.php'));

class Matches{
//TODO
	public static function type(){
		switch(POST_('type')){
			case 'insert':
				$values=[
					['matches_date',POST_('matches_date'),'STR'],
					['matches_location',POST_('matches_location'),'STR'],
					['teams_id_one',POSTINT_('teams_id_one'),'INT'],
					['teams_id_two',POSTINT_('teams_id_two'),'INT'],
				];
				for($i=0;$i<count($values);$i++){
					if(!$values[$i][1]){
						return 2;
					}
				}
				if(!Bdd::prepare([
					'type'=>'SELECT',
					'table'=>'matches',
					'retour'=>'matches_id',
					'order'=>[['matches_id','DESC']],
					'where'=>[['matches_date',POST_('matches_date'),'STR']],
				])){
					Bdd::prepare([
						'type'=>'INSERT',
						'table'=>'matches',
						'values'=>$values,
					]);
					$retour=Bdd::prepare([
						'type'=>'SELECT',
						'table'=>'matches',
						'retour'=>'matches_id',
						'order'=>[['matches_id','DESC']],
						'where'=>[['matches_date',POST_('matches_date'),'STR']],
					]);
					if($retour){
						$_SESSION['success']=1;
						header('location: '.site_url.'/?page=user-matche&id='.$retour['matches_id']);
						die();
					}
				}
				return 3;
			break;
			case 'update':
				$values=[
					['matches_date',POST_('matches_date'),'STR'],
					['matches_location',POST_('matches_location'),'STR'],
					['teams_id_one',POSTINT_('teams_id_one'),'INT'],
					['teams_id_two',POSTINT_('teams_id_two'),'INT'],
				];
				$date_old=POST_('matches_date_old');
				$date=POST_('matches_date');
				for($i=0;$i<count($values);$i++){
					if(!$values[$i][1]){
						return 2;
					} 
				}
				if(!$date_old){
					return 3;
				}
				$verifdate=true;
				if($date!=$date_old){
					if(Bdd::prepare([
						'type'=>'SELECT',
						'table'=>'matches',
						'retour'=>'matches_id',
						'order'=>[['matches_id','DESC']],
						'where'=>[['matches_date',$date,'STR']],
					])){
						$verifdate=false;
					}
				}

				if(Bdd::prepare([
					'type'=>'SELECT',
					'table'=>'matches',
					'retour'=>'matches_id',
					'order'=>[['matches_id','DESC']],
					'where'=>[['matches_id',POSTINT_('matches_id'),'INT']],
				])&&$verifdate){
					Bdd::prepare([
						'type'=>'UPDATE',
						'table'=>'matches',
						'values'=>$values,
						'where'=>[['matches_id',POSTINT_('matches_id'),'INT']],
					]);
					return 1;
				}
				return 4;
			break;
			case 'trash':
				if(POST_('matches_id')){
					$matches_id=intval(POST_('matches_id'));
					if(Bdd::prepare([
						'type'=>'SELECT',
						'table'=>'matches',
						'retour'=>'matches_id',
						'order'=>[
							['matches_id','DESC'],
						],
						'where'=>[
							['matches_id',$matches_id,'INT'],
						],
					])){
						Bdd::prepare([
							'type'=>'DELETE',
							'table'=>'matches',
							'where'=>[
								['matches_id',$matches_id,'INT'],
							],
						]);
						return true;
					}
				}
				return false;
			break;
		}
		return false;
	}


}
