<?php

//bestellen.php

use Business\KlantService;
use Business\ProductService;
use Business\WinkelmandService;
use Exceptions\MaximumPizzaException;
use Exceptions\UnavailableException;
require_once("Business/KlantService.php");
require_once("Business/ProductService.php");
require_once("Business/WinkelmandService.php");

$klantSvc = new KlantService();

$productSvc = new ProductService();
try {
    $productlijst = $productSvc->getBeschikbaarOverzicht();
} catch (UnavailableException $ex) {
    $unavailable = "Op dit moment is het niet mogelijk om pizza's te bestellen. Probeer later opnieuw";
    setcookie("cart", "", 1);
}

$winkelmandSvc = new WinkelmandService();
$winkelmand = $winkelmandSvc->GetMandje();

//controle login
$klant = $klantSvc->getIngelogdeKlant();
if ($klant) {
    $naamKlant = $klant->getVoornaam();
}

//winkelmandje wijzigen
if (isset($_POST["add"])) {
    try {
        $winkelmand = $winkelmandSvc->WijzigMandje($_POST["product"]);
    } catch (MaximumPizzaException $ex) {
        $maxPizza = true;
    }
} elseif (isset($_POST["plus"])) {
    try {
        $winkelmand = $winkelmandSvc->WijzigMandje($_POST["plus"], "plus");
    } catch (MaximumPizzaException $ex) {
        $maxPizza = true;
    }
}  elseif (isset($_POST["min"])) {
    $winkelmand = $winkelmandSvc->WijzigMandje($_POST["min"], "min");
} elseif (isset($_POST["delete"])) {
    $winkelmand = $winkelmandSvc->WijzigMandje($_POST["delete"], "delete");
}

$paginaTitel = "Pizza pazzo - Bestellen";
$active = "bestellen";
include("Presentation/header.php");    
include("Presentation/bestelForm.php");
include("Presentation/footer.php");
