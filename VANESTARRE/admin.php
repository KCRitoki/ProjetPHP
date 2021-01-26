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
				<form action="" method="get" class="formAdmin">
					<div class="formAdmin">
						<label for="email">Entrez l'email: </label>
						<input type="email" name="email" id="email" required>
					</div>
				</form>
				<form action="" method="get" class="formAdmin">
					<div class="formAdmin">
						<label for="login">Entrez le login: </label>
						<input type="text" name="login" id="login" required>
					</div>
				</form>
				<form action="" method="get" class="formAdmin">
					<div class="formAdmin">
						<label for="password">Entrez le password: </label>
						<input type="password" name="password" id="password" required>
					</div>
				</form>
			</div>
			<!--  Lire un membre  -->
			<div class="formulaires">
				<form action="" method="get" class="formAdmin">
					<div class="formAdmin">
						<label for="login">Entrez le login: </label>
						<input type="text" name="login" id="login" required>
					</div>
				</form>
			</div>
			<!--  Mettre à jour un membre  -->
			<div class="formulaires">
				<form action="" method="get" class="formAdmin">
					<div class="formAdmin">
						<label for="id">Entrez l'id du membre: </label>
						<input type="number" name="id" id="id" required>
					</div>
				</form>
				<form action="" method="get" class="formAdmin">
					<div class="formAdmin">
						<label for="email">Entrez l'email: </label>
						<input type="email" name="email" id="email" required>
					</div>
				</form>
				<form action="" method="get" class="formAdmin">
					<div class="formAdmin">
						<label for="login">Entrez le login: </label>
						<input type="text" name="login" id="login" required>
					</div>
				</form>
			</div>
			<!--  Supprimer un membre  -->
			<div class="formulaires">
				<form action="" method="get" class="formAdmin">
					<div class="formAdmin">
						<label for="login">Entrez le login: </label>
						<input type="text" name="login" id="login" required>
					</div>
				</form>
			</div>
		</div>


		<h2>Gérer les Messages</h2>
		<div id="formulairesMessages">
			<!--  Créer un message  -->
			<div class="formulaires">
				<form action="" method="get" class="formAdmin">
					<div class="formAdmin">
						<label for="message">Entrez le message: </label>
						<input type="text" name="message" id="message" required>
					</div>
				</form>
			</div>
			<!--  Lire un message  -->
			<div class="formulaires">
				<form action="" method="get" class="formAdmin">
					<div class="formAdmin">
						<label for="id">Entrez l'id du message: </label>
						<input type="number" name="id" id="id" required>
					</div>
				</form>
			</div>
			<!--  Mettre à jour un message  -->
			<div class="formulaires">
				<form action="" method="get" class="formAdmin">
					<div class="formAdmin">
						<label for="id">Entrez l'id du message: </label>
						<input type="number" name="id" id="id" required>
					</div>
				</form>
				<form action="" method="get" class="formAdmin">
					<div class="formAdmin">
						<label for="message">Entrez le message: </label>
						<input type="text" name="message" id="message" required>
					</div>
				</form>
				<form action="" method="get" class="formAdmin">
					<div class="formAdmin">
						<label for="id">Entrez le nombre de "love": </label>
						<input type="number" name="love" id="love" required>
					</div>
				</form>
				<form action="" method="get" class="formAdmin">
					<div class="formAdmin">
						<label for="id">Entrez le nombre de "cute": </label>
						<input type="number" name="cute" id="cute" required>
					</div>
				</form>
				<form action="" method="get" class="formAdmin">
					<div class="formAdmin">
						<label for="id">Entrez le nombre de "style": </label>
						<input type="number" name="style" id="style" required>
					</div>
				</form>
				<form action="" method="get" class="formAdmin">
					<div class="formAdmin">
						<label for="id">Entrez le nombre de "swag": </label>
						<input type="number" name="swag" id="swag" required>
					</div>
				</form>
			</div>
			<!--  Supprimer un message  -->
			<div class="formulaires">
				<form action="" method="get" class="formAdmin">
					<div class="formAdmin">
						<label for="id">Entrez l'id du message: </label>
						<input type="number" name="id" id="id" required>
					</div>
				</form>
			</div>
		</div>


		<div id="console">




		</div>







	</body>
</html>