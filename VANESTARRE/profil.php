<?php
	session_start();
	if (!isset($_SESSION['suid']) || empty($_SESSION['suid']))
	{
		header('Location: login.php');
		exit();
	}
?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<title>Vanéstarre</title>
		<link rel="stylesheet" href="./css/style.css">
	</head>
	
	<style>A {text-decoration: none;} </style>

	<body>
		<div align="right"><p><a href="./index.php">Accueil    </a><a href="./index.php?logout=true">Déconnexion</a></div>
		<div id="logo"><img src="./images/Vanestarre.png"></div>
		<h1 class="shadow">Profil</h1>
		<div id="profile">
			<h2><?php echo $_SESSION['login']; ?></h2>
			<p> E-Mail : <?php echo $_SESSION['mail']; ?></p> <br>
			<p><a href="./login.php">Modifier votre mot de passe </a></p>
		</div>


	</body>






</html>

