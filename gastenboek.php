<?php

//gastenboek.php

use Business\GastenboekService;
use Business\KlantService;
require_once("Business/GastenboekService.php");
require_once("Business/KlantService.php");

//controle login
$klantSvc = new KlantService();
$klant = $klantSvc->getIngelogdeKlant();
if ($klant) {
    $naamKlant = $klant->getVoornaam();
}

//gastenboek
$divToevoegen = true;
$gastenboekSvc = new GastenboekService();
$gastenboekLijst = $gastenboekSvc->getVijftigBerichten();

$errors = [];
if (isset($_POST["plaatsbericht"])) {
    $errors = $gastenboekSvc->valideerBericht($_POST["bericht"]);
    if (empty($errors)){
        $gastenboekSvc->createBericht($klant->getId(), $_POST["naam"], $_POST["bericht"]);
        $berichtGeplaatst = true;
        $gastenboekLijst = $gastenboekSvc->getVijftigBerichten();
    }
}
$paginaTitel = "Pizza pazzo - Gastenboek";
    $active = "gastenboek";
include("Presentation/header.php");
include("Presentation/gastenboekOverzicht.php");
include("Presentation/footer.php");

