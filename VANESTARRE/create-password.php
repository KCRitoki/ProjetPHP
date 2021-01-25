<?php
	include 'functions.php';
	session_start();
	
	start_page('Changer de mot de passe');
	
	if (empty($_GET['token']))
	{
		echo 'Erreur d\'url';
	}
	else
	{
		if(ctype_xdigit($_GET['token']))
		{
			echo '<form action="password-reset-processing.php" method="POST">
			<input type="hidden" name="token" value="' . $_GET['token'] . '"/>
			Mot de passe<br/><input type="password" name="motdepasse"/><br/>
			Vérification du mot de passe<br/><input type="password" name="motdepasse2"/><br/>
			<input type="submit" name="submit-new-password"/><br/>
			</form>';
			
			if($_SESSION['error']=='erreurPassword')
			{
				echo $_SESSION['error'] . PHP_EOL;
				echo '<p style="color:red;">Veuillez vérifier que les mots de passe sont identiques!</p>';
			}
			if($_SESSION['error']=='erreurEmpty')
			{
				echo $_SESSION['error'] . PHP_EOL;
				echo '<p style="color:red;">Tous les champs sont obligatoires</p>';
			}
		}
	}
	
	end_page();
?>