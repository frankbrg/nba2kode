<?php defined($alea) or die(header('location: ../index.php'));?>
<?php echo password_hash('frank',PASSWORD_DEFAULT);?>

<form method="post" action="<?= site_url.'/?page=connexion'?>">
	<input type="text" name="ident">
	<input type="password" name="mdp">
	<input type="hidden" name="token" value="<?=TOKEN_('reirhergreh');?>">
	<button type="submit">Connecter</button>
</form>
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
