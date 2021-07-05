<?php
session_start();
// print_r($_SESSION);
echo "<pre></pre>";
$username = $_SESSION['adminemail'];
// echo "<pre></pre>";
// echo($username);
// echo "<pre></pre>";
$adminright = $_SESSION['adminright'];
echo "<pre></pre>";
echo($adminright);

// $admin_email = $_SESSION["username"];
// print_r($email);

// Requires
require_once('includes/config.php');
require_once('includes/mysql_connect.php');
require_once('includes/sessioncheck.php');

// Sessionchecks
if(!sessionCheck()) {
    session_unset();
	session_regenerate_id();
    header("Location: login.php");
    die();
}

// refresh session
session_regenerate_id(); 
$_SESSION['timestamp'] = time();

// Header
include('includes/html/header.php');

?>

    <section class="admin-content">
            <h1>Willkommen!</h1>
            <div class="grid dashboard-grid">
                <a href="rezepte.php" class="tile">
                    <i class="fas fa-coffee"></i>
                    <p>Rezepte</p>
                </a>
                <a href="erstellen.php"  class="tile">
                    <i class="fas fa-pizza-slice"></i>
                    <p>Neues Rezept</p>
                </a>
                <a href="benutzer.php"  class="tile">
                    <i class="fas fa-users"></i>
                    <p>Benutzer</p>
                </a>
                <a href="admin.php"  class="tile">
                    <i class="fas fa-users"></i>
                    <p>Admins</p>
                </a>
            </div>
    </section>
    
</section>


<?php
// Footer
include('includes/html/footer.php'); 
?>