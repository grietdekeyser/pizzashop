<!-- Presentation/bestelForm.php -->
<div class="content">
    <div class="container">
        <?php
        if ($klant) {
            ?>
            <p>Welke pizza('s) wil je bestellen, <?php print($naamKlant); ?>?</p>
            <?php
        }
        ?>
        <div class="order">
            <section class="menuProduct left">
                <h2>Menu</h2>
                    <?php
                    if (!isset($unavailable)) {
                        ?>
                        <dl class="menuProduct">
                            <?php
                            foreach ($productlijst as $product) {
                                ?>
                                <div class="product">
                                    <img src="Img/<?php print($product->getAfbeelding()); ?>">
                                    <div>
                                        <dt><?php print($product->getNaam()); ?></dt>
                                        <dd>
                                            <?php print($product->getSamenstelling()); ?>
                                            <br>
                                            € <?php print($product->getPrijs()); ?>
                                        </dd>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </dl>
                        <?php
                    } else {
                        ?>
                        <p class="error"><?php print($unavailable); ?></p>
                        <?php
                    }
                    ?>
            </section>
            <?php
            if (!isset($unavailable)) {
                ?>
                <section class="cart right">
                    <h2>Bestellen</h2>
                    <form action="" method="post">
                        <label for="product">Selecteer de gewenste pizza: </label>
                        <select name="product">
                            <?php
                            foreach ($productlijst as $product) {
                                    ?>
                                    <option value="<?php print($product->getId()); ?>">
                                            <?php print($product->getNaam() . " (€ " . $product->getPrijs() . ")"); ?>
                                    </option>
                                    <?php
                            } ?>
                        </select>
                        <br>
                        <br>
                        <button type="submit" name="add">Toevoegen</button>
                    </form>
                    <?php
                    if (!empty($winkelmand)) {
                        ?>
                        <h2>Winkelmandje</h2>
                        <?php
                        if (isset($maxPizza) && $maxPizza == true) {
                            ?>
                            <p class=error>Je kan maximum 15 pizza's per soort bestellen.</p>
                            <?php
                        }
                        for ($i=0; $i <= max(array_keys($winkelmand)); $i++) {
                            if (isset($winkelmand[$i])) {
                                $product = $winkelmand[$i][0];
                                $aantal = $winkelmand[$i][1];
                                ?>
                                <form action="" method="post" class="changeCart">
                                    <p class="pizzaAantal"><?php print($aantal . "x "); ?></p>
                                    <p class="pizzaNaam"><?php print($product->getNaam()); ?></p>

                                    <div>
                                        <button type="submit" name="plus" value="<?php print($i); ?>" class="small">+</button>
                                        <button type="submit"name="min" value="<?php print($i); ?>" class="small">-</button>
                                        <button type="submit"name="delete" value="<?php print($i); ?>" class="small">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <p class="pizzaPrijs">€ <?php print($aantal * $product->getPrijs()); ?></p>
                                </form>
                                <?php
                            }
                        }
                        ?>
                        <p><small>Eventuele kortingen worden in de volgende stap berekend.</small></p>
                        <form action="afrekenen.php" method="post">
                            <button type="submit">Afrekenen</button>
                        </form>
                        <?php
                    }
                    ?>
                </section>
                <?php
            }
            ?>
        </div>
    </div>
</div>