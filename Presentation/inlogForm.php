<!-- Presentation/inlogForm.php -->
<div class="content">
    <div class="container">
        <h2>Inloggen</h2>
        <form action="" method="post" name="login" class="login">
            <section>
                <label for="email">E-mailadres</label>
                <input type="email" name="email" <?php if (in_array("emailunknown", $errors) || in_array("emptyemail", $errors)) { print("class='error'"); }?> <?php if (isset($_COOKIE["klant"])) { print("value='" . $_COOKIE["klant"] . "'"); } elseif (isset($_POST["email"])) { print("value='" . $_POST["email"] . "'"); }?> >
                <?php
                if (in_array("emptyemail", $errors)) {
                    ?>
                    <p class="error"><small>Dit is een verplicht veld. Vul een waarde in.</small></p>
                    <?php
                } elseif  (in_array("emailunknown", $errors)) {
                    ?>
                    <p class="error"><small>Er is geen account gekoppeld aan dit e-mailadres. Om een account aan te maken moet je je <a href="registratie.php">registreren</a>.</small></p>
                    <?php
                }
                ?>
            </section>
            <section>
            <label for="wachtwoord">Wachtwoord</label>
            <input type="password" name="wachtwoord" <?php if (in_array("passwordwrong", $errors) || in_array("emptywachtwoord1", $errors)) { print("class='error'"); }?> >
            <?php
            if (in_array("emptywachtwoord", $errors)) {
                    ?>
                    <p class="error"><small>Dit is een verplicht veld. Vul een waarde in.</small></p>
                    <?php
                } elseif  (in_array("passwordwrong", $errors)) {
                    ?>
                    <p class="error"><small>Wachtwoord niet correct.</small></p>
                <?php
            }
            ?>
            </section>
            <button type="submit" name="login">Inloggen</button>
        </form>
    </div>
</div>