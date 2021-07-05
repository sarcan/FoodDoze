<?php
session_start();
// print_r($_SESSION);

// Requires
require_once('includes/config.php');
require_once('includes/mysql_connect.php');
require_once('includes/functions.php');
require_once('includes/sessioncheck.php');

// get all Admins
$query = "SELECT * FROM admins";
$result = mysqli_query($connection, $query);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)) { 
        $admins [] = [
            'id' => $row['IDadmin'],
            'name' => $row['admin_name'],
            'email' => $row['admin_email']
        ];
    }
    // print_r($clients);
    
} else {
    die("No results.");
}

// Create new user
// print_r($_POST);
$hasError = false;
$success = false;
$messages = array();

// Has the form been sent?
if (isset($_POST['submit'])) {
    $name = desinfect($_POST['name']);
    $passwort = desinfect($_POST['passwort']);
    $email = validateEmail($_POST['email']);
    // print_r($name);
    // print_r($passwort);
    // print_r($email);

    // Is the email adress filled out?
    if (empty($email)) {
        $hasError = true;
		$messages[] = 'Email fehlt';
    }
    else { // Does this email adress already exist?
        $takenquery = "SELECT * FROM `admins` WHERE `admin_email`=?";
        // print_r($takenquery);
        $stmt = mysqli_prepare($connection, $takenquery);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $resultat = mysqli_stmt_get_result($stmt);
        // print_r($resultat);
        $numrows = mysqli_num_rows($resultat);
        print_r($numrows);

        if ($numrows == 1) {
            $data =mysqli_fetch_assoc($resultat);
            $hasError = true;
            $messages[] = 'Sorry diese Emailadresse existiert bereits.';
        }
    }
    // Is the name field filled out? 
    if (empty($name)) {
        $hasError = true;
		$messages[] = 'Bitte gib einen Namen an.';
    } 
    // Validate name
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $hasError = true;
        $messages[] = "Ungültiger Name angegeben.";
    } // Length of last name
    elseif (strlen($name) < 2 || strlen($name) > 40) {
        $hasError = true;
		$messages[] = 'Dein Name muss aus mindestens 2 und höchstens 40 Zeichen bestehen.';
    }
    if (empty($passwort)) {
        $hasError = true;
		$messages[] = 'Bitte gib dein Passwort ein.';
        // Paasswort has to be at least one number and no more than six characters
    } else if (!preg_match('/^(?=.*[0-9]+.*)(?=.*[a-zA-Z]+.*)[0-9a-zA-Z]{6,50}$/', $passwort)) {
        $hasError = true;
		$messages[] = 'Dein Passwort muss mindestens 6 Zeichen lang sein und eine Zahl enthalten.';
    }
    // If no errors hash password
    if ($hasError == false) {
        $passwort_gehasht = password_hash($passwort, PASSWORD_DEFAULT);

        $query_kunde = "INSERT INTO `admins` (`admin_name`, `admin_email`, `admin_password`) VALUES (?, ?, ?)";

        $prepared = mysqli_prepare($connection, $query_kunde);
        mysqli_stmt_bind_param($prepared, 'sss', $name, $email, $passwort_gehasht); 
        mysqli_stmt_execute($prepared);

        $clientID = mysqli_insert_id($connection);

        // Reload Page
        header("Refresh:0");

        $success = true;
        // $messages[] = 'Neuer Admin erstellt';
        // echo 'Das ist die neue Id des Kundendatensatzes'.$clientID;
    }
}

// Delete admin
if (isset($_POST['delete'])) {
    $deleteid = $_POST['delete']; // Get ID
    $deletequery = "DELETE FROM `admins` WHERE `IDadmin` = ?"; // Query & Prepare Statement
    $stmt = mysqli_prepare($connection, $deletequery);
    mysqli_stmt_bind_param($stmt, 'i', $deleteid);

    if (mysqli_stmt_execute($stmt)) {
        $success = true;
        $messages [] = 'Admin wurde gelöscht';
        header("Location: admin.php");
        die();
    } else {
        $hasError = true;
        $messages [] = 'Sorry, etwas ging schief.';
    }
}

// Header
include('includes/html/header.php');
?>

    <section class="admin-content">
        <h1>Admins</h1>
        <?=isset($_GET['updated']) ? "<div class=\"successmessage\"><strong>Admin wurde erfolgreich aktualisiert!</strong></div>" : ""?>                          

        <div class="grid benutzer-grid">
        <?php foreach(array_values($admins) as $key => $admin) { ?>
            <div class="tile">
                <i class="fas fa-users-cog"></i>
                <div class="information">
                    <p class="name"><?php echo ucfirst($admin ["name"])?></p>
                    <p class="mail"><?php echo $admin ["email"]?></p>
                    <p class="id">Id: <?php echo $admin ["id"]?></p>
                    <form action="" method="post">
                        <button type="delete" name="delete" class="delete" value="<?=$admin["id"]?>"><i class="fas fa-trash"></i></button>
                        <a href="edit_admin.php?id=<?=$admin["id"]?>" class="bearbeiten"><i class="fas fa-edit"></i></a>
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>
        <h2>Neuer Admin</h2>
        <?php if( count($messages)>0 ){ ?> 
		<div class="error">
			<?php echo implode('<br>', $messages); ?>
		</div>
	    <?php } ?>
        <form name="admin-formular" method="post"> 
            <input type="hidden" name="new" value="1"/>
            <input type="text" name="name" placeholder="Name eingeben" required/>
            <input type="text" name="email" placeholder="Emailadresse einegeben" required/>
            <input type="text" name="passwort" placeholder="Passwort" required/>
            <button type="submit" name="submit">Abschicken</button>
        </form>

    </section>

</section>

<?php
// Footer
include('includes/html/footer.php'); 
?>