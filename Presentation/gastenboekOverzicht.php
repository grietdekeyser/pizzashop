<!-- Presentation/gastenboek.php -->
<?php
if (isset($divToevoegen) && $divToevoegen) {
	?>
	<div class="content">
		<div class="container">
			<h1>Gastenboek</h1>
	<?php
} else {
	?>
	<h2>Gastenboek</h2>
	<?php
}
?>
<div class="flex">
	<section class="gastenboek left">
		<h3>Berichten</h3>
		<?php
		foreach ($gastenboekLijst as $bericht) {
			?>
			<p><strong><?php if ($bericht->getNaam()) { print($bericht->getNaam()); } else { print("Anoniem"); }?></strong></p>
			<p><?php print($bericht->getBericht()); ?></p>
			<?php
		}
		?>
	</section>
	<section class="bericht right">
		<h3>Voeg een bericht toe</h3>
		<?php
		if ($klant) {
			if (isset($berichtGeplaatst) && $berichtGeplaatst) {
				?>
				<p>Jouw bericht werd toegevoegd aan het gastenboek</p>
				<?php
			}
			else {
				?>
				<form action="gastenboek.php" method="post" name="gastenboek">
					<section>
						<label for="naam">Naam</label>
						<input type="text" name="naam" value="<?php if (isset($_POST["naam"])) { print($_POST["naam"]); } else { print($naamKlant); }?>">
					</section>
					<section>
						<label for="bericht">Bericht</label>
	        			<textarea name="bericht" <?php if (in_array("emptybericht", $errors) || in_array("telang", $errors)) { print("class='error'"); }?> ><?php if (isset($_POST["bericht"])) { print($_POST["bericht"]); }?></textarea>
	        			<?php
		                if (in_array("emptybericht", $errors)) {
		                    ?>
		                    <p class="error"><small>Dit is een verplicht veld. Vul een waarde in.</small></p>
		                    <?php
		                } elseif (in_array("telang", $errors)) {
		                	?>
		                    <p class="error"><small>Jouw bericht is te lang. Maximum 150 karakters.</small></p>
		                    <?php
		                }
		                ?>
					</section>
					<br>
					<button type="submit" name="plaatsbericht">Plaats bericht</button>
				</form>
				<?php
			}
		} else {
			?>
			<p>Je moet ingelogd zijn om berichten te kunnen toevegen aan het gastenboek</p>
			<?php
		}
		?>
	</section>
</div>
<?php
if (isset($divToevoegen) && $divToevoegen) {
	?>
		</div>
	</div>
	<?php
}
?>
