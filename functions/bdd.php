<?php defined($alea) or die(header('location: ../index.php'));


class Bdd{

	private static $bdd_pdo=false;
	private static $op=['<','>','>=','<=','LIKE','!=','NOT LIKE','='];
	private static $update_prefix='update_';
	private static $insert_prefix='insert_';

	private static function connect(){
		if(!self::$bdd_pdo){
			try{
				self::$bdd_pdo=new PDO(
					'mysql:'.
					'host='.__DB_HOST__.';'.
					'dbname='.__DB_NAME__,
					__DB_USER__,
					__DB_PASSWORD__,
					[
						PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
						PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES '.__DB_CHARSET__
					]
				);
			}catch(PDOException $e){
				echo $e->getMessage();
				die();
			}
		}
		return self::$bdd_pdo;
	}

	public static function prepare($array){
		$prepare=self::select($array);
		// echo $prepare;
		if($prepare){
			$bdd=self::connect()->prepare($prepare);
			if(isset($array['where'])){
				$nb=count($array['where']);
				for($i=0;$i<$nb;$i++){
					if($array['where'][$i][2]=='STR'&&is_string($array['where'][$i][1])){
						if(isset($array['where'][$i][3])){
							if($array['where'][$i][3]=='LIKE'){
								$array['where'][$i][1]='%'.$array['where'][$i][1].'%';
							}
						}
						$bdd->bindParam(':'.$array['where'][$i][0],$array['where'][$i][1],PDO::PARAM_STR);
					}else if($array['where'][$i][2]=='INT'&&is_int($array['where'][$i][1])){
						$bdd->bindParam(':'.$array['where'][$i][0],$array['where'][$i][1],PDO::PARAM_INT);
					}
				}
			}
			if(isset($array['values'])){
				$prefix=self::$update_prefix;
				if($array['type']=='INSERT'){
					$prefix=self::$insert_prefix;
				}
				$nb=count($array['values']);
				for($i=0;$i<$nb;$i++){
					if($array['values'][$i][2]=='STR'&&is_string($array['values'][$i][1])){
						$bdd->bindParam(':'.$prefix.$array['values'][$i][0],$array['values'][$i][1],PDO::PARAM_STR);
					}else if($array['values'][$i][2]=='INT'&&is_int($array['values'][$i][1])){
						$bdd->bindParam(':'.$prefix.$array['values'][$i][0],$array['values'][$i][1],PDO::PARAM_INT);
					}
				}
			}
			$bdd->execute();
			switch($array['type']){
				case 'SELECT':
					return $bdd->fetch(PDO::FETCH_ASSOC);
				break;
				case 'SELECT-ALL':
					return $bdd->fetchALL(PDO::FETCH_ASSOC);
				break;
				case 'UPDATE':
					return true;
				break;
				case 'INSERT':
					return true;
				break;
				case 'DELETE':
					return true;
				break;
				case 'COUNT':
					$nb=$bdd->fetch(PDO::FETCH_NUM);
					if($nb!==false){
						return intval($nb[0]);
					}
					return 0;
				break;
			}
		}
		return false;
	}

	private static function select($text){
		if(isset($text['type'])&&isset($text['table'])){
			$text['type']=str_replace(['-ALL'],[''],$text['type']);
			if($text['type']=='COUNT'){
				$co='*';
				if(isset($text['retour'])){
					$co=$text['retour'];
					if(strpos($co,',')>0){
						$coT=explode(',',$co);
						$co=$coT[0];
					}
				}
				$t='SELECT COUNT('.$co.') ';
			}else{
				$t=$text['type'].' ';

			}
			if(isset($text['retour'])&&$text['type']=='SELECT'){
				$t.=$text['retour'].' ';
			}

			if($text['type']=='INSERT'){
				$t.='INTO ';
			}else if($text['type']!='UPDATE'){
				$t.='FROM ';
			}
			$t.=$text['table'].' ';
			if($text['type']=='UPDATE'){
				$t.='SET ';
				if(!isset($text['values'])){
					return false;
				}
			}
			if(isset($text['values'])){
				if($text['type']=='UPDATE'){
					$values=self::set($text['values']);
				}else if($text['type']=='INSERT'){
					$values=self::insert($text['values']);
				}
				if($values){
					$t.=$values;
				}else{
					return false;
				}
			}
			if(isset($text['where'])){
				$where=self::where($text['where']);
				if($where){
					$t.=$where;
				}else{
					return false;
				}
			}
			if(isset($text['order'])){
				$order = self::order($text['order']);
				if($order){
					$t.=$order;
				}else{
					return false;
				}
			}
			if(isset($text['limit'])){
				$t.=' LIMIT '.implode(',',$text['limit']);
			}
			return $t;
		}
		return false;
	}

	private static function order($order){
		$t=' ORDER BY ';
		$nb=count($order);
		for($i=0;$i<$nb;$i++){
			if(is_array($order[$i])){
				if( count($order[$i]) == 2){
					if($order[$i][1]=='DESC'||$order[$i][1]=='ASC'){
						if($i>0){
							$t.=', ';
						}
						$t.=' '.$order[$i][0].' '.$order[$i][1];
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		return $t;
	}

	private static function insert($insert){
		$t1='';
		$t2='';
		$nb=count($insert);
		for($i=0;$i<$nb;$i++){
			if(is_array($insert[$i])){
				if( count($insert[$i]) == 3){
					if($i>0){
						$t1.=', ';
						$t2.=', ';
					}
					$t1.=$insert[$i][0];
					$t2.=':'.self::$insert_prefix.$insert[$i][0];
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		return '('.$t1.') VALUES ('.$t2.')';
	}

	private static function set($set){
		$t='';
		$nb=count($set);
		for($i=0;$i<$nb;$i++){
			if(is_array($set[$i])){
				if( count($set[$i]) == 3){
					if($i>0){
						$t.=', ';
					}
					$t.=self::operateur($set[$i],self::$update_prefix);
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		return $t;
	}

	private static function where($where){
		$t=' WHERE ';
		$nb=count($where);
		for($i=0;$i<$nb;$i++){
			if(is_array($where[$i])){
				if( count($where[$i]) >= 3){
					if(is_string($where[$i][0])){
						if($i>0){
							$t.=' AND ';
						}
						$t.=self::operateur($where[$i]);
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		return $t;
	}

	private static function operateur($array,$prefix=''){
		$r='=';
		if(isset($array[3])){
			if(is_string($array[3])){
				$nb=count(self::$op);
				for($i=0;$i<$nb;$i++){
					if($array[3]==self::$op[$i]){
						$r=self::$op[$i];
						break;
					}
				}

			}
		}
		return $array[0].' '.$r.' :'.$prefix.$array[0].' ';
	}

}


// SELECT
// $retour=Bdd::prepare([
// 	'type'=>'SELECT',
// 	'table'=>'users',
// 	'retour'=>'users_mdp',
// 	'where'=>[
// 		['users_ident','sylvain','STR'],
// 	],
// 	// 'order'=>'DESC',
// 	// 'limit'=>[10,20]
// ]);
// var_dump($retour);
/*
// SELECT ALL
$retour= Bdd::prepare([
	'type'=>'SELECT-ALL',
	'table'=>'users',
	'retour'=>'*',
	'order'=>[
		['users_id','DESC'],
	],
]);
var_dump([$retour]);
// UPDATE
$retour= Bdd::prepare([
	'type'=>'UPDATE',
	'table'=>'users',
	'values'=>[
		['users_nom','Sylvain Coudert','STR'],
		['users_niveau',10,'INT'],
	],
	'where'=>[
		['users_ident','sylvain','STR'],
	],
]);
var_dump([$retour]);
// INSERT
$retour= Bdd::prepare([
	'type'=>'INSERT',
	'table'=>'users',
	'values'=>[
		['users_ident','test'.rand(0,100),'STR'],
		['users_mdp',password_hash('jofdojfdjodf',PASSWORD_DEFAULT),'STR'],
		['users_nom','fdjo fdfodofd','STR'],
		['users_niveau',rand(0,100),'INT'],
		['users_date_inscription',date('Y-m-d H:i:s'),'STR'],
	],
]);
// DELETE
$retour= Bdd::prepare([
	'type'=>'DELETE',
	'table'=>'users',
	'where'=>[
		['users_id',63,'INT'],
	],
]);
var_dump([$retour]);
// COUNT ROW
$retour= Bdd::prepare([
	'type'=>'COUNT',
	'table'=>'users',
	'retour'=>'users_id',
	'order'=>[
		['users_id','DESC'],
	],
]);
var_dump($retour);
*/
