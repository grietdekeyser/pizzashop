<!DOCTYPE html>
<!-- Presentation/header.php -->
<html>
<head>
	<meta charset="utf-8">
	<title><?php if(isset($paginaTitel)) {print($paginaTitel); } else { print("Pizza pazzo"); }?></title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="CSS/stylesheet.css" type="text/css"/>
</head>
<body>
	<div class="pageContainer">
	<header class="hero">
		<div class="container">
			<section class="menu">
				<nav>
					<ul>
						<li>
							<a href="bestellen.php" <?php if (isset($active) && $active == "bestellen") {print("class='active'"); }?>>Bestellen</a>
						</li>
						<li>
							<a href="gastenboek.php" <?php if (isset($active) && $active == "gastenboek") {print("class='active'"); }?>>Gastenboek</a>
						</li>
						<?php
						// aangepast menu (inloggen)
						if (isset($klant) && $klant) {
							?>
							<li>
								<input type="checkbox" id="submenu">
            					<label for="submenu" <?php if (isset($active) && $active == "account") {print("class='active'"); }?>>Mijn account <i class="fas fa-caret-down"></i><i class="fas fa-caret-up"></i> </label>
            					<ul class="submenu">
            						<li>
            							<a href="account.php">Adres aanpassen</a>
            						</li>
            						<li>
            							<a href="uitloggen.php">Uitloggen</a>
            						</li>
							</li>
							<?php
						} else {
							?>
							<li>
								<a href="inloggen.php" <?php if (isset($active) && $active == "inloggen") {print("class='active'"); }?>>Inloggen</a>
							</li>
							<li>
								<a href="registratie.php" <?php if (isset($active) && $active == "registreren") {print("class='active'"); }?>>Registreren</a>
							</li>
							<?php
						}
						?>
					</ul>
				</nav>
			</section>
			<section class="hero-titel">
                <h1><a href="index.php">Pizza pazzi</a></h1>
                <p><small>De lekkerste pizza's van Gent</small></p>
            </section>
		</div>
	</header>