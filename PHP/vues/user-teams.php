<?php defined($alea) or die(header('location: ../index.php'));

if($teams){
	$nbteams=count($teams);
	// if($errortrash){
	// 	echo '<div>Suppression de l\'utilisateur OK</div>';
	// }
	
	echo
	'<div class="table">'.
		'<div class="thead">'.
			'<div class="tr tr-head">'.
				'<div class="td td-num">Num</div>'.
				'<div class="td td-nom">Name</div>'.
				'<div class="td td-nom">City</div>'.
				'<div class="td td-num">Trash</div>'.
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
					'<div class="td td-nom">'.
						$teams[$i]['teams_city'].
					'</div>'.
					'<div class="td td-num">'.
						'<a class="btn-trash" href="'.site_url.'/?page=user-team-delete&id='.$teams[$i]['teams_id'].'">Trash</a>'.
					'</div>'.
				'</div>';
			}
			echo
		'</div>'.
	'</div>'.
	'<a class="add" href="'.site_url.'/?page=user-team">Add</a>';
}else{
	echo 'No data';
}
