<?php
	include 'functions.php';
	session_start();
?>

<?php
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
?>
	
<!DOCTYPE html>


<html>
    <head>
        <meta charset="utf-8">
        <title>Vanéstarre</title>
        <link rel="stylesheet" href="./css/style.css">
    </head>
<body>

	<!-- Logo Vanestarre -->
	<div class="logo"><a href="./index.php"> <img src="./images/Vanestarre.png"> </a></div>

	<h1 class="shadow">Connectez vous</h1>

	<div class="login">
        <form action="test-pass.php" method="POST">
			Login<br/><input type="text" name="login"/><br/>
			Mot de passe<br/><input type="password" name="pwd"/><br/>
			<input type="submit" name="action" value="ok"/><br/>
		</form>
	</div>

	<h1 class="shadow">Inscrivez vous</h1>

	<div class="login">
		<br/>Pas encore inscrit? <a href="main.php">Cliquez ici</a><br/>
	</div>

	<h1 class="shadow">Mot de passe oublié</h1>

	<div class="login">
		Mot de passe oublié? Entrez votre email ci-dessous<br/>
		<br/><form action="password-reset.php" method="POST">
			<br/><input type="text" name="email"/><br/>
			<input type="submit" name="action" value="reset"/><br/>
		</form>
	</div>

</body>

</html>

<?php
	end_page();
?>