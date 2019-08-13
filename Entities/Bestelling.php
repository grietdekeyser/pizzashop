<?php 

//Entities/Bestelling.php

namespace Entities;

class Bestelling {
    private static $idMap = array();

    private $id;
    private $klantid;
    private $datumtijd;
    private $prijs;
    private $korting;

    private function __construct(int $id, int $klantid, string $datumtijd, float $prijs, float $korting) {
        $this->id = $id;
        $this->klantid = $klantid;
        $this->datumtijd = $datumtijd;
        $this->prijs = $prijs;
        $this->korting = $korting;
    }
    
    public static function create(int $id, int $klantid, string $datumtijd, float $prijs , float $korting) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Bestelling($id, $klantid, $datumtijd, $prijs, $korting);
        }
        return self::$idMap[$id];
    }

    public function getId() : int {
        return $this->id;
    }

    public function getKlantid() : int {
        return $this->klantid;
    }

    public function getDatumtijd() : string {
        return $this->datumtijd;
    }

    public function getPrijs() : float {
        return $this->prijs;
    }
    
    public function getKorting() : float {
        return $this->korting;
    }

    public function setKlantid(int $klantid) {
        $this->klantid = $klantid;
    }

    public function setDatumtijd(string $datumtijd) {
        $this->datumtijd = $datumtijd;
    }

    public function setPrijs(float $prijs) {
        $this->prijs = $prijs;
    }
    
    public function setKorting(float $korting) {
        $this->korting = $korting;
    }
}