<!-- Presentation/registratieForm.php -->
<div class="content">
    <div class="container">
        <h2>Registreren</h2>
        <form action="" method="post" name="register" class="register">
            <section>
                <label for="familienaam">Familienaam</label>
                <input type="text" name="familienaam" <?php if (in_array("emptyfamilienaam", $errors)) { print("class='error'"); }?> required>
                <?php
                if (in_array("emptyfamilienaam", $errors)) {
                    ?>
                    <p class="error"><small>Dit is een verplicht veld. Vul een waarde in.</small></p>
                    <?php
                }
                ?>
            </section>
            <section>
                <label for="voornaam">Voornaam</label>
                <input type="text" name="voornaam" <?php if (in_array("emptyvoornaam", $errors)) { print("class='error'"); }?> required>
                <?php
                if (in_array("emptyvoornaam", $errors)) {
                    ?>
                    <p class="error"><small>Dit is een verplicht veld. Vul een waarde in.</small></p>
                    <?php
                }
                ?>
            </section>
            <section>
                <label for="straat">Straat</label>
                <input type="text" name="straat" <?php if (in_array("emptystraat", $errors)) { print("class='error'"); }?> required>
                <?php
                if (in_array("emptystraat", $errors)) {
                    ?>
                    <p class="error"><small>Dit is een verplicht veld. Vul een waarde in.</small></p>
                    <?php
                }
                ?>
            </section>
            <section>
                <label for="huisnummer">Huisnummer</label>
                <input type="text" name="huisnummer" <?php if (in_array("emptyhuisnummer", $errors)) { print("class='error'"); }?> required="">
                <?php
                if (in_array("emptyhuisnummer", $errors)) {
                    ?>
                    <p class="error"><small>Dit is een verplicht veld. Vul een waarde in.</small></p>
                    <?php
                }
                ?>
            </section>
            <section>
                <label for="bus">Bus</label>
                <input type="text" name="bus">
            </section>
            <section>
                <label for="postcode">Postcode</label>
                <input type="number" name="postcode" min="1000" max="9999" <?php if (in_array("wrongpostcode", $errors) || in_array("emptypostcode", $errors)) { print("class='error'"); }?> required>
                <?php
                if (in_array("emptypostcode", $errors)) {
                    ?>
                    <p class="error"><small>Dit is een verplicht veld. Vul een waarde in.</small></p>
                    <?php
                } elseif (in_array("wrongpostcode", $errors)) {
                    ?>
                    <p class="error"><small>Gelieve een postcode tussen 1000 en 9999 in te vullen.</small></p>
                    <?php
                }
                ?>
            </section>
            <section>
                <label for="woonplaats">Woonplaats</label>
                <input type="text" name="woonplaats" <?php if (in_array("emptywoonplaats", $errors)) { print("class='error'"); }?> required>
                <?php
                if (in_array("emptywoonplaats", $errors)) {
                    ?>
                    <p class="error"><small>Dit is een verplicht veld. Vul een waarde in.</small></p>
                    <?php
                }
                ?>
            </section>
            <section>
                <label for="telefoon">Telefoonnummer</label>
                <input type="text" name="telefoon" <?php if (in_array("emptytelefoon", $errors)) { print("class='error'"); }?> required>
                <?php
                if (in_array("emptytelefoon", $errors)) {
                    ?>
                    <p class="error"><small>Dit is een verplicht veld. Vul een waarde in.</small></p>
                    <?php
                }
                ?>
            </section>
            <section>
                <label for="opmerking">Opmerking</label>
                <textarea name="opmerking"></textarea>
            </section>
            <section>
                <label for="email">E-mailadres</label>
                <input type="email" name="email" <?php if (in_array("emailexists", $errors) || in_array("emptyemail", $errors)) { print("class='error'"); }?> required>
                <?php
                if (in_array("emptyemail", $errors)) {
                    ?>
                    <p class="error"><small>Dit is een verplicht veld. Vul een waarde in.</small></p>
                    <?php
                } elseif (in_array("emailexists", $errors)) {
                    ?>
                    <p class="error"><small>Er bestaat al account met dit e-mailadres. <a href="inloggen.php">Log in</a> om verder te gaan.</small></p>
                    <?php
                }
                ?>
            </section>
            <section>
                <label for="wachtwoord1">Wachtwoord</label>
                <input type="password" name="wachtwoord1" <?php if (in_array("passwordnomatch", $errors) || in_array("emptywachtwoord1", $errors)) { print("class='error'"); }?> required>
                <?php
                if (in_array("emptywachtwoord1", $errors)) {
                    ?>
                    <p class="error"><small>Dit is een verplicht veld. Vul een waarde in.</small></p>
                    <?php
                }
                ?>
            </section>
            <section>
                <label for="wachtwoord2">Herhaal wachtwoord</label>
                <input type="password" name="wachtwoord2" <?php if (in_array("passwordnomatch", $errors) || in_array("emptywachtwoord2", $errors)) { print("class='error'"); }?> required>
                <?php
                if (in_array("emptywachtwoord2", $errors)) {
                    ?>
                    <p class="error"><small>Dit is een verplicht veld. Vul een waarde in.</small></p>
                    <?php
                } elseif (in_array("passwordnomatch", $errors)) {
                    ?>
                    <p class="error"><small>Wachtwoorden komen niet overeen.</small></p>
                    <?php
                }
                ?>
            </section>
            <button type="submit" name="register">Maak een account aan</button>
        </form>
    </div>
</div>