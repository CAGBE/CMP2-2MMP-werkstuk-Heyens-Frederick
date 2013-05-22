<?php

// 1. Maak verbinding met de database via MySQLi.


// 2. Definieer eigen functies die je meermaals nodig hebt.
//    vb. een `markdown`-functie die de parser in `markdown.php`
//        aanspreekt



	//Ophalen van Markdown.php
	include('libs/Markdown.php');

	//inlog gegevens (database)
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'movies';
	

	$db = new mysqli($host, $user, $password, $database);
	
	//bij verbindingsfout, foutmelding geven
	if($db->connect_errno){
		die('Verbinding mislukt: ' . $db->connect_error);
	}
	
	// character encoding
	$db->query('SET NAMES utf8');


	//Ophalen van content en laten controleren door Markdown
	function md($str){
		$lalala = Markdown($str);
		return $lalala;

	};
?>