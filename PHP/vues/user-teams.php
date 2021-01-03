<?php defined($alea) or die(header('location: ../index.php'));

if($teams){
	$nbteams=count($teams);
	// if($errortrash){
	// 	echo '<div>Suppression de l\'utilisateur OK</div>';
	// }
	
	echo
	'<a href="'.site_url.'/?page=user-team">Ajouter</a>'.
	'<div class="admin-table">'.
		'<div class="thead">'.
			'<div class="tr tr-head">'.
				'<div class="td td-num">Num</div>'.
				'<div class="td td-nom">Equipe</div>'.
				'<div class="td td-num"></div>'.
			'</div>'.
		'</div>'.
		'<div class="tbody">';
			for($i=0;$i<$nbteams;$i++){
				echo
				'<div class="tr tr-body">'.
					'<div class="td td-num">';
						if(($i+1)<10){echo '0';}
						echo ($i+1).
					'</div>'.
					'<div class="td td-nom">'.
						'<a href="'.site_url.'/?page=user-team&id='.$teams[$i]['teams_id'].'">'.$teams[$i]['teams_name'].'</a>'.
					'</div>'.

					'<div class="td td-num">'.
						'<a class="btn-trash" href="'.site_url.'/?page=user-team-delete&id='.$teams[$i]['teams_id'].'">Trash</a>'.
					'</div>'.
				'</div>';
			}
			echo
		'</div>'.
	'</div>'.
	'<div class="trash-popup hidden">'.
		'<div>'.
			'<h2>Voulez-vous supprimer : <b></b></h2>'.
			'<div class="trash-choix">'.
				'<form method="POST">'.
					'<input type="hidden" name="type" value="trash">'.
					'<input type="hidden" name="teams_id">'.
					'<button type="submit" class="btn-trash-yes">OUI</button>'.
				'</form>'.
				'<button type="button" class="btn-trash">NON</button>'.
			'</div>'.
		'</div>'.
	'</div>';
}else{
	echo 'Attention pas d\'équipe.';
}
