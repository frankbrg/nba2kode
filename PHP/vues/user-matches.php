<?php defined($alea) or die(header('location: ../index.php'));

if($matches){
	$nbmatches=count($matches);
	// if($errortrash){
	// 	echo '<div>Suppression de l\'utilisateur OK</div>';
	// }
	
	echo
	'<a href="'.site_url.'/?page=user-matche">Ajouter</a>'.
	'<div class="admin-table">'.
		'<div class="thead">'.
			'<div class="tr tr-head">'.
				'<div class="td td-num">Num</div>'.
				'<div class="td td-nom">Date</div>'.
				'<div class="td td-nom">Location</div>'.
				'<div class="td td-nom">Team One</div>'.
				'<div class="td td-nom">Team Two</div>'.
				'<div class="td td-num"></div>'.

			'</div>'.
		'</div>'.
		'<div class="tbody">';
			for($i=0;$i<$nbmatches;$i++){
				echo
				'<div class="tr tr-body">'.
					'<div class="td td-num">';
						echo '<a href="'.site_url.'/?page=user-matche&id='.$matches[$i]['matches_id'].'">';
						if(($i+1)<10){echo('0');}
						echo ($i+1).'</a>'.
					'</div>'.
					'<div class="td td-nom">'.
						'<p>'.$matches[$i]['matches_date'].'</p>'.
					'</div>'.
					'<div class="td td-nom">'.
						'<p>'.$matches[$i]['matches_location'].'</p>'.
					'</div>'.
					'<div class="td td-nom">'.
						'<p>'.$matches[$i]['teams_id_one'].'</p>'.
					'</div>'.
					'<div class="td td-nom">'.
						'<p>'.$matches[$i]['teams_id_two'].'</p>'.
					'</div>'.
					'<div class="td td-num">'.
						'<a class="btn-trash" href="'.site_url.'/?page=user-matche-delete&id='.$matches[$i]['matches_id'].'">Trash</a>'.
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
					'<input type="hidden" name="matches_id">'.
					'<button type="submit" class="btn-trash-yes">OUI</button>'.
				'</form>'.
				'<button type="button" class="btn-trash">NON</button>'.
			'</div>'.
		'</div>'.
	'</div>';
}else{
	echo 'Attention pas d\'équipe.';
}
