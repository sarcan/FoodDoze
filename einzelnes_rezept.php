<?php
// Requires
require_once("admin/includes/config.php");
require_once("admin/includes/mysql_connect.php");

$hasError = false;
$messages = array();

// Get ID
if (!isset($_GET['id'])) {
    header("rezepte.php");
    exit;
}
// Save ID in variable
$id = $_GET["id"];

// get recipe
$query_recipe = "SELECT * FROM recipes WHERE IDrecipe = ?";
$prepared = mysqli_prepare($connection, $query_recipe);

mysqli_stmt_bind_param($prepared, "i", $id);
mysqli_stmt_execute($prepared);
$result_recipe = mysqli_stmt_get_result($prepared);

// if everything is correct -> array
if ($result_recipe !== false) {
    $recipe = mysqli_fetch_assoc($result_recipe);
} else { // if not -> error message
	$hasError = true; 
	$messages[] = 'Leider wurde kein Rezept gefunden.';
}
// if recipe array is empty -> Error Message
if( empty($recipe) ){
	$hasError = true; 
	$messages[] = 'Leider wurde kein Rezept gefunden.';
}

// Header
include('includes/html/header.php'); 
?>

<?php
// If error display error messages
if ($hasError == true && isset($messages) ) {
    echo $messages; 
} else { // if not display recipe
?>
    <div class="einzelnes_rezept">
        <div class="img_title">
            <img src="img/rezepte/<?php echo $recipe["recipe_image"]?>" alt="<?php echo $recipe["image_description"]?>">
            <div class="info">
                <h1><?php echo $recipe["recipe_name"] ?></h1>
                <div class="ingredients">
                    <p class="ingredients"><?php echo $recipe["recipe_ingredients"] ?></p>
                </div>
                <div class="description">
                    <?php echo $recipe["recipe_description"] ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php
// Footer
include("includes/html/footer.php");
?>