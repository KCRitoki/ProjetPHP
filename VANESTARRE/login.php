<?php
	include 'utils.inc.php';
	
	session_start();
	
	start_page('Titre Login');
	
	if($_SESSION['error']=='erreurauth')
	{
		echo $_SESSION['error'];
	}
	
	echo '<form action="test-pass.php" method="POST">
			Login<br/><input type="text" name="login"/><br/>
			Mot de passe<br/><input type="password" name="pwd"/><br/>
			<input type="submit" name="action" value="ok"/><br/>
			</form>';
	echo '<br/>Pas encore inscrit? <a href="main.php">Cliquez ici</a><br/>';
	end_page();
?>