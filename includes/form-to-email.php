<?php
require_once('./admin/includes/functions.php');

global $errorMessage;
$sendMessage = '';

// Leere Felder
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    /* Felder ausgefüllt? */
    if (
    empty($_POST['anrede']) ||
    empty($_POST['vorname']) || 
    empty($_POST['nachname']) ||
    empty($_POST['email']) || 
    empty($_POST['message'])) {
        $errorMessage = 'Bitte alle Felder ausfüllen';
    }
    /* Email? */
    elseif(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false){
        $errorMessage = 'ungültige E-Mail-Adresse';
    }
    /* Checkbox? */
    elseif(empty($_POST['checkbox'])){
        $errorMessage = 'Bitte akzeptiere die AGB';
    }
    // Alles okay
    else {
        $anrede = $_POST['anrede'];
        $vorname = desinfect($_POST['vorname']);
        $nachname = desinfect($_POST['nachname']);
        $email = desinfect($_POST['email']);
        $dropdown = $_POST['dropdown'];
        $checkbox = $_POST['checkbox'];
        $messageVal = desinfect($_POST['message']);
        $message = wordwrap($messageVal, 70, "\r\n");

        // Empfänger
        $to = "sarmayca@protonmail.ch";
        // Betreff
        $subject = "$vorname $nachname kontaktiert dich via Food Doze!";
        // Inhalt
        $body = "Neue Nachricht von $anrede $nachname via Food Doze. \n\n "."Name: \n $vorname $nachname \n \n Email: \n $email \n \n Nachricht: \n \n $message";
        // Email von
        $header = "From: noreply@fooddoze.com\n";
        // Antwort an
        $mail = mail($to,$subject,$body,$header);
        // Feedback
        $sendMessage = 'Vielen Dank für deine Nachricht! Sie wurde erfolgreich verschickt.';
    }
}

?>