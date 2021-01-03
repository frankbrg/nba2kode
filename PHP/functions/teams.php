<?php defined($alea) or die(header('location: ../index.php'));

class Teams{

	public static function type(){
		switch(POST_('type')){
			case 'insert':
				$values=[
					['teams_name',POST_('teams_name'),'STR'],
					['teams_city',POST_('teams_city'),'STR'],
				];
				for($i=0;$i<count($values);$i++){
					if(!$values[$i][1]){
						return 2;
					}
				}
				if(!Bdd::prepare([
					'type'=>'SELECT',
					'table'=>'teams',
					'retour'=>'teams_id',
					'order'=>[['teams_id','DESC']],
					'where'=>[['teams_name',POST_('teams_name'),'STR']],
				])){
					Bdd::prepare([
						'type'=>'INSERT',
						'table'=>'teams',
						'values'=>$values,
					]);
					$retour=Bdd::prepare([
						'type'=>'SELECT',
						'table'=>'teams',
						'retour'=>'teams_id',
						'order'=>[['teams_id','DESC']],
						'where'=>[['teams_name',POST_('teams_name'),'STR']],
					]);
					if($retour){
						$_SESSION['success']=1;
						header('location: '.site_url.'/?page=user-team&id='.$retour['teams_id']);
						die();
					}
				}
				return 3;
			break;
			case 'update':
				$values=[
					['teams_name',POST_('teams_name'),'STR'],
					['teams_city',POST_('teams_city'),'STR'],
				];
				$name_old=POST_('teams_name_old');
				$name=POST_('teams_name');
				for($i=0;$i<count($values);$i++){
					if(!$values[$i][1]){
						return 2;
					}
				}
				if(!$name_old){
					return 2;
				}
				$verifname=true;
				if($name!=$name_old){
					if(Bdd::prepare([
						'type'=>'SELECT',
						'table'=>'teams',
						'retour'=>'teams_id',
						'order'=>[['teams_id','DESC']],
						'where'=>[['teams_name',$name,'STR']],
					])){
						$verifname=false;
					}
				}
				var_dump($values);
				if(Bdd::prepare([
					'type'=>'SELECT',
					'table'=>'teams',
					'retour'=>'teams_id',
					'order'=>[['teams_id','DESC']],
					'where'=>[['teams_id',POSTINT_('teams_id'),'INT']],
				])&&$verifname){
					var_dump(POSTINT_('teams_id'));
					return 1;
				}
				return 3;
			break;
			case 'trash':
				if(POST_('teams_id')){
					$teams_id=intval(POST_('teams_id'));
					if(Bdd::prepare([
						'type'=>'SELECT',
						'table'=>'teams',
						'retour'=>'teams_id',
						'order'=>[
							['teams_id','DESC'],
						],
						'where'=>[
							['teams_id',$teams_id,'INT'],
						],
					])){
						Bdd::prepare([
							'type'=>'DELETE',
							'table'=>'teams',
							'where'=>[
								['teams_id',$teams_id,'INT'],
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

	private function getTeams(){
		$sql=Bdd::prepare([
			'type'=>'SELECT-ALL',
			'table'=>'teams',
			'retour'=>'teams_id, teams_name',
			'order'=>[
				['teams_id','DESC'],
			],
		]);
		for ($i=0; $i < count($sql); $i++) { 
			$teams[$sql[$i]['teams_id']] = $sql[$i]['teams_name'];
		}
		return $teams;
	}

	public function generateCombobox($active, $name){
		$comboBox = '<select name="'.$name.'">';
		$values = $this->getTeams();

		foreach ($values as $id => $value) {
			if ($id == $active) {
				$comboBox .= '<option value="'.$id.'" selected>'.$value.'</option>';
			} else {
				$comboBox .= '<option value="'.$id.'">'.$value.'</option>';
			}
		}
		$comboBox .= '</select>';

		return $comboBox;
	}
}
