<?php
session_start();
// print_r($_SESSION);

$adminright = $_SESSION['adminright'];
echo "<pre></pre>";
echo($adminright);

// Requires
require_once('includes/config.php');
require_once('includes/functions.php');
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

$hasError = false;
$messages = array();

// if no id go back
if (!isset($_GET['id'])) {
    header("rezepte.php");
    exit;
}

// Save id
$id = $_GET["id"];
// print_r($id);

// Beitrag auslesen
$query = "SELECT `recipe_name`, `recipe_category`, `recipe_ingredients`, `recipe_description`, `image_description` FROM `recipes` WHERE `IDrecipe` = ?";
// echo '<pre></pre>';
// print_r($query);
// echo '<pre></pre>';
$statement = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($statement, 'i', $id);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

if (mysqli_num_rows($result) == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
        $recipe [] = [
            'title' => decrypt($row['recipe_name']),
            'category' => decrypt($row['recipe_category']),
            'ingredients' => decrypt($row['recipe_ingredients']),
            'description' => decrypt($row['recipe_description']),
            'imagedescription' => decrypt($row['image_description'])
        ];
    }
    // echo '<pre></pre>';
    // print_r($recipe);
    // echo '<pre></pre>';
} else {
    die("Beitrag kann nicht gefunden werden.");
}

// Änderungen speichern
if (isset($_POST['speichern'])) {
    $title = desinfect($_POST['title']);
    $category = desinfect($_POST['category']);
    $ingredients = $_POST['ingredients'];
    $description = $_POST['description'];
    $imagedescription = desinfect($_POST['imagedescription']);
    // print_r($title.$category.$ingredients.$description.$imagedescription);

    $titleVal = $title;
    $categoryVal = $category; 
    $ingredientsVal = $ingredients;
    $descriptionVal = $description;
    $imagedescriptionVal = $imagedescription;
    // print_r($titleVal.$categoryVal.$ingredientsVal.$descriptionVal.$imagedescriptionVal);

    // Auf leere Felder prüfen
    if (empty($title)) {
        $hasError = true;
        $messages [] = 'Bitte fülle das Feld Titel aus!';
    } elseif (strlen($title) > 250) {
        $hasError = true;
        $messages [] = 'Feld darf nicht mehr als 250 Zeichen beinhalten.';
    }

    if (empty($category)) {
        $hasError = true;
        $messages [] = 'Bitte fülle das Feld Kategorie aus!';
    } elseif (strlen($category) > 250) {
        $hasError = true;
        $messages [] = 'Feld darf nicht mehr als 250 Zeichen beinhalten.';
    }

    if (empty($ingredients)) {
        $hasError = true;
        $messages [] = 'Bitte fülle das Feld Kategorie aus!';
    }

    if (empty($description)) {
        $hasError = true;
        $messages [] = 'Bitte fülle das Feld Kategorie aus!';
    }

    if (empty($imagedescription)) {
        $hasError = true;
        $messages [] = 'Bitte fülle das Feld Kategorie aus!';
    } elseif (strlen($imagedescription) > 250) {
        $hasError = true;
        $messages [] = 'Feld darf nicht mehr als 250 Zeichen beinhalten.';
    }

    // Falls es kein Fehler gibt -> Update
    if (!$hasError) {
        $queryUpdate = "UPDATE recipes SET recipe_name=?, recipe_category=?, recipe_ingredients=?, recipe_description=?, image_description=? WHERE IDrecipe=?";

        // Prepared Statement
        $stmt = mysqli_prepare($connection, $queryUpdate);
        mysqli_stmt_bind_param($stmt, 'sssssi', $title, $category, $ingredients, $description, $imagedescription, $id);
        if (!mysqli_stmt_execute($stmt)) {
            echo mysqli_stmt_error($stmt);
        } else {
            // Weiterleiten an Rezepte.php
            header("Location: rezepte.php?updated");
            die();
        }
    }
} else {
    $titleVal = "";
    $categoryVal = ""; 
    $ingredientsVal = "";
    $descriptionVal = "";
    $imagedescriptionVal = "";
}

// Header
include('includes/html/header.php');
?>

<?php

// If error display error messages
if ($hasError == true && isset($messages) ) {
    echo $messages; 
}
?>

    <section class="admin-content">
        <h1>Rezept bearbeiten</h1>
        <!-- Error Messages -->
        <?php if( count($messages)>0 ){ ?> 
        <div class="error">
            <?php echo implode('<br>', $messages); ?>
        </div>
        <?php } ?>
        <?php foreach ($recipe as $key => $value) { ?>
        <form class="erstellen-form" method="post">
            <div class="input-field title">
                <label for="title">Titel <span class="required">*</span></label>
                <input type="text" name="title" id="title" value="<?=$titleVal ? $titleVal : $value['title']?>">
            </div>

            <div class="input-field category">
                <label for="category">Kategorie <span class="required">*</span></label>
                <input type="text" name="category" id="category" value="<?=$categoryVal ? $categoryVal : $value['category']?>">
            </div>

            <div class="input-field ingredients">
                <label for="ingredients">Zutaten <span class="required">*</span></label>
                <textarea name="ingredients" name="editor1" id="editor1" rows="10" cols="80"><?=$ingredientsVal ? $ingredientsVal : $value['ingredients']?></textarea>
            </div>

            <div class="input-field description" >
                <label for="description">Beschreibung <span class="required">*</span></label>
                <textarea name="description" name="editor2" id="editor2" rows="10" cols="80" ><?=$descriptionVal ? $descriptionVal : $value['description']?></textarea>
            </div>

            <div class="input-field imagedescription">
                <label for="imagedescription">Bildbeschreibung <span class="required">*</span></label>
                <input type="text" name="imagedescription" id="imagedescription" value="<?=$imagedescriptionVal ? $imagedescriptionVal : $value['imagedescription']?>"></input>
            </div>

            
            <div class="buttons">
                <button class="speichern" type="speichern" name="speichern">Speichern</button>
                <button class="cancel" type="cancel" id="cancel" name="cancel"><a href="rezepte.php">Abbrechen</a></button>
            </div>
        </form>
    <?php } ?>
    </section>
</section>

<?php
// Footer
include('includes/html/footer.php'); 
?>