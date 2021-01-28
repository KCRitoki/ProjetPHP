<?php
include 'functions.php';
session_start();
if (!isset($_SESSION['suid']) || empty($_SESSION['suid']))
{
	header('Location: login.php');
	exit();
}

if(isset($_SESSION['login']) && $_SESSION['login']=== 'Vanestarre')
{
	header('Location: connected-vanestarre.php');
	exit();
}

$bitcoin=$_SESSION['bitcoin'];

$page_actuelle=$_GET['page'];
?>
<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Vanéstarre</title>
		<link rel="stylesheet" href="./css/style.css">
	</head>
	<style>A {text-decoration: none;} </style>
	<body>
		<div class="nav"><p><a href="./profil.php">Profil    </a><a href="./index.php?logout=true">Déconnexion</a></div>
		<div class="logo"><a href="./index.php"> <img src="./images/Vanestarre.png" alt="logo"> </a></div>
		<h1 class="shadow">Vanéstarre</h1>
		<div id="search">
			<label for="tag-search">Recherche par tag:</label>
			<input type="search" id="tag-search" name="q" placeholder="βtag" pattern="β[A-z]">

			<button>Recherche</button>
			<span class="validity"></span>
		</div>

		<?php
			if($bitcoin===true)
			{
		?>
			<div id="bitcoin">
				<p> Félicitations, vous venez de gagner l'opportunité de donner 10 bitcoins (252 050,20€) à la grande Vanestarre </p>
			</div>
		<?php
			}
			unset($bitcoin);
			unset($_SESSION['bitcoin']);
		?>
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
                    echo '<div class="post">' .
                            '<p>' . $row['message'] . '</p>' .
                            '<form action="Messages&Reactions/post-reaction.php?id='.$row['id'].' " method="post">' .
                            '<button type="submit" name="reaction" value="love"> &#128151;<br/>' . $row['love'] . '</button>' .
                            '<button type="submit" name="reaction" value="cute"> &#128525;<br/>' . $row['cute'] . '</button>' .
                            '<button type="submit" name="reaction" value="style"> &#128559;<br/>' . $row['style'] . '</button>' .
                            '<button type="submit" name="reaction" value="swag"> &#128526;<br/>' . $row['swag'] . '</button>' .
                            '</form>';
                            // Récupération de la taglist
							$query2 = 'SELECT * FROM tags WHERE idMessage=\'' . $row['id'] . '\';';
							$result2 = mysqli_query($dbLink, $query2);				
							if(mysqli_num_rows($result2)>0)
							{
								$row2=mysqli_fetch_array($result2);
								$taglist=$row2['taglist'];
								echo '<p align="left">Tags : ';
								if(!preg_match('~β.[^ ]*~', $taglist, $output))
								{
									break;
								}
								echo $output[0];
								$taglist=substr($taglist,strlen($output[0]));
								while(preg_match('~β.[^ ]*~', $taglist, $output))
								{
									echo ', ' . $output[0];
									$taglist=substr($taglist,strlen($output[0]));
								}
							}
                            echo '<br/>' .
                         '</div>';
                }
            ?>

            <div id="buttonPage">

            	<?php if ($page_actuelle != 0) { ?>
            		<a href="connected.php?page=<?php echo $page_actuelle-1 ?>"><img src="./images/flecheg.png" alt="fleche-gauche"> </a>
            	<?php } ?>

				<?php if ($page_actuelle != $nbPages-1) { ?>
            		<a href="connected.php?page=<?php echo $page_actuelle+1 ?>"><img src="./images/fleched.png" alt="fleche-droite"> </a>
            	<?php } ?>

            </div>

        </div>
	</body>
</html>
