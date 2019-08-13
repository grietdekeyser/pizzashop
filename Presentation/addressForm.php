<!-- Presentation/addressForm.php -->
<div class="content">
    <div class="container">
        <h2>Bezorggegevens aanpassen</h2>
        <form action="" method="post" name="change" class="change">
            <section>
                <label for="straat">Straat</label>
                <input type="text" name="straat" <?php if (in_array("emptystraat", $errors)) { print("class='error'"); }?> value="<?php print($klant->getStraat());?>" required>
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
                <input type="text" name="huisnummer" <?php if (in_array("emptyhuisnummer", $errors)) { print("class='error'"); }?> value="<?php print($klant->getHuisnummer());?>" required="">
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
                <input type="number" name="postcode" min="1000" max="9999" <?php if (in_array("wrongpostcode", $errors) || in_array("emptypostcode", $errors)) { print("class='error'"); }?> value="<?php print($klant->getPostcode());?>" required>
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
                <input type="text" name="woonplaats" <?php if (in_array("emptywoonplaats", $errors)) { print("class='error'"); }?> value="<?php print($klant->getWoonplaats());?>" required>
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
                <input type="text" name="telefoon" <?php if (in_array("emptytelefoon", $errors)) { print("class='error'"); }?> value="<?php print($klant->getTelefoon());?>" required>
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
                <textarea name="opmerking"><?php print($klant->getOpmerking());?></textarea>
            </section>
            <section>
            <button type="submit" name="change">Gegevens aanpassen</button>
        </form>
    </div>
</div>