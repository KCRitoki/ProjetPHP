<?php
    include '../functions.php';
	session_start();
	if (!isset($_SESSION['suid']) || empty($_SESSION['suid']))
	{
		header('Location: login.php');
		exit();
	}
    //recuperation des variables
    $reaction = $_POST['reaction'];
    $id = $_GET['id'];

    // Connexion à la base de données
    connect_bd($dbLink);
	
	// Verification si le couple user/message existe dans la base
	$query = 'SELECT * FROM reagir WHERE idUser=\'' . $_SESSION['id'] . '\' AND idMessage=\'' . $id . '\';';

    if (!($dbResult = mysqli_query($dbLink, $query))) {
        echo 'Erreur dans requête<br />';
        // Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        // Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
	if(mysqli_num_rows($dbResult)>0)
	{
		header('Location: ../index.php');
		exit();
	}

    // Incrementation de la reaction
    switch ($reaction){
        case 'love':
            $query = "UPDATE messages SET love = love +1 WHERE id = '$id' ";

            if (!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans requête<br />';
                // Affiche le type d'erreur.
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
			
			$query = "SELECT seuil_love FROM messages WHERE id = '$id' ";

            if (!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans requête<br />';
                // Affiche le type d'erreur.
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
			$row=mysqli_fetch_assoc($dbResult);
			$n=$row['seuil_love'];
			
			$query = "SELECT love FROM messages WHERE id = '$id' ";

            if (!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans requête<br />';
                // Affiche le type d'erreur.
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
			$row=mysqli_fetch_array($dbResult);
			$love=$row['love'];
			if($love===$n)
			{
				$_SESSION['bitcoin']=true;
			}
            break;

        case 'cute':
            $query = "UPDATE messages SET cute = cute +1 WHERE id = '$id' ";

            if (!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans requête<br />';
                // Affiche le type d'erreur.
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
            break;

        case 'style':
            $query = "UPDATE messages SET style = style +1 WHERE id = '$id' ";

            if (!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans requête<br />';
                // Affiche le type d'erreur.
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
            break;

        case 'swag':
            $query = "UPDATE messages SET swag = swag +1 WHERE id = '$id' ";

            if (!($dbResult = mysqli_query($dbLink, $query))) {
                echo 'Erreur dans requête<br />';
                // Affiche le type d'erreur.
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                // Affiche la requête envoyée.
                echo 'Requête : ' . $query . '<br/>';
                exit();
            }
            break;
    }
	
	// Ajout du couple user/message dans la table des réactions
	$query = 'INSERT INTO reagir (idUser, idMessage) VALUES (\'' . $_SESSION['id'] . '\', \'' . $id . '\');';

    if (!($dbResult = mysqli_query($dbLink, $query))) {
        echo 'Erreur dans requête<br />';
        // Affiche le type d'erreur.
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        // Affiche la requête envoyée.
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
	
    // Redirection
    header('Location: ../index.php');
	exit();