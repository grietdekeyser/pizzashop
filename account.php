<?php

//account.php

use Business\KlantService;
require_once("Business/KlantService.php");

$klantSvc = new KlantService();
$klant = $klantSvc->getIngelogdeKlant();

if ($klant) {
    $errors = [];
    if (isset($_POST["change"])) {
        $errors = $klantSvc->valideerForm($_POST, "change");
        if (empty($errors)) {        
            $klantSvc->updateAdresgegevens($klant, $_POST["straat"], $_POST["huisnummer"], $_POST["bus"], $_POST["postcode"], $_POST["woonplaats"], $_POST["telefoon"], $_POST["opmerking"]);
            header("location: afrekenen.php");
            if (isset($_GET["action"]) && $_GET["action"] == "order") {
                header("location: afrekenen.php");
                exit(0);
            } else {
                header("location: index.php");
                exit(0);
            }
        }
    }
    $paginaTitel = "Pizza pazzo - Bezorgadres aanpassen";
    $active = "account";
    include("Presentation/header.php"); 
    include("Presentation/addressForm.php");
    include("Presentation/footer.php");
} else {
    header("location: index.php");
    exit(0);
}