<?php
	include 'utils.inc.php';
	
	start_page('unTitre');
	echo '<form action="data-processing.php" method="post">
			E-mail<br/><input type="text" name="email"/><br/>
			Identifiant<br/><input type="text" name="identifiant"/><br/>
			Mot de passe<br/><input type="password" name="motdepasse"/><br/>
			Vérification du mot de passe<br/><input type="password" name="motdepasse2"/><br/>
			<input type="submit" name="action" value="mailer"/><br/>
		  </form>';
	end_page();
?>