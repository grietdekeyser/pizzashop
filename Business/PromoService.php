<?php

//Business/PromoService.php

namespace Business;

use Entities\Klant;
use Business\ProductService;
use Business\WinkelmandService;
require_once("Entities/Klant.php");
require_once("Business/ProductService.php");
require_once("Business/WinkelmandService.php");

class PromoService {
    public function rechtOpPromo(Klant $klant) {
        /* overloopt de actieve kortingen en returnt hoogste korting of 0 indien geen korting */
        $winkelmandSvc = new winkelmandService();
        $subtotaal = $winkelmandSvc->getTotaalMand();
        
        //kortingen toevoegen aan array
        $kortingen[] = $this->getrouwheidPromo($klant, $subtotaal);
        $kortingen[] = $this->meiPromo($subtotaal);

        //niet culumeerbaar: hoogste korting geldig
        $korting = max($kortingen);
        return $korting;
    }
    
    public function getrouwheidPromo(Klant $klant, float $subtotaal) : float{
        /* indien meer dan 1 jaar klant, 10% korting */
        $registratie = explode(" ", $klant->getRegistratiedatum());
        $jaargeleden = date("Y-m-d", strtotime("-1 year"));
        if ($registratie[0] < $jaargeleden) {
            return $subtotaal * 0.1;
        } else {
            return 0;
        }
    }
    
    public function meiPromo(float $subtotaal) : int {
        /* 5 euro korting bij bestelling vanaf 40 euro */
        if ($subtotaal >= 40) {
            return 5;
        } else {
            return 0;
        }
    }
}
