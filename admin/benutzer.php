<?php
session_start();
// print_r($_SESSION);

// Requires
require_once('includes/config.php');
require_once('includes/mysql_connect.php');
require_once('includes/functions.php');
require_once('includes/sessioncheck.php');

// session check
if(!sessionCheck()) {
    session_unset();
	session_regenerate_id();
    header("Location: login.php");
    die();
}

// get all Clients
$query = "SELECT * FROM clients";
$result = mysqli_query($connection, $query);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)) { 
        $clients [] = [
            'id' => $row['IDclient'],
            'firstname' => $row['client_first_name'],
            'name' => $row['client_name'],
            'email' => $row['client_email']
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
    $vorname = desinfect($_POST['vorname']);
    $name = desinfect($_POST['nachname']);
    $passwort = desinfect($_POST['passwort']);
    $email = validateEmail($_POST['email']);
    // print_r($vorname);
    // print_r($name);
    // print_r($passwort);
    // print_r($email);

    // Is the email adress filled out?
    if (empty($email)) {
        $hasError = true;
		$messages[] = 'Email fehlt';
    }
    else { // Does this email adress already exist?
        $takenquery = "SELECT * FROM `clients` WHERE `client_email`=?";
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
    // Are the input fields filled out? 
    if (empty($vorname) || empty($name)) {
        $hasError = true;
		$messages[] = 'Bitte gib einen Vor- und Nachnamen an.';
    } 
    // Validate name
    if (!preg_match("/^[a-zA-Z-' ]*$/", $vorname) || !preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $hasError = true;
        $messages[] = "Ungültiger Name angegeben.";
      // Length of first name
    } elseif (strlen($vorname) < 2 || strlen($vorname) > 40) {
        $hasError = true;
		$messages[] = 'Dein Vorname muss aus mindestens 2 und höchstens 40 Zeichen bestehen.';
    } // Length of last name
    elseif (strlen($name) < 2 || strlen($name) > 40) {
        $hasError = true;
		$messages[] = 'Dein Nachname muss aus mindestens 2 und höchstens 40 Zeichen bestehen.';
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

        $query_kunde = "INSERT INTO `clients` (`client_first_name`, `client_name`, `client_email`, `client_password`) VALUES (?, ?, ?, ?)";

        $prepared = mysqli_prepare($connection, $query_kunde);
        mysqli_stmt_bind_param($prepared, 'ssss', $vorname, $name, $email, $passwort_gehasht); 
        mysqli_stmt_execute($prepared);

        $clientID = mysqli_insert_id($connection);

        // Reload Page
        header("Refresh:0");

        $success = true;
        $messages[] = 'Neuer Benutzer erstellt';
       // echo 'Das ist die neue Id des Kundendatensatzes'.$clientID;
    }
}
// Delete Benutzer
if (isset($_POST['delete'])) {
    $deleteid = $_POST['delete']; // Get ID
    $deletequery = "DELETE FROM `clients` WHERE `IDclient` = ?"; // Query & Prepare Statement
    $stmt = mysqli_prepare($connection, $deletequery);
    mysqli_stmt_bind_param($stmt, 'i', $deleteid);

    if (mysqli_stmt_execute($stmt)) {
        $success = true;
        $messages [] = 'Client wurde gelöscht';
        header("Location: benutzer.php");
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
        <h1>Benutzer</h1>
        <?=isset($_GET['updated']) ? "<div class=\"successmessage\"><strong>Benutzer wurde erfolgreich aktualisiert!</strong></div>" : ""?>
        <div class="grid benutzer-grid">
        <?php foreach(array_values($clients) as $key => $client) { ?>
            <div class="tile">
                <i class="fas fa-user"></i>
                <div class="information">
                    <p class="name"><?php echo ucfirst($client["firstname"]) . ' ' . ucfirst($client['name'])?></p>
                    <p class="mail"><?php echo $client ["email"]?></p>
                    <p class="id">Id: <?php echo $client ["id"]?></p>
                    <form action="" method="post">
                        <button type="delete" name="delete" class="delete" value="<?=$client["id"]?>"><i class="fas fa-trash"></i></button>
                        <a href="edit_benutzer.php?id=<?=$client["id"]?>" class="bearbeiten"><i class="fas fa-edit"></i></a>
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>
        <!-- New user -->
        <h2>Neuer Benutzer</h2>
        <?php if( count($messages)>0 ){ ?> 
		<div class="error">
			<?php echo implode('<br>', $messages); ?>
		</div>
	    <?php } ?>
        <form name="benutzer-formular" method="post"> 
            <input type="hidden" name="new" value="1"/>
            <input type="text" name="vorname" placeholder="Vorname eingeben" required/>
            <input type="text" name="nachname" placeholder="Name eingeben" required/>
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