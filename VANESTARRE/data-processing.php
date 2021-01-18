<?php
	include 'utils.inc.php';
	session_start();
	
	$identifiant=$_POST['identifiant'];
	$email=$_POST['email'];
	$motdepasse=$_POST['motdepasse'];
	$motdepasse2=$_POST['motdepasse2'];
	$action=$_POST['action'];
	
	if($motdepasse!=$motdepasse2)
	{
		$_SESSION['error']='erreurPassword';
		header('Location: main.php');
		exit();
	}
	if(empty($identifiant) || empty($email) || empty($motdepasse) || empty($motdepasse2))
	{
		$_SESSION['error']='erreurEmpty';
		header('Location: main.php');
		exit();
	}

	start_page('unAutreTitre');
	
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
	
	echo '<br/><a href="http://bdr-projet.alwaysdata.net/index.html">Accueil</a><br/>';
	
	$dbLink = mysqli_connect('mysql-bdr-projet.alwaysdata.net', '223944', '*9NWFBZ3MHMmAD7')
		or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
		
	mysqli_select_db($dbLink, 'bdr-projet_bdd')
		or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
		
	$query = 'INSERT INTO users (email, login, password) VALUES (\'' . $email . '\', \'' . $identifiant . '\', \'' . md5($motdepasse) . '\')';
	
	if(!($dbResult = mysqli_query($dbLink, $query)))
	{
		echo 'Erreur dans requête<br />';
		// Affiche le type d'erreur.
		echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
		// Affiche la requête envoyée.
		echo 'Requête : ' . $query . '<br/>';
		exit();
	}
	
	echo 'Bonjour, ' . $identifiant . '<br/>Votre inscription a bien été enregistrée, merci.<br/>';
	
	end_page();
?>