<?php defined($alea) or die(header('location: ../index.php'));?>

<div class="container">
	<form method="post" class="form"action="<?= site_url.'/?page=connexion'?>">
		<div>
		<label for="teams_name">Username</label>
		<input type="text" name="ident">
		</div>
		<div>
		<label for="teams_name">Password</label>
		<input type="password" name="mdp">
		</div>
		<input type="hidden" name="token" value="<?=TOKEN_('reirhergreh');?>">
		<button type="submit">Connect</button>
	</form>
</div>

<?php
	switch($error){
		case 1:
			echo '<div>Rechargez la page</div>';
		break;
		case 2:
			echo '<div>Ident et ou mdp invalide(s)</div>';
		break;
	}
?>
