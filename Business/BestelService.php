<?php

//Business/BestelService.php

namespace Business;

use Data\BestellingDAO;
use Data\BestelLijnDAO;
require_once("Data/BestellingDAO.php");
require_once("Data/BestelLijnDAO.php");

class BestelService {
    public function createBestelling(int $klantid, array $winkelmand, float $prijs, float $korting) {
        $bestellingDAO = new BestellingDAO;
        $bestelling = $bestellingDAO->create($klantid, $prijs, $korting);
        $bestelid = $bestelling->getId();
        
        for ($i=1; $i <= max(array_keys($winkelmand)); $i++) {
            if (isset($winkelmand[$i])) {
                $product = $winkelmand[$i][0];
                $aantal = $winkelmand[$i][1];
                for ($j=1; $j <= $aantal; $j++) {
                    $this->createBestelLijn($bestelid, $product->getId());
                }
            }
        }
    }
    
    public function createBestelLijn(int $bestelid, int $productid) {
        $bestelLijnDAO = new BestelLijnDAO;
        $bestelLijnDAO->create($bestelid, $productid);
    }
}