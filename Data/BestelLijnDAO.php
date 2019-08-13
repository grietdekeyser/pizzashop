<?php

//Data/BestelLijnDAO.php

namespace Data;

use Data\DBConfig;
use \PDO;
use Entities\BestelLijn;
require_once("DBConfig.php");
require_once("Entities/BestelLijn.php");

class BestelLijnDAO {
    public function getAll() : array {
        $sql = "select bestellijnid, bestelid, productid from bestellijnen";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);

        $lijst = [];
        foreach ($resultSet as $rij) {
            $bestelLijn = BestelLijn::create($rij["bestellijnid"], $rij["bestelid"], $rij["productid"]);
            array_push($lijst, $bestelLijn);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function getById(int $id) {
        $sql = "select bestellijnid, bestelid, productid from bestellijnen where bestellijnid = :bestellijnid";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':bestellijnid' => $id
        ));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($rij) {
            $bestelLijn = BestelLijn::create($id, $rij["bestelid"], $rij["productid"]);
        }
        else {
            $bestelLijn = null;
        }
        $dbh = null;
        return $bestelLijn;
    }
    
    public function getByBestelid(int $bestelid) {
        $sql = "select bestellijnid, bestelid, productid from bestellijnen where bestelid = :bestelid";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':bestelid' => $bestelid
        ));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $lijst = [];
        if ($resultSet) {
            foreach ($resultSet as $rij) {
                $bestelLijn = BestelLijn::create($rij["bestellijnid"], $bestelid, $rij["productid"]);
               array_push($lijst, $bestelLijn); 
            }
        }
        $dbh = null;
        return $lijst;
    }  
    
    public function getByProductid(int $productid) {
        $sql = "select bestellijnid, bestelid, productid from bestellijnen where productid = :productid";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':productid' => $productid
        ));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $lijst = [];
        if ($resultSet) {
            foreach ($resultSet as $rij) {
                $bestelLijn = BestelLijn::create($rij["bestellijnid"], $rij["bestelid"], $productid);
               array_push($lijst, $bestelLijn); 
            }
        }
        $dbh = null;
        return $lijst;
    } 
    
    public function create(int $bestelid, int $productid) {        
        $sql = "insert into bestelLijnen (bestelid, productid) values (:bestelid, :productid)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':bestelid' => $bestelid, 
            ':productid' => $productid
        ));
          
        $id = $dbh->lastInsertId();
        $bestelLijn = $this->getById($id);
        $dbh = null;
        return $bestelLijn;
    }
}