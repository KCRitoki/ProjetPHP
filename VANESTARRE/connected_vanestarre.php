<?php
include 'VANESTARRE/functions.php';
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
		<div align="right"><p> <a href="./interface.php">Interface    </a> <a href="./profil.php">Profil    </a><a href="./index.html">Déconnexion</a></p></div>

		<!-- Logo Vanestarre -->
		<div id="logo"><img src="./images/Vanestarre.png"></div>

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

            // Récupération des 10 derniers messages
            $query = 'SELECT * FROM messages ORDER BY ID DESC';
            $result = mysqli_query($dbLink, $query);
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
		</div>
	</body>
</html>
