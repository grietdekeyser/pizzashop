<?php 

//Entities/Product.php

namespace Entities;

class Product {
    private static $idMap = array();

    private $id;
    private $naam;
    private $samenstelling;
    private $prijs;
    private $beschikbaarheid;
    private $afbeelding;

    private function __construct(int $id, string $naam, string $samenstelling, float $prijs, bool $beschikbaarheid, string $afbeelding) {
        $this->id = $id;
        $this->naam = $naam;
        $this->samenstelling = $samenstelling;
        $this->prijs = $prijs;
        $this->beschikbaarheid = $beschikbaarheid;
        $this->afbeelding = $afbeelding;
    }
    
    public static function create(int $id, string $naam, string $samenstelling, float $prijs, bool $beschikbaarheid, string $afbeelding) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Product($id, $naam, $samenstelling, $prijs, $beschikbaarheid, $afbeelding);
        }
        return self::$idMap[$id];
    }

    public function getId() : int {
        return $this->id;
    }

    public function getNaam() : string {
        return $this->naam;
    }

    public function getSamenstelling() : string {
        return $this->samenstelling;
    }

    public function getPrijs() : float {
        return $this->prijs;
    }

    public function getBeschikbaarheid() : bool {
        return $this->beschikbaarheid;
    }
    
    public function getAfbeelding() : string {
        return $this->afbeelding;
    }

    public function setNaam(string $naam) {
        $this->naam = $naam;
    }

    public function setSamenstelling(string $samenstelling) {
        $this->samenstelling = $samenstelling;
    }

    public function setPrijs(float $prijs) {
        $this->prijs = $prijs;
    }

    public function setBeschikbaarheid(bool $beschikbaarheid) {
        $this->beschikbaarheid = $beschikbaarheid;
    }
    
    public function setAfbeelding(bool $afbeelding) {
        $this->afbeelding = $afbeelding;
    }
}