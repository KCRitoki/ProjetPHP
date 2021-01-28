<?php
    include '../functions.php';
	session_start();
	if ((!isset($_SESSION['suid']) || empty($_SESSION['suid'])) || ($_SESSION['login']!== 'Vanestarre'))
    {
        header('Location: login.php');
        exit();
    }
    //récupération du message
    $message = $_POST['message'];

	//récupération des tags
    $taglist = $_POST['tags'];
	
    // Connexion à la base de données
    connect_bd($dbLink);

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

    // Redirection
    header('Location: ../connected-vanestarre.php');

