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
'<form class="form-admin" method="POST">'.
	'<input type="hidden" name="type" value="'.$type.'">';
	if($matches){
		echo
		'<input type="hidden" name="matches_id" value="'.$matches['matches_id'].'">'.
		'<input type="hidden" name="matches_date_old" value="'.$date.'">';
	}

	echo
	'<label for="matches_date">Date</label>'.
	'<input type="date" name="matches_date" value="'.$date.'">'.
	'<label for="matches_location">Location</label>'.
	'<input type="text" name="matches_location" value="'.$location.'">'.
	'<label for="teams_id_one">Team One</label>'.
	'<input type="number" name="teams_id_one" value="'.$teamOne.'">'.
	'<label for="teams_id_two">Team Two</label>'.
	'<input type="number" name="teams_id_two" value="'.$teamTwo.'">'.
	'<button type="submit">Enregistrer</button>'.
'</form>';
