<?php

//Data/BestellingDAO.php

namespace Data;

use Data\DBConfig;
use \PDO;
use Entities\Bestelling;
require_once("DBConfig.php");
require_once("Entities/Bestelling.php");

class BestellingDAO {
    public function getAll() : array {
        $sql = "select bestelid, klantid, datumtijd, prijs, korting from bestellingen";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);

        $lijst = [];
        foreach ($resultSet as $rij) {
            $bestelling = Bestelling::create($rij["bestelid"], $rij["klantid"], $rij["datumtijd"], $rij["prijs"], $rij["korting"]);
            array_push($lijst, $bestelling);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function getById(int $id) {
        $sql = "select bestelid, klantid, datumtijd, prijs, korting from bestellingen where bestelid = :bestelid";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':bestelid' => $id
        ));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($rij) {
            $bestelling = Bestelling::create($id, $rij["klantid"], $rij["datumtijd"], $rij["prijs"], $rij["korting"]);
        }
        else {
            $bestelling = null;
        }
        $dbh = null;
        return $bestelling;
    }

    public function getByKlantid(int $klantid) {
        $sql = "select bestelid, klantid, datumtijd, prijs, korting from bestellingen where klantid = :klantid";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':klantid' => $klantid
        ));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $lijst = [];
        if ($resultSet) {
            foreach ($resultSet as $rij) {
                $bestelling = Bestelling::create($rij["bestelid"], $klantid, $rij["datumtijd"], $rij["prijs"], $rij["korting"]);
               array_push($lijst, $bestelling); 
            }
        }
        $dbh = null;
        return $lijst;
    }    
    
    public function create(int $klantid, float $prijs , float $korting) {        
        $sql = "insert into bestellingen (klantid, prijs, korting) values (:klantid, :prijs, :korting)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':klantid' => $klantid, 
            ':prijs' => $prijs,
            ':korting' => $korting
        ));
          
        $id = $dbh->lastInsertId();
        $bestelling = $this->getById($id);
        $dbh = null;
        return $bestelling;
    }
}