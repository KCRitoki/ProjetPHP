<?php
include 'functions.php';
session_start();
if ((!isset($_SESSION['suid']) || empty($_SESSION['suid'])) || ($_SESSION['login']!== 'Vanestarre'))
{
	header('Location: login.php');
	exit();
}

$output=$_SESSION['output'];
$outputString=$_SESSION['outputString'];
$outputName=$_SESSION['outputName'];
?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<title>Administration</title>
		<link rel="stylesheet" href="./css/style.css">
	</head>
	<style>A {text-decoration: none;} </style>
	<body>
		<!-- Boutons pour changer de pages -->
		<div align="right"><p> <a href="./index.php">Accueil    </a> <a href="./profil.php">Profil    </a><a href="./index.php">Déconnexion</a></p></div>

		<!-- Logo Vanestarre -->
		<div id="logo"><img src="./images/Vanestarre.png"></div>

		<!-- Titre de la page -->
		<h1 class="shadow">Administration</h1>

		<!-- Formulaires -->	
		<h2>Gérer les Membres</h2>
		<div id="formulairesMembre">
			<!--  Créer un membre  -->
			<div class="formulaires">
				<form action="admin-processing.php" method="post" class="formAdmin">
					<div class="formAdmin">
						<label for="email">Entrez l'email: </label>
						<input type="email" name="email" id="email" required>
					</div>
					<div class="formAdmin">
						<label for="login">Entrez le login: </label>
						<input type="text" name="login" id="login" required>
					</div>
					<div class="formAdmin">
						<label for="password">Entrez le password: </label>
						<input type="password" name="password" id="password" required>
					</div>
					<input type="submit" name="action" value="CMembre" />
				</form>
			</div>
			<!--  Lire un membre  -->
			<div class="formulaires">
				<form action="admin-processing.php" method="post" class="formAdmin">
					<div class="formAdmin">
						<label for="login">Entrez le login: </label>
						<input type="text" name="login" id="login" required>
					</div>
					<input type="submit" name="action" value="RMembre" />
				</form>
			</div>
			<!--  Mettre à jour un membre  -->
			<div class="formulaires">
				<form action="admin-processing.php" method="post" class="formAdmin">
					<div class="formAdmin">
						<label for="id">Entrez l'id du membre: </label>
						<input type="number" name="id" id="id" required>
					</div>
					<div class="formAdmin">
						<label for="email">Entrez l'email: </label>
						<input type="email" name="email" id="email" required>
					</div>
					<div class="formAdmin">
						<label for="login">Entrez le login: </label>
						<input type="text" name="login" id="login" required>
					</div>
					<input type="submit" name="action" value="UMembre" />
				</form>
			</div>
			<!--  Supprimer un membre  -->
			<div class="formulaires">
				<form action="admin-processing.php" method="post" class="formAdmin">
					<div class="formAdmin">
						<label for="login">Entrez le login: </label>
						<input type="text" name="login" id="login" required>
					</div>
					<input type="submit" name="action" value="DMembre" />
				</form>
			</div>
		</div>


		<h2>Gérer les Messages</h2>
		<div id="formulairesMessages">
			<!--  Créer un message  -->
			<div class="formulaires">
				<form action="admin-processing.php" method="post" class="formAdmin">
					<div class="formAdmin">
						<label for="message">Entrez le message: </label>
						<input type="text" name="message" id="message" required>
					</div>
					<input type="submit" name="action" value="CMessage" />
				</form>
			</div>
			<!--  Lire un message  -->
			<div class="formulaires">
				<form action="admin-processing.php" method="post" class="formAdmin">
					<div class="formAdmin">
						<label for="id">Entrez l'id du message: </label>
						<input type="number" name="id" id="id" required>
					</div>
					<input type="submit" name="action" value="RMessage" />
				</form>
			</div>
			<!--  Mettre à jour un message  -->
			<div class="formulaires">
				<form action="admin-processing.php" method="post" class="formAdmin">
					<div class="formAdmin">
						<label for="id">Entrez l'id du message: </label>
						<input type="number" name="id" id="id" required>
					</div>
					<div class="formAdmin">
						<label for="message">Entrez le message: </label>
						<input type="text" name="message" id="message" required>
					</div>
					<div class="formAdmin">
						<label for="love">Entrez le nombre de "love": </label>
						<input type="number" name="love" id="love" required>
					</div>
					<div class="formAdmin">
						<label for="cute">Entrez le nombre de "cute": </label>
						<input type="number" name="cute" id="cute" required>
					</div>
					<div class="formAdmin">
						<label for="style">Entrez le nombre de "style": </label>
						<input type="number" name="style" id="style" required>
					</div>
					<div class="formAdmin">
						<label for="swag">Entrez le nombre de "swag": </label>
						<input type="number" name="swag" id="swag" required>
					</div>
					<input type="submit" name="action" value="UMessage" />
				</form>
			</div>
			<!--  Supprimer un message  -->
			<div class="formulaires">
				<form action="admin-processing.php" method="post" class="formAdmin">
					<div class="formAdmin">
						<label for="id">Entrez l'id du message: </label>
						<input type="number" name="id" id="id" required>
					</div>
					<input type="submit" name="action" value="DMessage" />
				</form>
			</div>
			<!--  Limites de love  -->
			<div class="formulaires">
				<form action="admin-processing.php" method="post" class="formAdmin">
					<div class="formAdmin">
						<label for="id">Entrez l'id du message: </label>
						<input type="number" name="id" id="id" required>
					</div>
					<div class="formAdmin">
						<label for="limMin">Entrez la valeur minimale de "love": </label>
						<input type="number" name="limMin" id="limMin" required>
					</div>
					<div class="formAdmin">
						<label for="limMax">Entrez la valeur maximale de "love": </label>
						<input type="number" name="limMax" id="limMax" required>
					</div>
					<input type="submit" name="action" value="SetLimit" />
				</form>
			</div>
			<!--  Limites de posts par page  -->
			<div class="formulaires">
				<form action="admin-processing.php" method="post" class="formAdmin">
					<div class="formAdmin">
						<label for="nbPosts">Entrez le nombre de posts par page: </label>
						<input type="number" name="nbPost" id="nbPost" required>
					</div>
				</form>
			</div>
		</div>


		<div id="console">
		
		<?php
		if(isset($output) && !empty($output))
		{
			if($outputName==='users')
			{
		?>
			<table style="width:100%">
				<tr>
					<th>id</th>
					<th>email</th>
					<th>login</th>
					<th>password</th>
				</tr>
				<tr>
					<td><?php echo $output[0]?></td>
					<td><?php echo $output[1]?></td>
					<td><?php echo $output[2]?></td>
					<td><?php echo $output[3]?></td>
				</tr>
			</table>
		<?php
			}
			
			elseif($outputName==='messages')
			{
		?>
			<table style="width:100%">
				<tr>
					<th>id</th>
					<th>message</th>
					<th>love</th>
					<th>cute</th>
					<th>style</th>
					<th>swag</th>
					<th>seuil_love</th>
					<th>limite_min</th>
					<th>limite_max</th>
				</tr>
				<tr>
					<td><?php echo $output[0]?></td>
					<td><?php echo $output[1]?></td>
					<td><?php echo $output[2]?></td>
					<td><?php echo $output[3]?></td>
					<td><?php echo $output[4]?></td>
					<td><?php echo $output[5]?></td>
					<td><?php echo $output[6]?></td>
					<td><?php echo $output[7]?></td>
					<td><?php echo $output[8]?></td>
				</tr>
			</table>
		<?php
			}
		}
		
		elseif(isset($outputString) && !empty($outputString))
		{
			echo $outputString;
		}
		unset($_SESSION['output']);
		unset($_SESSION['outputString']);
		unset($_SESSION['outputName']);
		?>
		
		</div>







	</body>
</html>