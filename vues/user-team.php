<?php defined($alea) or die(header('location: ../index.php'));
$type='insert';
$name='';
$city='';

if($team){
	$type='update';
	$name=$team['teams_name'];
	$city=$team['teams_city'];
	//update
}

echo
'<form class="form-admin" method="POST">'.
	'<input type="hidden" name="type" value="'.$type.'">';
	if($team){
		echo
		'<input type="hidden" name="teams_id" value="'.$team['teams_id'].'">'.
		'<input type="hidden" name="teams_name_old" value="'.$name.'">';
	}
	echo
	'<label for="teams_name">Name</label>'.
	'<input type="text" name="teams_name" value="'.$name.'">'.
	'<label for="teams_city">City</label>'.
	'<input type="text" name="teams_city" value="'.$city.'">'.
	'<button type="submit">Enregistrer</button>'.
'</form>';
