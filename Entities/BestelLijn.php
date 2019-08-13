<?php 

//Entities/BestelLijn.php

namespace Entities;

class BestelLijn {
    private static $idMap = array();

    private $id;
    private $bestelid;
    private $productid;

    private function __construct(int $id, int $bestelid, int $productid) {
        $this->id = $id;
        $this->bestelid = $bestelid;
        $this->productid = $productid;
    }
    
    public static function create(int $id, int $bestelid, int $productid) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new BestelLijn($id, $bestelid, $productid);
        }
        return self::$idMap[$id];
    }

    public function getId() : int {
        return $this->id;
    }

    public function getBestelid() : int {
        return $this->bestelid;
    }

    public function getProductid() : int {
        return $this->productid;
    }

    public function setBestelid(int $bestelid) {
        $this->bestelid = $bestelid;
    }

    public function setProductid(int $productid) {
        $this->productid = $productid;
    }
}