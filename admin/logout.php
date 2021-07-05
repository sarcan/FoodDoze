<?php
// Session starten
session_start();
$_SESSION = array();
// Session Variabeln löschen
session_unset();

if (ini_get("session.use_cookies")) {
    $cookieParameter = session_get_cookie_params();
    setcookie(session_name(), "", time() - 42000, $cookieParameter["path"],
    $params["domain"], $params["secure"], $params["httponly"]
    );
}

// Alle Daten in einer registrierten Session löschen
session_destroy();
header("Location: login.php");
?>