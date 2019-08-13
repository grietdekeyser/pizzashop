<!-- Presentation/afrekenOverzicht.php -->
<div class="content">
    <div class="container">
        <h2>Afrekenen</h2>
        <p>Kan je niet meer wachten tot we jouw bestelling bezorgen, <?php print($naamKlant); ?>? Kijk jouw gegevens na en bevestig je bestelling.</p>
        <?php
        if (!empty($winkelmand)) {
            include("Presentation/mandAdresOverzicht.php");
            if (isset($levering) && $levering) {
                ?>
                <p>Zijn alle gegevens correct? </p>
                <form action="afrekenen.php" method="post" class="checkout">
                    <button type="submit" name="checkout">Bestelling plaatsen</button>
                </form>
                <?php
            }
        } else {
            ?>
            <br>
            <br>
            <p class="error">Er is een fout opgetreden. Probeer opnieuw te <a href="bestellen.php">bestellen</a>.</p>
            <?php
        }
        ?>
    </div>
</div>