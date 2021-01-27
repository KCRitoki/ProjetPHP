<?php
	include 'functions.php';
	session_start();
	$login=$_POST['login'];
	$pwd=$_POST['pwd'];
	
	if(empty($login) || empty($pwd))
	{
		
		$_SESSION['error']='erreurEmpty';
		header('Location: login.php');
		exit();
	}
	
	connect_bd($dbLink);

	
	$query = 'SELECT * FROM users WHERE login=\'' . $login . '\' AND password=\'' . md5($pwd) . '\'';
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
	$_SESSION['login']=$login;
	$row=mysqli_fetch_assoc($dbResult);
	$_SESSION['mail']=$row['email'];
	$_SESSION['id']=$row['id'];
	
	header('Location: index.php');
	exit();
?>