<?php

//Business/WinkelmandService.php

namespace Business;
use Business\ProductService;
use Exceptions\MaximumPizzaException;
require_once("Business/ProductService.php");
require_once("Exceptions/MaximumPizzaException.php");

class WinkelmandService {
    public function HaalCookieOp() : array {
        if (isset($_COOKIE["cart"])) {
            $cookiecart = json_decode($_COOKIE["cart"], true);
        } else {
            $cookiecart = []; 
        }
        return $cookiecart;
    }
    
    public function getMandje(array $cookiecart = []) : array {
        $productSvc = new ProductService();
        $winkelmand = [];
        if (!$cookiecart) {
            $cookiecart = self::HaalCookieOp();
        }
        if ($cookiecart) {
            for ($i=0; $i <= max(array_keys($cookiecart)); $i++) {
                if (isset($cookiecart[$i])) {
                    $product = $productSvc->getProductById($i);
                    if ($product->getBeschikbaarheid()) {
                        $winkelmand[$i] = [$product, $cookiecart[$i]];
                    }
                }
            }
        }
        return $winkelmand;
    }
    
    public function WijzigMandje(int $id, string $bewerking = "plus") {
        $cookiecart = self::HaalCookieOp();
        switch ($bewerking) {
            case "plus":
                if (isset($cookiecart[$id])) {
                    //maximim 15 pizza's per soort
                    if ($cookiecart[$id] < 15) {
                        $cookiecart[$id] += 1; 
                    } else {
                        throw new MaximumPizzaException;
                    }
                } else {
                    $cookiecart[$id] = 1;
                }
                break;
            case "min":
                if ($cookiecart[$id] > 1) {
                    $cookiecart[$id] -= 1; 
                } else {
                    unset($cookiecart[$id]);
                }
                break;
            case "delete":
                unset($cookiecart[$id]); 
                break;
        }
        if (!empty($cookiecart)) {
            setcookie("cart", json_encode($cookiecart), time()+3600);
            return self::GetMandje($cookiecart);
        } else {
            setcookie("cart", "", 1);
            return [];
        }
    }
    
    public function getTotaalMand(float $subtotaal = 0, $korting = 0) : float {
        $winkelmand = $this->GetMandje();
        $totaal = 0;
        if ($subtotaal) {
            $totaal = $subtotaal - $korting;
        } else {
            if ($winkelmand) {
                for ($i=0; $i <= max(array_keys($winkelmand)); $i++) {
                    if (isset($winkelmand[$i])) {
                        $product = $winkelmand[$i][0];
                        $aantal = $winkelmand[$i][1];
                        $totaal += $aantal * $product->getPrijs();
                    }
                }
            }
        }
        return $totaal;
    }
}