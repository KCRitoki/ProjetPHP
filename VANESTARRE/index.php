<?php
include 'functions.php';
session_start();

if (isset($_GET['logout']) && $_GET['logout']==='true')
{
	unset($_SESSION['suid']);
	unset($_SESSION['login']);
	unset($_SESSION['mail']);
	unset($_GET['logout']);
}

if (isset($_SESSION['suid']) || !empty($_SESSION['suid']))
{
	if ($_SESSION['login']=== 'Vanestarre')
	{
		header('Location: connected-vanestarre.php');
		exit();
	}
	header('Location: connected.php');
	exit();
}
?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<title>Vanéstarre</title>
		<link rel="stylesheet" href="./css/style.css">
	</head>

	<body>
		<div align="right"><p><a href="http://bdr-projet.alwaysdata.net/login.php">Connexion</a>/<a href="http://bdr-projet.alwaysdata.net/inscription.php">Inscription</a></p></div>
		<div id="logo"><img src="./images/Vanestarre.png"></div>
		<h1 class="shadow">Vanéstarre</h1>
		<div id="search" align="center">
			<label for="site-search">Recherche par tag:</label>
			<input type="search" id="tag-search" name="q" placeholder="βtag" pattern="β[A-z]">

			<button>Recherche</button>
			<span class="validity"></span>
		</div>
		<?php
            // Connexion à la base de données
            connect_bd($dbLink);

			// Récupération du nombre de posts max voulus par page
			$query = 'SELECT nbPost FROM pages';
			$result = mysqli_query($dbLink, $query);
			$row=mysqli_fetch_array($result);
			$nbPost=$row['nbPost'];
			
            // Récupération des $nbPost derniers messages
            $query = 'SELECT * FROM messages ORDER BY id DESC LIMIT 0, ' . $nbPost;
            $result = mysqli_query($dbLink, $query);
        ?>

        <!-- Les différents posts de Vanestarre -->
        <div id="vaneline">
            <?php
                //affichage des posts
                while ($row=mysqli_fetch_array($result)){
                    echo '<div id="post">' .
                            '<p>' . $row['message'] . '</p>' .
                            '<form action="Messages&Reactions/post-reaction.php?id= '.$row['id'].' " method="post">' .
                            '<button type="submit" name="reaction" value="love" disabled> &#128151 <br/>' . $row['love'] . '</button>' .
                            '<button type="submit" name="reaction" value="cute" disabled> &#128525 <br/>' . $row['cute'] . '</button>' .
                            '<button type="submit" name="reaction" value="style" disabled> &#128559 <br/>' . $row['style'] . '</button>' .
                            '<button type="submit" name="reaction" value="swag" disabled> &#128526 <br/>' . $row['swag'] . '</button>' .
                            '</form>' .
                            '<p align="left">Tags : <a href="rentrer search tag">βchien</a>, <a href="rentrer search tag">βloremipsum</a></p>' .
                            '<br/>' .
                         '</div>';
                }
            ?>
        </div>


	</body>






</html>

