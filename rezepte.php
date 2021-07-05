<?php
// Requires
require_once("admin/includes/config.php");
require_once("admin/includes/mysql_connect.php");

$id = "";
$query = "";
// Getting the information from url
$id = isset($_GET["id"]) ? $_GET["id"] : "";

// Compare ID to Category in SQL Table
if ($id == "fruehstueck") {
    $query = "SELECT * FROM recipes WHERE recipe_category='fruehstueck'";
} elseif ($id=="suppe") {
    $query = "SELECT * FROM recipes WHERE recipe_category='suppe'";
} elseif ($id=="salat") {
    $query = "SELECT * FROM recipes WHERE recipe_category='salat'";
} elseif ($id=="pasta") {
    $query = "SELECT * FROM recipes WHERE recipe_category='pasta'";
} elseif ($id=="gemuese") {
    $query = "SELECT * FROM recipes WHERE recipe_category='gemuese'";
} else { // If no ID aplie select all -> Shows all recipes
    $query = "SELECT * From recipes";
}

$sql = mysqli_query($connection, $query);
// print_r($rezepte);

// Header
include("includes/html/header.php"); 
?>

<section class="text">
    <h1>REZEPTE</h1>
    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
</section>

<!-- Categories to filter recipes  -->
<section class="kacheln">
<?php include("includes/html/kategorien.php"); ?>

<!-- Get all recipes -->
<div class="allerezepte">
    <?php
    while($row = mysqli_fetch_array($sql)) {
        // echo $row['recipe_name'];
        ?>
            <div class="rezept">
                <a href="einzelnes_rezept.php?id=<?php echo $row["IDrecipe"] ?>">
                    <img src="img/rezepte/<?php echo $row["recipe_image"]?>" alt="<?php echo $row["image_description"]; ?>">
                    <div class="image-title">
                        <p><?php echo $row["recipe_name"]; ?></p>
                    </div>
                </a>
            </div>
    <?php }
    // If no recipes available error message
    if( ! mysqli_num_rows($sql) ) {   ?>
        <p class="error-message-recipe"><?php echo "Scheint so als gibt es noch kein Rezept!"?></p>
        <?php
    }
    ?>
</div>

<section class="text">
    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
</section>

</section>

<?php
// Footer
include("includes/html/footer.php");
?>