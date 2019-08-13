<?php 

//Entities/Postcode.php

namespace Entities;

class Postcode {
    private static $idMap = array();

    private $id;
    private $postcode;
    private $gemeente;

    private function __construct(int $id, string $postcode, string $gemeente) {
        $this->id = $id;
        $this->postcode = $postcode;
        $this->gemeente = $gemeente;
    }
    
    public static function create(int $id, string $postcode, string $gemeente) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Postcode($id, $postcode, $gemeente);
        }
        return self::$idMap[$id];
    }

    public function getId() : int {
        return $this->id;
    }

    public function getPostcode() : string {
        return $this->postcode;
    }

    public function getGemeente() : string {
        return $this->gemeente;
    }

    public function setPostcode(string $postcode) {
        $this->postcode = $postcode;
    }

    public function setGemeente(string $gemeente) {
        $this->gemeente = $gemeente;
    }
}