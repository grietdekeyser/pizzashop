<?php

//Business/KlantService.php

namespace Business;

use Entities\Klant;
use Data\KlantDAO;
use Exceptions\PasswordWrongException;
use Exceptions\UserUnknownException;
require_once("Data/KlantDAO.php");
require_once("Exceptions/PasswordWrongException.php");
require_once("Exceptions/UserUnknownException.php");

class KlantService {
    // ALGEMENE FUNCTIES
    
    public function getKlantById(int $id) {
        $klantDAO = new KlantDAO();
        $klant = $klantDAO->getById($id);
        return $klant;
    }
    
    public function getKlantByEmail(string $email) {
        $klantDAO = new KlantDAO();
        $klant = $klantDAO->getByEmail($email);
        return $klant;
    }
    
    public function voegKlantToe(string $email, string $wachtwoord, string $familienaam, string $voornaam, string $straat, string $huisnummer, string $bus, int $postcode, string $woonplaats, string $telefoon, string $opmerking) {
        $encodedwachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);          
        $klantDAO = new KlantDAO();
        $nieuweKlant = $klantDAO->create($email, $encodedwachtwoord, $familienaam, $voornaam, $straat, $huisnummer, $bus, $postcode, $woonplaats, $telefoon, $opmerking);
        setcookie("klant", $email, time()+ 3600*24*14);
        setcookie("klantId", $nieuweKlant->getId(), time()+ 3600);
    }
    
    public function updateAdresgegevens(Klant $klant, string $straat, string $huisnummer, string $bus, int $postcode, string $woonplaats, string $telefoon, string $opmerking) {
        $klant->setStraat($straat);
        $klant->setHuisnummer($huisnummer);
        $klant->setBus($bus);
        $klant->setPostcode($postcode);
        $klant->setWoonplaats($woonplaats);
        $klant->setTelefoon($telefoon);
        $klant->setOpmerking($opmerking);
        $klantDAO = new KlantDAO();
        $klantDAO->updateAdresgegevens($klant);       
    }
    
    // VALIDATIE FORMULIEREN
    
    public function valideerForm(array $array, string $form) : array {
        /* valideert formulieren en returnt array met fouten
         * $array: array met $_POST-variabelen
         * $form: naam form (register, login, change) */
        
        $errors = [];
        //controle: verplichte velden ingevuld?
        foreach ($array as $key => $value) {
            if (($key != "bus" && $key != "opmerking" &&  $key != "register" &&  $key != "login" && $key != "change") && empty($value)) {
                $errors[] = "empty" . $key;
            }
        }
        if ($form == "register" || $form =="change") {
            //controle: postcode getal tussen 1000 en 9999?
            if (!empty($array["postcode"]) && !is_nan($array["postcode"]) && ($array["postcode"] < 1000 || $array["postcode"] > 9999)) {
                $errors[] = "wrongpostcode"; 
            }
        }
        if ($form == "register") {
            //controle: wachtwoorden gelijk?
            if ($array["wachtwoord1"] != $array["wachtwoord2"]) {
                $errors[] = "passwordnomatch";
            }
            //controle: reeds account gekoppeld aan e-mail?
            if (!is_null($this->getKlantByEmail($array["email"]))) {
                $errors[] = "emailexists";
            }
        }
        return $errors;
    }
    
    // INLOGGEN
    
    public function controleerLogin($email, $wachtwoord) {
        //controleert of klant met emailadres bestaat + combinatie met wachtwoord
        $klant = $this->getKlantByEmail($email);
        if ($klant) {
            if (password_verify($wachtwoord, $klant->getWachtwoord())) {
                $klantId = $klant->getId();
                setcookie("klant", $email, time()+ 3600*24*14);
                setcookie("klantId", $klantId, time()+ 3600);
            } else {
                throw new PasswordWrongException;
            }
        }
        else {
            throw new UserUnknownException;
        }
        return $klant;
    }
    
    public function getIngelogdeKlant() {
        //controleert cookies
        if (isset($_COOKIE["klantId"])) {
            $klantId = $_COOKIE["klantId"];
            $klant = $this->getKlantById($klantId);
            return $klant;
        }
    }
}
