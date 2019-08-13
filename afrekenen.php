<?php

//afrekenen.php

use Business\BestelService;
use Business\KlantService;
use Business\PostcodeService;
use Business\ProductService;
use Business\PromoService;
use Business\WinkelmandService;
use Exceptions\NoDeliveryException;
require_once("Business/BestelService.php");
require_once("Business/KlantService.php");
require_once("Business/PostcodeService.php");
require_once("Business/ProductService.php");
require_once("Business/PromoService.php");
require_once("Business/WinkelmandService.php");

$klantSvc = new KlantService();
$klant = $klantSvc->getIngelogdeKlant();

//is een klant ingelogd?
if ($klant) {
    $naamKlant = $klant->getVoornaam();
    $klantid = $klant->getId();
    
    //controle openingsuren
    $uur = date("H");
    if ($uur < 12 || $uur > 22) {
        $gesloten = true;
        $uur = "12.00";
    } elseif ($uur >= 14 && $uur < 18) {
        $gesloten = true;
        $uur = "18.00";
    }
    
    $winkelmandSvc = new WinkelmandService();
    $winkelmand = $winkelmandSvc->GetMandje();
    
    $promoSvc = new PromoService();
    $korting = $promoSvc->rechtOpPromo($klant);
    
    if ($korting) {
        $subtotaal = $winkelmandSvc->GetTotaalMand();
        //bereken totaal (subtotaal - korting)
        $totaalPrijs = $winkelmandSvc->GetTotaalMand($subtotaal, $korting);
    } else {
        $totaalPrijs = $winkelmandSvc->GetTotaalMand();
    }
        
    //controle: ligt postcode binnen leveringsgebied?
    $postcodeSvc = new PostcodeService();
    try {
        $leveringsgebied = $postcodeSvc->getPostcodeTekst();
        $levering = $postcodeSvc->controleerPostcode($klant->getPostcode());
    } catch (NoDeliveryException $ex) {
        $noDelivery = true;
    }   
    
    //bestelling plaatsen
    $bestellingGeplaatst = false;
    if (isset($_POST["checkout"])) {
        $bestelSvc = new BestelService();
        $bestelSvc->createBestelling($klantid, $winkelmand, $totaalPrijs, $korting);        
        $bestellingGeplaatst = true;
        setcookie("cart", "", 1);
    }
    
    if ($bestellingGeplaatst) {
        $paginaTitel = "Pizza pazzo - Bevestiging";
        $active = "bestellen";
        include("Presentation/header.php");    
        include("Presentation/bevestiging.php");
    } else {
        $paginaTitel = "Pizza pazzo - Afrekenen";
        $active = "bestellen";
        include("Presentation/header.php"); 
        include("Presentation/afrekenOverzicht.php");
    }
} else {
	if (isset($_POST["hasAccount"])) {
                header("location: inloggen.php?action=order");
                exit(0);
	} elseif (isset($_POST["newAccount"])) {
                header("location: registratie.php?action=order");
                exit(0);
	} else {
            $paginaTitel = "Pizza pazzo - Afrekenen";
            $active = "bestellen";
            include("Presentation/header.php"); 
            include("Presentation/nietingelogd.php");
        }
}
include("Presentation/footer.php");