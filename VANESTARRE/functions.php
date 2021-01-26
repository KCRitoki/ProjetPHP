<?php
	function start_page($title)
	{
		echo '<!DOCTYPE html><html
		lang="fr"><head><title>' . PHP_EOL . $title . '</title></head><body>' . PHP_EOL;
	};
	
	function end_page()
	{
		echo '</body></html>' . PHP_EOL;
	};
	
	function connect_bd(&$dbLink)
	{
		$dbLink = mysqli_connect('mysql-bdr-projet.alwaysdata.net', '223944', '*9NWFBZ3MHMmAD7')
			or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
		
		mysqli_select_db($dbLink, 'bdr-projet_bdd')
			or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
	};

// FONCTIONS CRUD MEMBRES
	function create_member($email, $login, $password)
	{
		connect_bd($dbLink);
		$query = 'INSERT INTO users VALUES (\'' . $email . '\', \'' . $login . '\', \'' . $password . '\');';
		if(!($dbResult = mysqli_query($dbLink, $query)))
		{
			echo 'Erreur dans requête<br />';
			// Affiche le type d'erreur.
			echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
			// Affiche la requête envoyée.
			echo 'Requête : ' . $query . '<br/>';
			exit();
		}
	};
	
	function read_member($login)
	{
		connect_bd($dbLink);
		$query = 'SELECT * FROM users WHERE login=\'' . $login . '\';';
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
		if(!empty($row))
		{
			return $row;
		}
	};
	
	function update_member($id, $email, $login)
	{
		connect_bd($dbLink);
		$query = 'UPDATE users SET email=\'' . $email . '\', login=\'' . $login . '\' WHERE id=\'' . $id . '\';';
		if(!($dbResult = mysqli_query($dbLink, $query)))
		{
			echo 'Erreur dans requête<br />';
			// Affiche le type d'erreur.
			echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
			// Affiche la requête envoyée.
			echo 'Requête : ' . $query . '<br/>';
			exit();
		}
	};
	
	function delete_member($login)
	{
		connect_bd($dbLink);
		$query = 'DELETE FROM users WHERE login=\'' . $login . '\';';
		if(!($dbResult = mysqli_query($dbLink, $query)))
		{
			echo 'Erreur dans requête<br />';
			// Affiche le type d'erreur.
			echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
			// Affiche la requête envoyée.
			echo 'Requête : ' . $query . '<br/>';
			exit();
		}
	};
	
// FONCTIONS CRUD MESSAGES
	function create_message($message)
	{
		connect_bd($dbLink);
		$query = 'INSERT INTO messages VALUES (\'' . $message . '\');';
		if(!($dbResult = mysqli_query($dbLink, $query)))
		{
			echo 'Erreur dans requête<br />';
			// Affiche le type d'erreur.
			echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
			// Affiche la requête envoyée.
			echo 'Requête : ' . $query . '<br/>';
			exit();
		}
	};
	
	function read_message($id)
	{
		connect_bd($dbLink);
		$query = 'SELECT * FROM messages WHERE id=\'' . $id . '\';';
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
		if(!empty($row))
		{
			return $row;
		}
	};
	
	function update_message($id, $message, $love, $cute, $style, $swag)
	{
		connect_bd($dbLink);
		$query = 'UPDATE messages SET message=\'' . $message . '\', love=\'' . $love . '\', cute=\'' . $cute . '\', style=\'' . $style . '\', swag=\'' . $swag . '\' WHERE id=\'' . $id . '\';';
		if(!($dbResult = mysqli_query($dbLink, $query)))
		{
			echo 'Erreur dans requête<br />';
			// Affiche le type d'erreur.
			echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
			// Affiche la requête envoyée.
			echo 'Requête : ' . $query . '<br/>';
			exit();
		}
	};
	
	function delete_message($id)
	{
		connect_bd($dbLink);
		$query = 'DELETE FROM messages WHERE id=\'' . $id . '\';';
		if(!($dbResult = mysqli_query($dbLink, $query)))
		{
			echo 'Erreur dans requête<br />';
			// Affiche le type d'erreur.
			echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
			// Affiche la requête envoyée.
			echo 'Requête : ' . $query . '<br/>';
			exit();
		}
	};
?>