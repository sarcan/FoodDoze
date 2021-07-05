<?php 
// Header
include("includes/html/header.php"); 
?>

<section class="text">
    <h1>Willkommen zu Food Doze!</h1>
    <p class="flower-font"> Unsere Rezepte geben dir einen tollen Food doze! <br><a href="rezepte.php">Zu den Rezepte!</a></p>
    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. </p>
</section>

<!-- Images -->
<section class="receipes">
    <div class="desktop-gallery">
        <div class="image">
            <img src="img/home/salad.jpeg" alt="Salat">
        </div>
        <div class="image">
            <img src="img/home/veggiebowl.jpeg" alt="Veggie Bowl">
        </div>
        <div class="image">
            <img src="img/home/springrolls.jpeg" alt="Frühlingsrollen">
        </div>
    </div>
</section>

<!-- categories -->
<?php include("includes/html/kategorien.php"); ?>

<!-- Registrationsformular -->
<section class="formular" id="registrieren">
        <p>Melde dich jetzt an!</p>
        <p>Und teile deine liebsten Rezepte</p>
    <form action="">
        <label for="vorname"></label>
        <input type="text" name="vorname" placeholder="Vorname *">

        <label for="name"></label>
        <input type="text" name="name" placeholder="Name *">

        <label for="email"></label>
        <input type="email" name="email" placeholder="E-Mail *">

        <label for="fld_pw"></label>
        <input type="password" name="passwort" id="fld_pw" value="" placeholder="Passwort *">

        <button id="send">Abschicken</button>
    </form>
</section>

<section class="text">
    <h1>TEXT</h1>
    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
</section>


<?php
// Footer
include("includes/html/footer.php");
?>