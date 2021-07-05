<?php
session_start();
// print_r($_SESSION);

// Requqires
require_once('includes/config.php');
require_once('includes/mysql_connect.php');
require_once('includes/sessioncheck.php');
require_once('includes/functions.php');

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



// session_regenerate_id();
// $_SESSION['timestamp'] = time();

$hasError = false;
$success = false;
$messages = array();

// Alle Rezepte aus Datenbank aussondern
$query_rezepte = 'SELECT * FROM recipes';
$resultat_rezepte = mysqli_query($connection, $query_rezepte);
if (mysqli_num_rows($resultat_rezepte) > 0) {
    while ($row = mysqli_fetch_assoc($resultat_rezepte)) {
        $rezepte [] = [
        'id' => $row['IDrecipe'],
        'img' => $row['recipe_image'],
        'name' =>$row['recipe_name'],
        'imgdescription' =>$row['image_description'],
        ];
    }
    // print_r($rezepte);
} else {
    die('No results');
}

// Delete recipe
if (isset($_POST['delete'])) {
    $deleteid = $_POST['delete']; // Get ID
    $deletequery = "DELETE FROM `recipes` WHERE `IDrecipe` = ?"; // Query & Prepare Statement
    $stmt = mysqli_prepare($connection, $deletequery);
    mysqli_stmt_bind_param($stmt, 'i', $deleteid);

    if (mysqli_stmt_execute($stmt)) {
        $success = true;
        $messages [] = 'Recipe wurde gelöscht.';
        header("Location: rezepte.php");
        die();
    } else {
        $hasError = true;
        $messages [] = 'Sorry, etwas ging schief.';
    }
}


// print_r($rezepte);

// Header
include('includes/html/header.php'); 
?>

    <section class="admin-content">
        <h1>Rezepte</h1>
        <?=isset($_GET['created']) ? "<div class=\"successmessage\"><strong>Das Rezept wurde erfolgreich erstellt!</strong></div>" : ""?>                          
        <?=isset($_GET['updated']) ? "<div class=\"successmessage\"><strong>Das Rezept wurde erfolgreich aktualisiert!</strong></div>" : ""?>                          
        <!-- Alle Rezepte -->
            <div class="allerezepte">
                <div class="neu">
                    <a href="erstellen.php">Erstelle ein neues Rezept!</a>
                </div>
            <!-- Error Messages -->
            <?php if( count($messages)>0 ){ ?> 
            <div class="error">
                <?php echo implode('<br>', $messages); ?>
            </div>
            <?php } ?>
                <?php foreach(array_values($rezepte) as $key => $rezept) { ?>
                    <div class="rezept">
                        <img src="../img/rezepte/_thumbnails/<?=$rezept["img"]?>" alt="<?=$rezept["imgdescription"]?>">
                        <p><?=$rezept["name"]; ?></p>
                        <div class="icons">
                            <a href="edit.php?id=<?=$rezept["id"]?>"><i class="fas fa-edit"></i></a>
                            <form action="" method="post">
                                <button type="delete" name="delete" value="<?=$rezept["id"]?>"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
    </section>

</section>

<?php
// Footer
include('includes/html/footer.php');
?>