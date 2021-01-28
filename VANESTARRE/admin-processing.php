<?php
	include 'functions.php';
	session_start();
	if ((!isset($_SESSION['suid']) || empty($_SESSION['suid'])) || ($_SESSION['login']!== 'Vanestarre'))
	{
		header('Location: login.php');
		exit();
	}
	
	connect_bd($dbLink);
	
	$action=$_POST['action'];
	
	switch ($action){
		// CRUD USERS
        case 'CMembre':
            $query = 'INSERT INTO users (email, login, password) VALUES (\'' . $_POST['email'] . '\', \'' . $_POST['login'] . '\', \'' . md5($_POST['password']) . '\');';

            if (!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans requête<br />';
                // Affiche le type d'erreur.
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
			$_SESSION['outputString']='Ajout du membre ' . $_POST['login'] . ' effectué.';
            break;

        case 'RMembre':
            $query = 'SELECT * FROM users WHERE login=\'' . $_POST['login'] . '\';';

            if (!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans requête<br />';
                // Affiche le type d'erreur.
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
			$row = mysqli_fetch_assoc($dbResult);
			$tableau = array($row['id'], $row['email'], $row['login'], $row['password']);
			$_SESSION['output']=$tableau;
			$_SESSION['outputName']='users';
            break;

        case 'UMembre':
            $query = 'UPDATE users SET email=\'' . $_POST['email'] . '\', login=\'' . $_POST['login'] . '\' WHERE id=\'' . $_POST['id'] . '\';';

            if (!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans requête<br />';
                // Affiche le type d'erreur.
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
			$_SESSION['outputString']='Mise à jour du membre ' . $_POST['login'] . '  effectuée.';
            break;

        case 'DMembre':
            $query = 'DELETE FROM users WHERE login=\'' . $_POST['login'] . '\';';

            if (!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans requête<br />';
                // Affiche le type d'erreur.
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
			$_SESSION['outputString']='Suppression du membre ' . $_POST['login'] . '  effectuée.';
            break;
			
		// CRUD MESSAGES
		case 'CMessage':
            $query = 'INSERT INTO messages (message, seuil_love) VALUES (\'' . $_POST['message'] . '\', \'' . rand(5,10) . '\');';

            if (!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans requête<br />';
                // Affiche le type d'erreur.
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
			$_SESSION['outputString']='Ajout du message effectué.';
            break;
			
		case 'RMessage':
            $query = 'SELECT * FROM messages WHERE id=\'' . $_POST['id'] . '\';';

            if (!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans requête<br />';
                // Affiche le type d'erreur.
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
			$row = mysqli_fetch_assoc($dbResult);
			$tableau = array($row['id'], $row['message'], $row['love'], $row['cute'], $row['style'], $row['swag'], $row['seuil_love'], $row['limite_min'], $row['limite_max']);
			$_SESSION['output']=$tableau;
			$_SESSION['outputName']='messages';
            break;
			
		case 'UMessage':
            $query = 'UPDATE messages SET message=\'' . $_POST['message'] . '\', love=\'' . $_POST['love'] . '\', cute=\'' . $_POST['cute'] . '\', style=\'' . $_POST['style'] . '\', swag=\'' . $_POST['swag'] . '\' WHERE id=\'' . $_POST['id'] . '\';';

            if (!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans requête<br />';
                // Affiche le type d'erreur.
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
			$_SESSION['outputString']='Mise à jour du message ' . $_POST['id'] . '  effectuée.';
            break;
			
		case 'DMessage':
            $query = 'DELETE FROM messages WHERE id=\'' . $_POST['id'] . '\';';

            if (!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans requête<br />';
                // Affiche le type d'erreur.
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
			$_SESSION['outputString']='Suppression du message ' . $_POST['login'] . '  effectuée.';
            break;
			
		case 'SetLimit':
            $query = 'UPDATE messages SET limite_min=\'' . $_POST['limMin'] . '\', limite_max=\'' . $_POST['limMax'] . '\', seuil_love=\'' . rand($_POST['limMin'],$_POST['limMax']) . '\' WHERE id=\'' . $_POST['id'] . '\';';

            if (!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans requête<br />';
                // Affiche le type d'erreur.
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
			$_SESSION['outputString']='Mise à jour des limites effectuée.';
            break;
		case 'SetnbPost':
			$query = 'SELECT * FROM pages';

            if (!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans requête<br />';
                // Affiche le type d'erreur.
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
			if(mysqli_num_rows($dbResult)<1)
			{
				$query = 'INSERT INTO pages (nbPost) VALUES (\'' . $_POST['nbPost'] . '\');';

				if (!($dbResult = mysqli_query($dbLink, $query))) {
					echo 'Erreur dans requête<br />';
					// Affiche le type d'erreur.
					echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
					// Affiche la requête envoyée.
					echo 'Requête : ' . $query . '<br/>';
					exit();
				}
			}
			else{
				$query = 'UPDATE pages SET nbPost=\'' . $_POST['nbPost'] . '\';';

				if (!($dbResult = mysqli_query($dbLink, $query))) {
					echo 'Erreur dans requête<br />';
					// Affiche le type d'erreur.
					echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
					// Affiche la requête envoyée.
					echo 'Requête : ' . $query . '<br/>';
					exit();
				}
			}
			$_SESSION['outputString']='Mise à jour de la limite de posts effectuée.';
			break;
    }
	header('Location: admin.php');
	exit();
?>