<?php
    include '../functions.php';
    //recuperation des variables
    $reaction = $_POST['reaction'];
    $id = $_GET['id'];

    // Connexion à la base de données
    connect_bd($dbLink);

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
    // Redirection
    header('Location: ../connected-vanestarre.php');

