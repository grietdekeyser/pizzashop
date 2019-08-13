<?php

//registratie.php

use Business\KlantService;
use Exceptions\EmailExistsException;
require_once("Business/KlantService.php");
require_once("Exceptions/EmailExistsException.php");

$klantSvc = new KlantService();

if ($klantSvc->getIngelogdeKlant()) {
    //ingelogd: verwijzen naar index
    header("location: index.php");
    exit(0);
} else {
    $errors = [];
    if (isset($_POST["register"])) {
        $errors = $klantSvc->valideerForm($_POST, "register");
        if (empty($errors)) {
            //controle e-mail uniek?
            try {            
                $klantSvc->voegKlantToe($_POST["email"], $_POST["wachtwoord1"], $_POST["familienaam"], $_POST["voornaam"], $_POST["straat"], $_POST["huisnummer"], $_POST["bus"], $_POST["postcode"], $_POST["woonplaats"], $_POST["telefoon"], $_POST["opmerking"]);
                if (isset($_GET["action"]) && $_GET["action"] == "order") {
                    header("location: afrekenen.php");
                    exit(0);
                } else {
                    header("location: index.php");
                    exit(0);
                }
            } catch (EmailExistsException $ex) {
                $errors[] = "emailexists";
            }
        }
    }
    $paginaTitel = "Pizza pazzo - Registreren";
    $active = "registreren";
    include("Presentation/header.php");    
    include("Presentation/registratieForm.php");
    include("Presentation/footer.php");
}