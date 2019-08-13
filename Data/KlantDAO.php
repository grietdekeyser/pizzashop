<?php

//Data/KlantDAO.php

namespace Data;

use Data\DBConfig;
use \PDO;
use Entities\Klant;
use Exceptions\EmailExistsException;
require_once("DBConfig.php");
require_once("Entities/Klant.php");
require_once("Exceptions/EmailExistsException.php");

class KlantDAO {
    public function getAll() : array {
        $sql = "select klantid, email, wachtwoord, familienaam, voornaam, straat, huisnummer, bus, postcode, woonplaats, telefoon, opmerking, registratiedatum from klanten";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);

        $lijst = [];
        foreach ($resultSet as $rij) {
            $klant = Klant::create($rij["id"],$rij["email"], $rij["wachtwoord"], $rij["familienaam"], $rij["voornaam"], $rij["straat"], $rij["huisnummer"], $rij["bus"], $rij["postcode"], $rij["woonplaats"], $rij["telefoon"], $rij["opmerking"], $rij["registratiedatum"]);
            array_push($lijst, $klant);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function getById(int $id) {
        $sql = "select klantid, email, wachtwoord, familienaam, voornaam, straat, huisnummer, bus, postcode, woonplaats, telefoon, opmerking, registratiedatum from klanten where klantid = :klantid";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':klantid' => $id
        ));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($rij) {
            $klant = Klant::create($id, $rij["email"], $rij["wachtwoord"], $rij["familienaam"], $rij["voornaam"], $rij["straat"], $rij["huisnummer"], $rij["bus"], $rij["postcode"], $rij["woonplaats"], $rij["telefoon"], $rij["opmerking"], $rij["registratiedatum"]);
        }
        else {
            $klant = null;
        }
        $dbh = null;
        return $klant;
    }

    public function getByEmail(string $email) {
        $sql = "select klantid, email, wachtwoord, familienaam, voornaam, straat, huisnummer, bus, postcode, woonplaats, telefoon, opmerking, registratiedatum from klanten where email = :email";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':email' => $email
        ));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($rij) {
            $klant = Klant::create($rij["klantid"], $email, $rij["wachtwoord"], $rij["familienaam"], $rij["voornaam"], $rij["straat"], $rij["huisnummer"], $rij["bus"], $rij["postcode"], $rij["woonplaats"], $rij["telefoon"], $rij["opmerking"], $rij["registratiedatum"]);
        }
        else {
            $klant = null;
        }
        $dbh = null;
        return $klant;
    }    
    
    public function create(string $email, string $wachtwoord, string $familienaam, string $voornaam, string $straat, string $huisnummer, string $bus, int $postcode, string $woonplaats, string $telefoon, string $opmerking) {
        //controle of er reeds klant is met dit e-mailadres
        $bestaandeKlant = $this->getByEmail($email);
        if (!is_null($bestaandeKlant)) {
            throw new EmailExistsException;
        }        
        
        $sql = "insert into klanten (email, wachtwoord, familienaam, voornaam, straat, huisnummer, bus, postcode, woonplaats, telefoon, opmerking) values (:email, :wachtwoord, :voornaam, :familienaam, :straat, :huisnummer, :bus, :postcode, :woonplaats, :telefoon, :opmerking)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':email' => $email, 
            ':wachtwoord' => $wachtwoord,
            ':voornaam' => $voornaam,
            ':familienaam' => $familienaam,
            ':straat' => $straat,
            ':huisnummer' => $huisnummer,
            ':bus' => $bus,
            ':postcode' => $postcode,
            ':woonplaats' => $woonplaats,
            ':telefoon' => $telefoon,
            ':opmerking' => $opmerking
        ));
          
        $id = $dbh->lastInsertId();
        $klant = $this->getById($id);
        $dbh = null;
        return $klant;
    }
    
    //adresgegevens wijzigen
    public function updateAdresgegevens($klant) {
        $sql = "update klanten set straat = :straat, huisnummer = :huisnummer, bus = :bus, postcode = :postcode, woonplaats = :woonplaats, telefoon = :telefoon, opmerking = :opmerking where klantid = :klantid";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':straat' => $klant->getStraat(),
            ':huisnummer' => $klant->getHuisnummer(),
            ':bus' => $klant->getBus(),
            ':postcode' => $klant->getPostcode(),
            ':woonplaats' => $klant->getWoonplaats(),
            ':telefoon' => $klant->getTelefoon(),
            ':opmerking' => $klant->getOpmerking(),
            ':klantid' => $klant->getId()
        ));
        $dbh = null;
    }
}