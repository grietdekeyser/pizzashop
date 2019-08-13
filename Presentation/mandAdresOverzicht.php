<!-- Presentation/mandAdresOverzicht.php -->
<?php
if (isset($gesloten) && $gesloten) {
    ?>
    <p class="error">Pizza pazzi is momenteel gesloten. De levering van deze bestelling zal plaatsvinden na <?php print($uur); ?> uur.</p>
    <?php
}
?>
<div class="order">
    <section class="cart left">
        <h2>Jouw winkelmandje</h2>
        <?php
        for ($i=1; $i <= max(array_keys($winkelmand)); $i++) {
            if (isset($winkelmand[$i])) {
                $product = $winkelmand[$i][0];
                $aantal = $winkelmand[$i][1];
                ?>
                <div class="cartLine">
                    <p class="pizzaAantal"><?php print($aantal); ?>x</p>
                    <p class="pizzaNaam"><?php print($product->getNaam()); ?></p>
                    <p class="pizzaPrijs">€ <?php print($aantal * $product->getPrijs()); ?></p><br>
                </div>
                <?php
            }
        }
        ?>
        <?php
        if ($korting) {
            ?>
        <p class="pizzaTotaal subtotaal">
            <strong class="som subtotaal">Subtotaal</strong>
            <strong class="pizzaPrijs">€ <?php print($subtotaal); ?></strong>
        </p>
        <p class="pizzaTotaal promo">
            <strong class="som promo">Korting</strong> 
            <strong class="pizzaPrijs">- € <?php print($korting); ?></strong>
        </p>
            <?php
        }
        ?>
        <p class="pizzaTotaal totaal">
            <strong class="som totaal">Totaal</strong>
            <strong class="pizzaPrijs">€ <?php print($totaalPrijs); ?></strong>
        </p>
        <br>
        <?php
        if (!$bestellingGeplaatst) {
            ?>
            <form action="bestellen.php" method="post">
                <button type="submit">Winkelmandje aanpassen</button>
            </form>
            <?php
        }
        ?>
        
    </section>
    <section class="address right">
        <h2>Jouw adresgegevens</h2>
        <?php
        // controle postcode
        if (!$bestellingGeplaatst && isset($noDelivery) && $noDelivery) {
            ?>
            <p class="error">Levering is momenteel niet beschikbaar. Probeer later opnieuw</p>
            <?php
        } elseif (!$bestellingGeplaatst && !$levering) {
            ?>
            <p class="error">Momenteel leveren we nog niet op jouw gekozen adres.
                <br>
            We leveren in <?php print($leveringsgebied); ?>.</p>
            <?php
        }
        ?>
        <dl>
            <dt>Bezorgadres</dt>
            <dd>
                <?php print($klant->getStraat() . " " . $klant->getHuisnummer() . ", " . $klant->getBus()); ?>
                <br>
                <?php print($klant->getPostcode() . " " . $klant->getWoonplaats()); ?> 
            </dd>
            <dt>Telefoonnummer</dt>
            <dd><?php print($klant->getTelefoon()); ?></dd>
            <dt>Eventuele opmerking</dt>
            <dd><?php print($klant->getOpmerking()); ?></dd>
        </dl>
        <?php
        if (!$bestellingGeplaatst) {
            ?>
            <form action="account.php?action=order" method="post">
                <button type="submit" name="address">Bezorgadres aanpassen</button>
            </form>
            <?php
        }
        ?>
        
    </section>
</div>