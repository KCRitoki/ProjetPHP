<?php
    include '../functions.php';
	session_start();
	if ((!isset($_SESSION['suid']) || empty($_SESSION['suid'])) || ($_SESSION['login']!== 'Vanestarre'))
    {
        header('Location: login.php');
        exit();
    }
	
	$target_dir = '../Uploads';
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION));
	$idmsg = $_GET['idmsg'] + 1;
	$imgname = $idmsg . '.' . $imageFileType;

    //récupération du message
    $message = $_POST['message'];

	//récupération des tags
    $taglist = $_POST['tags'];
	
    // Connexion à la base de données
    connect_bd($dbLink);

	if(isset($_FILES['file']) && !empty($_FILES['file']))
	{
	//vérification de si le fichier est bien une image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["file"]["tmp_name"]);
		if ($check !== false) {
			$uploadOk = 1;
		}
		else {
			$uploadOk = 0;
			echo 'le fichier n\'est pas une vraie image 1';
		}
	}

	// vérification de la taille de l'image
	if ($_FILES["file"]["size"] > 500000) {
		$uploadOk = 0;
		echo 'le fichier est trop grand';
	}

	// vérification du format de l'image
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		$uploadOk = 0;
		echo 'le fichier n\'est pas une image';
	}
	
	//vérification de l'upload
	if ($uploadOk == 0) {
		echo 'fichier invalide';
		exit();
	}
	else {
	    if (move_uploaded_file($_FILES["file"]["tmp_name"], "$target_dir/$imgname")) {		
			
			// Insertion du message
			$query = 'INSERT INTO messages (message, seuil_love, imglink) VALUES (\'' . $message . '\', \'' . rand(5,10) . '\', \'' . $imgname . '\')';

			if(!($dbResult = mysqli_query($dbLink, $query)))
			{
				echo 'Erreur dans requête<br />';
				// Affiche le type d'erreur.
				echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
				// Affiche la requête envoyée.
				echo 'Requête : ' . $query . '<br/>';
				exit();
			}
	
			// Récupération de l'id du message
			$query = 'SELECT * FROM messages WHERE id >= ALL (SELECT id FROM messages)';
		
			if(!($dbResult = mysqli_query($dbLink, $query)))
			{
				echo 'Erreur dans requête<br />';
				// Affiche le type d'erreur.
				echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
				// Affiche la requête envoyée.
				echo 'Requête : ' . $query . '<br/>';
				exit();
			}
			$row=mysqli_fetch_assoc($dbResult);
			$idMessage=$row['id'];
	
			// Insertion des tags
			if(!empty($taglist))
			{
				$query = 'INSERT INTO tags (taglist, idMessage) VALUES (\'' . $taglist . '\', \'' . $idMessage . '\')';

				if(!($dbResult = mysqli_query($dbLink, $query)))
				{
					echo 'Erreur dans requête<br />';
					// Affiche le type d'erreur.
					echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
					// Affiche la requête envoyée.
					echo 'Requête : ' . $query . '<br/>';
					exit();
				}
			}
			
			
			
			

			header('Location: messages.php');
		}
		else {
			echo "Erreur lors de l'upload du fichier" . '</br>';
			print_r($_FILES);
		}
		
	}
	}
	else{
    // Insertion du message
    $query = 'INSERT INTO messages (message, seuil_love) VALUES (\'' . $message . '\', \'' . rand(5,10) . '\');';

    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur dans requête<br />';
        // Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        // Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
	
	// Récupération de l'id du message
    $query = 'SELECT * FROM messages WHERE id >= ALL (SELECT id FROM messages)';

    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur dans requête<br />';
        // Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        // Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
	$row=mysqli_fetch_assoc($dbResult);
	$idMessage=$row['id'];
	
	// Insertion des tags
	if(!empty($taglist))
	{
		$query = 'INSERT INTO tags (taglist, idMessage) VALUES (\'' . $taglist . '\', \'' . $idMessage . '\')';

		if(!($dbResult = mysqli_query($dbLink, $query)))
		{
			echo 'Erreur dans requête<br />';
			// Affiche le type d'erreur.
			echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
			// Affiche la requête envoyée.
			echo 'Requête : ' . $query . '<br/>';
			exit();
		}
	}
	}
    

    // Redirection
    header('Location: ../connected-vanestarre.php');

