<?php
	include 'utils.inc.php';
	session_start();
	
	$email=$_POST['email'];
	$action=$_POST['action'];
	
	if(empty($email))
	{
		$_SESSION['error']='erreurEmpty';
		header('Location: login.php');
		exit();
	}
	
	$token = random_bytes(32);
	
	$url = "http://bdr-projet.alwaysdata.net/create-password.php?token=" . bin2hex($token);
	
	$expirationDatef = date('Y-m-d H:i:s');
	$expirationDates = strtotime($expirationDatef);
	$expirationDatenew = $expirationDates+600;
	$expirationDate = date('Y-m-d H:i:s',$expirationDatenew);
	
	$dbLink = mysqli_connect('mysql-bdr-projet.alwaysdata.net', '223944', '*9NWFBZ3MHMmAD7')
		or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
		
	mysqli_select_db($dbLink, 'bdr-projet_bdd')
		or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
		
	$query = 'DELETE FROM resetPwd WHERE email=\'' . $email . '\';';
	if(!($dbResult = mysqli_query($dbLink, $query)))
	{
		echo 'Erreur dans requête<br />';
		// Affiche le type d'erreur.
		echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
		// Affiche la requête envoyée.
		echo 'Requête : ' . $query . '<br/>';
		exit();
	}
	
	$query = 'INSERT INTO resetPwd (email, token, exp_date) VALUES (\'' . $email . '\',\'' . md5($token) . '\',\'' . $expirationDate . '\');';
	if(!($dbResult = mysqli_query($dbLink, $query)))
	{
		echo 'Erreur dans requête<br />';
		// Affiche le type d'erreur.
		echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
		// Affiche la requête envoyée.
		echo 'Requête : ' . $query . '<br/>';
		exit();
	}

	start_page('Mail envoyé');
	
	if($action == 'reset')
	{
		$message = 'Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe :' . PHP_EOL;
		$message .= '<a href="' . $url . '">' . $url . '</a>';
		mail($email, 'Reinitialisation de mot de passe', $message, 'Content-type: text/html');
		echo 'Vérifiez votre boite mail, si vous ne le trouvez pas cherchez dans le dossier spam';
	}
	
	echo '<br/><a href="http://bdr-projet.alwaysdata.net/index.html">Accueil</a><br/>';
	
	end_page();
?>