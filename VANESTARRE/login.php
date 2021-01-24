<?php
	include 'utils.inc.php';
	
	session_start();
	
	start_page('Se connecter');
	
	if($_SESSION['error']=='erreurauth')
	{
		echo $_SESSION['error'];
		echo '<p style="color:red;">Le login ou le mot de passe sont incorrects</p>';
	}
	if($_SESSION['error']=='erreurEmpty')
	{
		echo $_SESSION['error'] . PHP_EOL;
		echo '<p style="color:red;">Tous les champs sont obligatoires</p>';
	}
	if($_SESSION['resetpwd']=='ok')
	{
		echo '<p style="color:green;">Reinitialisation du mot de passe effectuée</p>';
	}
	unset($_SESSION['error']);
	unset($_SESSION['resetpwd']);
	
	echo '<form action="test-pass.php" method="POST">
			Login<br/><input type="text" name="login"/><br/>
			Mot de passe<br/><input type="password" name="pwd"/><br/>
			<input type="submit" name="action" value="ok"/><br/>
			</form>';
	echo '<br/>Pas encore inscrit? <a href="main.php">Cliquez ici</a><br/>';
	echo 'Mot de passe oublié? Entrez votre email ci-dessous<br/>';
	echo '<br/><form action="password-reset.php" method="POST">
			<br/><input type="text" name="email"/><br/>
			<input type="submit" name="action" value="reset"/><br/>
			</form>';
	end_page();
?>