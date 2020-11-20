<?php defined($alea) or die(header('location: ../index.php'));

function GET_($param,$content=false){
	if( isset( $_GET[$param]) ){
		return $_GET[$param];
	}
	return $content;
}
function POST_($param,$content=false){
	if( isset( $_POST[$param]) ){
		return $_POST[$param];
	}
	return $content;
}
function POSTINT_($param,$content=false){
	if( isset( $_POST[$param]) ){
		return intval($_POST[$param]);
	}
	return $content;
}
function SESSION_($param,$content=false){
	if( isset( $_SESSION[$param]) ){
		return $_SESSION[$param];
	}
	return $content;
}


function TOKEN_($type='connexion'){
	$_SESSION[$type]=[];
	$_SESSION[$type]['token']=hash('sha256',token_salt.uniqid());
	return $_SESSION[$type]['token'];
}
function TOKEN_VERIF_($token_post=false,$type='connexion'){
	if(SESSION_($type)&&$token_post){
		if($_SESSION[$type]['token']==$token_post){
			return true;
		}
	}
	return false;
}
