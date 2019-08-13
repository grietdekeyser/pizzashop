<?php 

//Entities/Gastenboek.php

namespace Entities;

class Gastenboek {
    private static $idMap = array();

    private $id;
    private $klantid;
    private $naam;
    private $bericht;
    private $datum;

    private function __construct(int $id, int $klantid, string $naam, string $bericht, string $datum) {
        $this->id = $id;
        $this->klantid = $klantid;
        $this->naam = $naam;
        $this->bericht = $bericht;
    }
    
    public static function create(int $id, string $klantid, string $naam, string $bericht, string $datum) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Gastenboek($id, $klantid, $naam, $bericht, $datum);
        }
        return self::$idMap[$id];
    }

    public function getId() : int {
        return $this->id;
    }

    public function getKlantid() : int {
        return $this->klantid;
    }

    public function getNaam() : string {
        return $this->naam;
    }
    
    public function getBericht() : string {
        return $this->bericht;
    }
    
    public function getDatum() : string {
        return $this->datum;
    }

    public function setKlantid(int $klantid) {
        $this->klantid = $klantid;
    }

    public function setNaam(string $naam) {
        $this->naam = $naam;
    }
    
    public function setBericht(string $bericht) {
        $this->naam = $bericht;
    }
    
    public function setDatum(string $datum) {
        $this->naam = $datum;
    }
}