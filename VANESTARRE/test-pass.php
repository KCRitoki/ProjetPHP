<?php
	session_start();
	$login=$_POST['login'];
	$pwd=$_POST['pwd'];
	
	$dbLink = mysqli_connect('mysql-bdr-projet.alwaysdata.net', '223944', '*9NWFBZ3MHMmAD7')
		or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
		
	mysqli_select_db($dbLink, 'bdr-projet_bdd')
		or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
		

	
	$query = 'SELECT login, password FROM users WHERE login=\''.$login.'\' AND password=\''.$pwd.'\'';
	if(!($dbResult = mysqli_query($dbLink, $query)))
	{
		echo 'Erreur dans requête<br />';
		// Affiche le type d'erreur.
		echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
		// Affiche la requête envoyée.
		echo 'Requête : ' . $query . '<br/>';
		exit();
	}
	if(mysqli_num_rows($dbResult)==0)
	{
		
		$_SESSION['error']='erreurauth';
		header('Location: login.php');
		exit();
	}
	$_SESSION['suid']=session_id();
	
	header('Location: index.php');
	exit();
?>