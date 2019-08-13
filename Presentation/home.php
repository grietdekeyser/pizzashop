<!-- Presentation/home.php -->
<div class="content">
	<div class="container">
		<?php
		if ($klant) {
			print("<p>Dag " . $naamKlant . "!");
		}
		?>
		<p>Welkom bij Pizza pazzi, de lekkerste pizza's van Gent.</p>
		<div class="flex">
			<section class="open left">
				<h2>Openinsuren</h2>
				<p>Dagelijks open van 12.00 tot 14.00 uur en 18.00 tot 22.00 uur.</p>
				<p>Het is ook mogelijk om een bestelling te plaatsen buiten de openingsuren, de levering vindt plaats tijdens de openingsuren.</p>
			</section>
			<section class="levering right">
				<h2>Levering</h2>
				<?php
				if (isset($noDelivery) && $noDelivery) {
		            ?>
		            <p class="error">Levering is momenteel niet beschikbaar. Probeer later opnieuw</p>
		            <?php
		        } else {
		            ?>
		            <p>We leveren onze pizza's gratis aan huis in <?php print($leveringsgebied); ?>.</p>
		            <p>De gemiddelde levertijd bedraagt 45 minuten.</p>
		            <?php
		        }
		        ?>
		    </section>
	    </div>
		<h2>Lopende promoties</h2>
		<div class="flex">
			<section class="maand left">
				<h3>Korting van de maand</h3>
				<p>Bij een bestelling vanaf 40 euro ontvangt u 5 euro korting.</p>
			</section>
			<section class="trouw right">
				<h3>Getrouwheidskorting</h3>
				<p>Wanneer je meer van één jaar klant bent, ontvang je 10% korting op elke bestelling.</p>
			</section>
		</div>
		<p><small>Kortingen zijn niet cumuleerbar. De hoogste korting wordt automatisch toegekend.</small></p>
		<br>
		<?php
		include("Presentation/gastenboekOverzicht.php")
		?>
	</div>
</div>

