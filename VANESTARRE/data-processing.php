<?php
	include 'functions.php';
	session_start();
	
	connect_bd($dbLink);
	
	$identifiant=mysqli_real_escape_string($dbLink, $_POST['identifiant']);
	$email=mysqli_real_escape_string($dbLink, $_POST['email']);
	$motdepasse=mysqli_real_escape_string($dbLink, $_POST['motdepasse']);
	$motdepasse2=mysqli_real_escape_string($dbLink, $_POST['motdepasse2']);
	$action=mysqli_real_escape_string($dbLink, $_POST['action']);
	
	if(empty($identifiant) || empty($email) || empty($motdepasse) || empty($motdepasse2))
	{
		$_SESSION['error']='erreurEmpty';
		header('Location: main.php');
		exit();
	}
	if($motdepasse!==$motdepasse2)
	{
		$_SESSION['error']='erreurPassword';
		header('Location: main.php');
		exit();
	}

	start_page('Inscription terminée');
	
	
	$query = 'SELECT * FROM users WHERE email=?;';
	
	$stmt = mysqli_stmt_init($dbLink);
	if(!mysqli_stmt_prepare($stmt, $query))
	{
		echo 'Une erreur de statement s\'est produite';
	}
	else{
	mysqli_stmt_bind_param($stmt, 's', $email);
	mysqli_stmt_execute($stmt);
	$dbResult=mysqli_stmt_get_result($stmt);
	}
	
	if(mysqli_num_rows($dbResult)>=1)
	{
		$_SESSION['error']='erreurMailDouble';
		header('Location: main.php');
		exit();
	}
	
	$query = 'SELECT * FROM users WHERE login=?;';
	
	$stmt = mysqli_stmt_init($dbLink);
	if(!mysqli_stmt_prepare($stmt, $query))
	{
		echo 'Une erreur de statement s\'est produite';
	}
	else{
	mysqli_stmt_bind_param($stmt, 's', $identifiant);
	mysqli_stmt_execute($stmt);
	$dbResult=mysqli_stmt_get_result($stmt);
	}
	
	if(mysqli_num_rows($dbResult)>=1)
	{
		$_SESSION['error']='erreurLoginDouble';
		header('Location: main.php');
		exit();
	}
	
	$query = 'INSERT INTO users (email, login, password) VALUES (?, ?, ?)';
	
	$stmt = mysqli_stmt_init($dbLink);
	if(!mysqli_stmt_prepare($stmt, $query))
	{
		echo 'Une erreur de statement s\'est produite';
	}
	else{
	mysqli_stmt_bind_param($stmt, 'sss', $email, $identifiant, md5($motdepasse));
	mysqli_stmt_execute($stmt);
	}
	
	echo 'Bonjour, ' . $identifiant . '<br/>Votre inscription a bien été enregistrée, merci.<br/>';
	
	if($action == 'mailer')
	{
		$message = 'Voici vos identifiants d\'inscription :' . PHP_EOL;
		$message .= 'Email : ' . $email . PHP_EOL;
		$message .= 'Login : ' . $identifiant . PHP_EOL;
		$message .= 'Mot de passe : ' . PHP_EOL . $motdepasse;
		mail($email, 'Identifiants d\'inscrition', $message);
		echo 'Votre mail a bien été envoyé.';
	}
	else
	{
		echo '<br/><strong>Bouton non géré !</strong><br/>';
	}
	
	echo '<br/><a href="http://bdr-projet.alwaysdata.net/index.php">Accueil</a><br/>';
	
	end_page();
?>