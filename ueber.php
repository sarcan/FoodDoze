<?php 
// Requires
require_once("admin/includes/functions.php");
require("includes/form-to-email.php");

// Header
include("includes/html/header.php"); 
?>

<section class="text">
    <h1>ÜBER MICH</h1>
    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
</section>

<div class="text person">
    <img src="img/about/person.jpeg" alt="Profilbild">
    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
</div>

<section class="formular" id="mitteilung">
    <h2>Sende mir deine Nachricht!</h2>
    <!-- Display Error messages -->
    <p class="error-message"><?php echo $errorMessage ?></p>
    <p class="send-message"><?php echo $sendMessage ?></p>

    <form action="" method="post" id="contactform">

        <!-- Radiobuttons Anrede -->
        <div class="anreden">
            <div class="anrede-container">
                <input type="radio" name="anrede" class="anrede">
                <label for="anrede_herr" class="anrede_herr">Herr</label>
            </div>
            <div class="anrede-container">
                <input type="radio" name="anrede" class="anrede">
                <label for="anrede_frau" class="anrede_frau">Frau</label>
            </div>
            <div class="anrede-container">
                <input type="radio" name="anrede" class="anrede">
                <label for="anrede_andere" class="anrede_andere">Andere</label>
            </div>
        </div>

        <label for="nachname"></label>
        <input type="text" name="nachname" id="nachname" placeholder="Nachname *" required>

        <label for="vorname"></label>
        <input type="text" name="vorname" id="vorname" placeholder="Vorame *" required>

        <label for="email"></label>
        <input type="email" name="email" id="email" placeholder="E-Mail *" required>

        <label for="dropdown" class="dropdown"></label>
            <select name="dropdown" id="dropdown" required>
            <option value="">Wie können wir dir helfen?</option>
            <option value="">Rezept</option>
            <option value="">Passwort vergessen</option>
            <option value="">Username vergessen</option>
            <option value="">Anmeldung</option>
            <option value="">Sonstiges</option>
            </select>

        <textarea name="message" id="message" cols="30" rows="7" placeholder="Deine Mitteilung *" required></textarea>

        <div class="checkbox-container">
            <input type="checkbox" id="checkbox" id="agree" name="checkbox">
            <label for="checkbox" id="labelcheckbox">Ich akzeptiere die AGB</label>
        </div>


        <button type="submit" id="agree">Abschicken</button>
    </form>
</section>

<?php
// Footer
include("includes/html/footer.php");
?>