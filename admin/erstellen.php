<?php
// Session start
session_start();
    
// Require once
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

session_regenerate_id();
$_SESSION['timestamp'] = time();
    
// print_r($_SESSION);

// Errors
$hasError = false;
$messages = array();

// Images
$image_folderpath = '../img/rezepte'; // hierhin kommt das Bild
$allowed_types = array('image/jpeg', 'image/gif', 'image/png' ); // hierhin kommt das Bild
$maxfilesize = 2*1024*1024; // 2MB
$thumbnail_foldername = '_thumbnails';
$thumbnail_hoehe = 120;

if (isset($_POST['speichern'])) {
    $title = desinfect($_POST['title']);
    $category = desinfect($_POST['category']);
    $ingredients = $_POST['ingredients']; // nicht desinfizieren, da sonst 
    $description = $_POST['description']; // nicht desinfizieren, da sonst 
    $imgdescription = desinfect($_POST['imagedescription']);

    // Auf leere Felder prüfen
    if (empty($title)) {
        $hasError = true;
		$messages[] = 'Bitte gib deinem Rezept einen Titel.';
    }

    if (empty($category)) {
        $hasError = true;
		$messages[] = 'Bitte gib eine Kategorie ein.';
    }

    if (empty($ingredients)) {
        $hasError = true;
		$messages[] = 'Bitte fülle das Feld Zutaten aus.';
    }

    if (empty($description)) {
        $hasError = true;
		$messages[] = 'Bitte fülle das Feld Beschreibung aus.';
    }

    if (empty($imgdescription)) {
        $hasError = true;
        $messages[] = 'Bitte fülle das Feld Bildbeschreibung aus.';
    }

    // Falls es keine Fehler gibt und ein Bild
    if (isset($_FILES['bild']) && $hasError == false) {
        // print_r($_FILES);

        $tmp_path = $_FILES['bild']['tmp_name'];
        $zielpfad = $image_folderpath.'/'.$_FILES['bild']['name'];

        // validierung: error, filesize etc...
        if($_FILES['bild']['size'] > $maxfilesize){
            $hasError = true;
            $messages[] = 'Das Bild ist grösser als die erlaubte Maximalgrösse von <strong>'.($maxfilesize/1024/1024).' MB</strong>';
        }
        if(!in_array($_FILES['bild']['type'], $allowed_types)){
            $hasError = true;
            $messages[] = 'Es können nur JPG, GIF oder PNG hochgeladen werden';
        }
        if($_FILES['bild']['error'] > 0){
            $hasError = true;
            // generische Fehlermeldung - es könnte die Fehlernummer noch mit SWITCH oder IF/ELSE unterschieden werden
            $messages[] = 'Es ist ein Fehler aufgetreten';
        }
    }

    // Falls nicht hochgeladen und keine Fehler -> Hochladen
    $moved = false;
    if ($hasError == false) {
        $moved = move_uploaded_file($tmp_path, $image_folderpath.'/'.$_FILES['bild']['name']);
		$messages[] = 'Die Datei wurde hochgeladen in '.$image_folderpath.'/'.$_FILES['bild']['name']; 
    }

    // Thumbnail
    if($moved == true){
		$originalbild = imageCreateFromJpeg( $zielpfad );
		
		// Get Width and Height
		$bildbreite = imageSX( $originalbild );
		$bildhoehe = imageSY( $originalbild );
		// Calculate Thumbnail Size
        $thumbnail_breite = $thumbnail_hoehe / ($bildhoehe/$bildbreite);
		$thumbnail = imagecreatetruecolor ( $thumbnail_breite, $thumbnail_hoehe ); 

		imagecopyresampled ($thumbnail, $originalbild, 0, 0, 0, 0, $thumbnail_breite, $thumbnail_hoehe, $bildbreite, $bildhoehe);
		
		// If thumbnail folder doesnt exist: create new one
		if(!is_dir($image_folderpath.'/'.$thumbnail_foldername.'/')){
			mkdir($image_folderpath.'/'.$thumbnail_foldername.'/');
		}
		// Generate picture
		imagejpeg($thumbnail, $image_folderpath.'/'.$thumbnail_foldername.'/'.$_FILES['bild']['name'], 100);
	}

    // If theres no error and the picture is moved insert into database
    if ($hasError == false && $moved == true) {
        $query = "INSERT INTO `recipes` (`recipe_name`, `recipe_category`, `recipe_ingredients` ,`recipe_description`, `recipe_image`, `image_description`) VALUES (?, ?, ?, ?, ?, ?)";
        // print_r($query);
        $statement = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($statement, "ssssss", $title, $category, $ingredients, $description, $_FILES['bild']['name'], $imgdescription);
        mysqli_stmt_execute($statement);
        
        header("Location: rezepte.php?created");
        die();
    }
}

// Header
include('includes/html/header.php');
?>

    <section class="admin-content">
        <h1>Neues Rezept erstellen</h1>

        <form class="erstellen-form" action="" method="post" enctype="multipart/form-data">
        <?php if( count($messages)>0){ ?> 
            <div class="error">
                <?php echo implode('<br>', $messages); ?>
            </div>
        <?php } ?>
            <div class="input-field title">
                <label for="title">Titel <span class="required">*</span></label>
                <input type="text" name="title">
            </div>

            <div class="input-field category">
                <label for="category">Kategorie <span class="required">*</span></label>
                <input type="text" name="category">
            </div>

            <div class="input-field ingredients">
                <label for="ingredients">Zutaten <span class="required">*</span></label>
                <textarea name="ingredients" name="editor1" id="editor1" rows="10" cols="80"></textarea>
            </div>

            <div class="input-field description" >
                <label for="description">Beschreibung <span class="required">*</span></label>
                <textarea name="description" name="editor2" id="editor2" rows="10" cols="80" ></textarea>
            </div>

            <div class="input-field picture">
                <label>Bild (Bis 2MB max) hochladen: <span class="required">*</span></label>
                <input type="file" name="bild"/>
            </div>
                    
            <div class="input-field imagedescription">
                <label for="imagedescription">Bildbeschreibung <span class="required">*</span></label>
                <input type="text" name="imagedescription"></input>
            </div>

            <div class="buttons">
                <button class="save" type="speichern" name="speichern">Speichern</button>
                <button class="cancel" type="cancel" name="cancel"><a href="rezepte.php">Abbrechen</a></button>
            </div>
        </form>
    </section>
</section>

<?php
// Footer
include('includes/html/footer.php'); 
?>