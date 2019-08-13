<?php

//inloggen.php

use Business\KlantService;
use Exceptions\PasswordWrongException;
use Exceptions\UserUnknownException;
require_once("Business/KlantService.php");

$klantSvc = new KlantService();

if ($klantSvc->getIngelogdeKlant()) {
    //ingelogd: verwijzen naar index
    header("location: index.php");
    exit(0);
} else {
    $errors = [];
    if (isset($_POST["login"])) {
        //controle: lege velden?
        $errors = $klantSvc->valideerForm($_POST, "login");
        try {
            //controle: correcte login?
            $klantSvc->controleerLogin($_POST["email"], $_POST["wachtwoord"]);
            if (isset($_GET["action"]) && $_GET["action"] == "order") {
                header("location: afrekenen.php");
                exit(0);
            } else {
                header("location: index.php");
                exit(0);
            }
        } catch (UserUnknownException $ex) {
            $errors[] = "emailunknown";
        } catch (PasswordWrongException $ex) {
            $errors[] = "passwordwrong";
        }
    }
    $paginaTitel = "Pizza pazzo - Inloggen";
    $active = "inloggen";
    include("Presentation/header.php");
    include("Presentation/inlogForm.php");
    include("Presentation/footer.php");
}
