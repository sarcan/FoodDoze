<?php
// Header
include("includes/html/header.php"); 

?>

<section class="formular login">

<!-- If not logged in -> show form -->
    <form method="POST">

        <label for="fld_username"></label>
        <input type="text" name="username" id="username" placeholder="Username">

        <label for="fld_pw"></label>
        <input type="password" name="passwort" id="passwort" placeholder="Passwort">

        <p>Noch nicht registriert? Melde dich <a href="index.php#registrieren">hier an!</a></p>

        <button id="send" type="submit" name="submit">Abschicken</button>

    </form>

</section>

<?php
// Footer
include('includes/html/footer.php');
?>