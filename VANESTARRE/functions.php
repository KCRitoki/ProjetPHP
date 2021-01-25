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
?>