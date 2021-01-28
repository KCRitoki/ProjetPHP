<?php
include 'functions.php';
session_start();
if ((!isset($_SESSION['suid']) || empty($_SESSION['suid'])) || ($_SESSION['login']!== 'Vanestarre'))
{
    header('Location: login.php');
    exit();
}

$page_actuelle=$_GET['page'];

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Vanéstarre</title>
        <link rel="stylesheet" href="./css/style.css">
    </head>
    <style>A {text-decoration: none;} </style>
    <body>
        <!-- Boutons pour changer de pages -->
        <div align="right"><p> <a href="./admin.php">Interface administrateur    </a> <a href="./profil.php">Profil    </a><a href="./index.php?logout=true">Déconnexion</a></p></div>

        <!-- Logo Vanestarre -->
        <div class="logo"><a href="./index.php"> <img src="./images/Vanestarre.png"> </a></div>

        <!-- Titre de la page -->
        <h1 class="shadow">Vanéstarre</h1>

        <!-- Boite de texte de la recherche par tags -->
        <div id="search" align="center">
            <label for="site-search">Recherche par tag:</label>
            <input type="search" id="tag-search" name="q" placeholder="βtag" pattern="β[A-z]">

            <button>Recherche</button>
            <span class="validity"></span>
        </div> <br>

        <!-- Boite de texte d'envoi de messages -->
        <div id="post" align="center">
            <form action="Messages&Reactions/post-message.php" method="post">
                <label for="post-message">Entrez votre message:</label>
                <input type="text" id="post-message" name="message" placeholder="Entrez votre message (50 caractères max.)" required maxlength="50">
                <input type="submit" value="Poster" />
                <span class="validity"></span>
            </form>
        </div>
        <?php
            // Connexion à la base de données
            connect_bd($dbLink);

            // Récupération du nombre de posts max voulus par page
            $query = 'SELECT nbPost FROM pages';
            $result = mysqli_query($dbLink, $query);
            $row=mysqli_fetch_array($result);
            $nbPost=$row['nbPost'];
            
            // Récupération du nombre de posts total
            $query = 'SELECT COUNT(*) AS nb_messages FROM messages';
            $result = mysqli_query($dbLink, $query);
            $row=mysqli_fetch_array($result);
            $nbPostTotal=$row['nb_messages'];
            
            $nbPages = ceil($nbPostTotal/$nbPost);
            
            // Récupération des $nbPost derniers messages
            //$query = 'SELECT * FROM messages ORDER BY id DESC LIMIT 0, ' . $nbPost;
            //$result = mysqli_query($dbLink, $query);
            
            if(!isset($page_actuelle) || empty($page_actuelle))
            {
                $page_actuelle=0;
            }
            
            if($page_actuelle===0)
            {
                // Récupération des $nbPost derniers messages PREMIERE PAGE
                $query = 'SELECT * FROM messages ORDER BY id DESC LIMIT 0, ' . $nbPost;
                $result = mysqli_query($dbLink, $query);
            }else{
                // Récupération des $nbPost derniers messages AUTRE PAGE
                $offset = $nbPost*$page_actuelle;
                $query = 'SELECT * FROM messages ORDER BY id DESC LIMIT ' . $offset . ', ' . $nbPost;
                $result = mysqli_query($dbLink, $query);
            }
        ?>
        <!-- Les différents posts de Vanestarre -->
        <div id="vaneline">
            <?php
                //affichage des posts
                while ($row=mysqli_fetch_array($result)){
                    echo '<div id="post">' .
                            '<p>' . $row['message'] . '</p>' .
                            '<form action="Messages&Reactions/post-reaction.php?id= '.$row['ID'].' " method="post">' .
                            '<button type="submit" name="reaction" value="love"> &#128151 <br/>' . $row['love'] . '</button>' .
                            '<button type="submit" name="reaction" value="cute"> &#128525 <br/>' . $row['cute'] . '</button>' .
                            '<button type="submit" name="reaction" value="style"> &#128559 <br/>' . $row['style'] . '</button>' .
                            '<button type="submit" name="reaction" value="swag"> &#128526 <br/>' . $row['swag'] . '</button>' .
                            '</form>' .
                            '<p align="left">Tags : <a href="rentrer search tag">βchien</a>, <a href="rentrer search tag">βloremipsum</a></p>' .
                            '<br/>' .
                         '</div>';
                }
            ?>


            <div id="buttonPage">

                <?php if ($page_actuelle != 0) { ?>
                    <a href="connected-vanestarre.php?page=<?php echo $page_actuelle-1 ?>"><img src="./images/flecheg.png"> </a>
                <?php } ?>

                <?php if ($page_actuelle != $nbPages-1) { ?>
                    <a href="connected-vanestarre.php?page=<?php echo $page_actuelle+1 ?>"><img src="./images/fleched.png"> </a>
                <?php } ?>

            </div>




        </div>
    </body>
</html>

