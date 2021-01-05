<?php
		$mysqli = new mysqli("localhost", "root", "root", "nba2kode");
		$mysqli -> set_charset("utf8");
		$requete='INSERT INTO teams VALUES(NULL, "' . $_POST['teams_name'] . '", "' . $_POST['teams_city'] . '")';
		$resultat = $mysqli -> query($requete);
		if ($resultat)
			echo "<p>L equipe a été ajouté !</p>";
		else
			echo "<p>Erreur</p>";
?>