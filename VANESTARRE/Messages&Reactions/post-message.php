<?php
    include 'VANESTARRE/functions.php';
    session_start();

    //récupération du message
    $message = $_POST['message'];

    //vérification du message
    if (empty($message)){
        $_SESSION['errormsg'] = 'empty';
        header('Location: connected-vanestarre.php');
    }

    // Connexion à la base de données
    connect_bd($dbLink);

    // Insertion du message
    $query = 'INSERT INTO messages (message) VALUES (\'' . $message . '\')';

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
    header('Location: connected-vanestarre.php');

