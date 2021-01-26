<?php
	include 'functions.php';
	session_start();
	
	start_page('Opération en cours');
	
	if (isset($_POST['submit-new-password']))
	{
		$token=$_POST['token'];
		$motdepasse=$_POST['motdepasse'];
		$motdepasse2=$_POST['motdepasse2'];
		
		if(empty($motdepasse) || empty($motdepasse2))
		{
			$_SESSION['error']='erreurEmpty';
			header('Location: create-password.php?token=' . $token);
			exit();
		}
		if($motdepasse!==$motdepasse2)
		{
			$_SESSION['error']='erreurPassword';
			header('Location: create-password.php?token=' . $token);
			exit();
		}
		unset($_SESSION['error']);

		connect_bd($dbLink);
		
		$query = 'SELECT * FROM resetPwd WHERE token=\'' . md5(hex2bin($token)) . '\' AND exp_date>=\'' . date('Y-m-d H:i:s') . '\';';
	
		if(!($dbResult = mysqli_query($dbLink, $query)))
		{
			echo 'Erreur dans requête<br />';
			// Affiche le type d'erreur.
			echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
			// Affiche la requête envoyée.
			echo 'Requête : ' . $query . '<br/>';
			exit();
		}
		if(!$row = mysqli_fetch_assoc($dbResult))
		{
			echo 'Ce lien n\'est pas valide, vérifiez qu\'il ne soit pas expiré (au bout de 10 minutes)';
			exit();
		}
		else
		{
			$email = $row['email'];
			$query = 'SELECT * FROM users WHERE email=\'' . $email . '\';';
			if(!($dbResult = mysqli_query($dbLink, $query)))
			{
				echo 'Erreur dans requête<br />';
				// Affiche le type d'erreur.
				echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
				// Affiche la requête envoyée.
				echo 'Requête : ' . $query . '<br/>';
				exit();
			}
			if (mysqli_num_rows($dbResult)==0)
			{
				echo 'Erreur de récupération d\'association, avez vous bien utilisé le mail lié à votre compte?';
				exit();
			}
			else
			{
				$query = 'UPDATE users SET password=\'' . md5($motdepasse) . '\' WHERE email=\'' . $email . '\';';
				if(!($dbResult = mysqli_query($dbLink, $query)))
				{
					echo 'Erreur dans requête<br />';
					// Affiche le type d'erreur.
					echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
					// Affiche la requête envoyée.
					echo 'Requête : ' . $query . '<br/>';
					exit();
				}
				
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
				
				$_SESSION['resetpwd']='ok';
				header('Location: login.php');
				exit();
			}
		}
		
	}
	else
	{
		header('Location: index.html');
	}
	
	end_page();
?>