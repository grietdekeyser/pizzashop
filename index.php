<?php

//index.php

use Business\GastenboekService;
use Business\KlantService;
use Business\PostcodeService;
use Exceptions\NoDeliveryException;
require_once("Business/GastenboekService.php");
require_once("Business/KlantService.php");
require_once("Business/PostcodeService.php");

//controle login
$klantSvc = new KlantService();
$klant = $klantSvc->getIngelogdeKlant();
if ($klant) {
    $naamKlant = $klant->getVoornaam();
}

//leveringsgebied
$postcodeSvc = new PostcodeService();
try {
    $leveringsgebied = $postcodeSvc->getPostcodeTekst();
} catch (NoDeliveryException $ex) {
    $noDelivery = true;
}

//gastenboek
$gastenboekSvc = new GastenboekService();
$gastenboekLijst = $gastenboekSvc->getTienBerichten();
$errors = [];

include("Presentation/header.php");
include("Presentation/home.php");
include("Presentation/footer.php");

