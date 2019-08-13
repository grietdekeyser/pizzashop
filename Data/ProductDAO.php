<?php

//Data/ProductDAO.php

namespace Data;

use Data\DBConfig;
use \PDO;
use Entities\Product;
use Exceptions\UnavailableException;
require_once("DBConfig.php");
require_once("Entities/Product.php");
require_once("Exceptions/UnavailableException.php");

class ProductDAO {
    public function getAll() : array {
        $sql = "select productid, naam, samenstelling, prijs, beschikbaar, afbeelding from producten";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);

        $lijst = [];
        foreach ($resultSet as $rij) {
            $product = Product::create($rij["productid"], $rij["naam"], $rij["samenstelling"], $rij["prijs"], $rij["beschikbaar"], $rij["afbeelding"]);
            array_push($lijst, $product);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function getBeschikbareProducten() : array {
        $sql = "select productid, naam, samenstelling, prijs, beschikbaar, afbeelding from producten where beschikbaar = :beschikbaar";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':beschikbaar' => 1
        ));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $lijst = [];
        if ($resultSet) {
            foreach ($resultSet as $rij) {
                $product = Product::create($rij["productid"], $rij["naam"], $rij["samenstelling"], $rij["prijs"], $rij["beschikbaar"], $rij["afbeelding"]);
                array_push($lijst, $product);
            }
        } else {
            throw new UnavailableException; 
        }
        $dbh = null;
        return $lijst;
    }
    
    public function getById(int $id) {
        $sql = "select productid, naam, samenstelling, prijs, beschikbaar, afbeelding from producten where productid = :productid";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':productid' => $id
        ));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $product = Product::create($id,  $rij["naam"], $rij["samenstelling"], $rij["prijs"], $rij["beschikbaar"], $rij["afbeelding"]);
        $dbh = null;
        return $product;
    }
}