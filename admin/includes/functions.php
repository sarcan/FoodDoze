<?php

// String desinfizieren
function desinfect($str) {
	$str = trim($str); // Whitespaces entfernen 
	$str = stripslashes($str); // Entfernt Maskierungszeichen
	$str = filter_var($str, FILTER_SANITIZE_STRING); // Filtern von Variablen 
	$str = strip_tags($str); // Entfernt HTML- und PHP-Tags
	$str = htmlspecialchars($str); // Wandelt Sonderzeichen um
	return $str;
};

// Decrypt String
function decrypt($str) {
	$str = html_entity_decode($str); // Konvertiert HTML-Entities um
	$str = htmlspecialchars_decode($str); // Konvertiert HTMLäZeichen in Buchstaben um 
	return $str;
}

// Email validieren
function validateEmail($str) {
	$cleanEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Entfernt illegale Zeichen in einer Emailadresse
	if (filter_var($cleanEmail, FILTER_VALIDATE_EMAIL)) { // Validiert Emailadresse
		return $cleanEmail; // Retourniert Emailadresse
	}
	return false;
}
?>