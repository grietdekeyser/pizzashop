<?php

//Data/GastenboekDAO.php

namespace Data;

use Data\DBConfig;
use \PDO;
use Entities\Gastenboek;
require_once("DBConfig.php");
require_once("Entities/Gastenboek.php");

class GastenboekDAO {
    public function getAll() : array {
        $sql = "select id, klantid, naam, bericht, datum from gastenboek order by datum desc";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);

        $lijst = [];
        foreach ($resultSet as $rij) {
            $gastenboek = Gastenboek::create($rij["id"], $rij["klantid"], $rij["naam"], $rij["bericht"], $rij["datum"]);
            array_push($lijst, $gastenboek);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function getVijftig() : array {
        $sql = "select id, klantid, naam, bericht, datum from gastenboek order by datum desc limit 50";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);

        $lijst = [];
        foreach ($resultSet as $rij) {
            $gastenboek = Gastenboek::create($rij["id"], $rij["klantid"], $rij["naam"], $rij["bericht"], $rij["datum"]);
            array_push($lijst, $gastenboek);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function getTien() : array {
        $sql = "select id, klantid, naam, bericht, datum from gastenboek order by datum desc limit 10";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);

        $lijst = [];
        foreach ($resultSet as $rij) {
            $gastenboek = Gastenboek::create($rij["id"], $rij["klantid"], $rij["naam"], $rij["bericht"], $rij["datum"]);
            array_push($lijst, $gastenboek);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function getById(int $id) {
        $sql = "select id, klantid, naam, bericht, datum from gastenboek where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':id' => $id
        ));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($rij) {
            $gastenboek = Gastenboek::create($id, $rij["klantid"], $rij["naam"], $rij["bericht"], $rij["bericht"], $rij["datum"]);
        }
        else {
            $gastenboek = null;
        }
        $dbh = null;
        return $gastenboek;
    }

    public function getByKlantid(int $klantid) {
        $sql = "select id, klantid, naam, bericht, datum from gastenboek where klantid = :klantid";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':klantid' => $klantid
        ));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $lijst = [];
        if ($resultSet) {
            foreach ($resultSet as $rij) {
                $gastenboek = Gastenboek::create($rij["id"], $klantid, $rij["naam"], $rij["bericht"], $rij["bericht"], $rij["datum"]);
               array_push($lijst, $gastenboek); 
            }
        }
        $dbh = null;
        return $lijst;
    }    
    
    public function create(int $klantid, string $naam , string $bericht) {        
        $sql = "insert into gastenboek (klantid, naam, bericht) values (:klantid, :naam, :bericht)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':klantid' => $klantid, 
            ':naam' => $naam,
            ':bericht' => $bericht
        ));
          
        $id = $dbh->lastInsertId();
        $gastenboek = $this->getById($id);
        $dbh = null;
        return $gastenboek;
    }
}