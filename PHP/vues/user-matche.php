<?php defined($alea) or die(header('location: ../index.php'));
$type='insert';
$date='';
$location='';
$teamOne='';
$teamTwo='';

if($matches){
	$type='update';
	$date=$matches['matches_date'];
	$location=$matches['matches_location'];
	$teamOne=$matches['teams_id_one'];
	$teamTwo=$matches['teams_id_two'];
	//update
}

echo
'<div class="container">'.
	'<form class="form" method="POST">'.
		'<input type="hidden" name="type" value="'.$type.'">';
		if($matches){
			echo
			'<input type="hidden" name="matches_id" value="'.$matches['matches_id'].'">'.
			'<input type="hidden" name="matches_date_old" value="'.$date.'">';
		}
		$combobox = new Teams();
		echo
		'<div>'.
			'<label for="matches_date">Date</label>'.
			'<input type="date" name="matches_date" value="'.$date.'">'.
		'</div>'.
		'<div>'.
			'<label for="matches_location">Location</label>'.
			'<input type="text" name="matches_location" value="'.$location.'">'.
		'</div>'.
		'<div>'.
			'<label for="vteams_id_one">Team One</label>'.
			$combobox->generateCombobox($teamOne, "teams_id_one").
		'</div>'.
		'<div>'.
			'<label for="teams_id_two">Team Two</label>'.
			$combobox->generateCombobox($teamTwo, "teams_id_two").
		'</div>'.
		'<button type="submit">Enregistrer</button>'.
	'</form>'.
'</div>';
