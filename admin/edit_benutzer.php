<?php
session_start();
// print_r($_SESSION);

// Requires
require_once('includes/config.php');
require_once('includes/functions.php');
require_once('includes/mysql_connect.php');
require_once('includes/sessioncheck.php');

// session check
if(!sessionCheck()) {
    session_unset();
	session_regenerate_id();
    header("Location: login.php");
    die();
}

// refresh session
session_regenerate_id(); 
$_SESSION['timestamp'] = time();

$hasError = false;
$messages = array();

// if no id go back
if (!isset($_GET['id'])) {
    header("benutzer.php");
    exit;
}

// Save id
$id = $_GET["id"];
// print_r($id);

$query = "SELECT * FROM clients WHERE IDclient = ?";
// echo '<pre></pre>';
// print_r($query);
// echo '<pre></pre>';

$statement = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($statement, 'i', $id);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

if (mysqli_num_rows($result) == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
        $clients [] = [
            'nachname' => decrypt($row['client_name']),
            'vorname' => decrypt($row['client_first_name']),
            'email' => decrypt($row['client_email'])
        ];
    }
    // echo '<pre></pre>';
    // print_r($clients);
    // echo '<pre></pre>';
} else {
    die("Nutzer kann nicht gefunden werden.");
}

if (isset($_POST['speichern'])) {
    $nachname = desinfect($_POST['nachname']);
    $vorname = desinfect($_POST['vorname']);
    $email = validateEmail($_POST['email']);
    // print_r($nachname.$vorname.$email);

    $nachnameVal = $nachname;
    $vornameVal = $vorname;
    $emailVal = $email;

    if (empty($nachname)) {
        $hasError = true;
        $messages [] = 'Bitte fülle das Feld Nachname aus!';
    } elseif (strlen($nachname) > 250) {
        $hasError = true;
        $messages [] = 'Feld darf nicht mehr als 250 Zeichen beinhalten.';
    }

    if (empty($vorname)) {
        $hasError = true;
        $messages [] = 'Bitte fülle das Feld Vorname aus!';
    } elseif (strlen($vorname) > 250) {
        $hasError = true;
        $messages [] = 'Feld darf nicht mehr als 250 Zeichen beinhalten.';
    }

    // Is the email adress filled out?
    if (empty($email)) {
        $hasError = true;
        $messages[] = 'Email fehlt oder ist inkorrekt.';
    }

    if (!$hasError) {
        $queryUpdate = "UPDATE clients SET client_name=?, client_first_name=?, client_email=? WHERE IDclient=?";

        $stmt = mysqli_prepare($connection, $queryUpdate);
        mysqli_stmt_bind_param($stmt, 'sssi', $nachname, $vorname, $email, $id);
        if (!mysqli_stmt_execute($stmt)) {
            echo mysqli_stmt_error($stmt);
        } else {
            header("Location: benutzer.php?updated");
            $messages = 'Änderungen wurden gespeichert.';
            die();
        }
    }
} else {
    $nachnameVal = "";
    $vornameVal = "";
    $emailVal = "";
}

// Header
include('includes/html/header.php');
?>

<section class="admin-content">

    <div class="bearbeiten">
        <h1>Name bearbeiten</h1>

        <?php if( count($messages)>0 ){ ?> 
        <div class="error">
            <?php echo implode('<br>', $messages); } ?>
        </div>
        
        <?php foreach ($clients as $key => $value) { ?>
        <form method="post" class="erstellen-form">
            <input type="text" name="vorname" placeholder="Vorname" value="<?=$vornameVal ? $vornameVal : $value["vorname"]?>">
            <input type="text" name="nachname" placeholder="Nachame" value="<?=$nachnameVal ? $nachnameVal : $value["nachname"]?>">
            <input type="email" name="email" placeholder="Email" value="<?=$emailVal ? $emailVal : $value["email"]?>">

            <div class="buttons">
                <button class="speichern" type="speichern" name="speichern">Speichern</button>
                <button class="cancel" type="cancel" id="cancel" name="cancel"><a href="benutzer.php">Abbrechen</a></button>
            </div>
        </form>
        <?php } ?>
    </div>
</section>
</section>

<?php
// Footer
include('includes/html/footer.php'); 
?>