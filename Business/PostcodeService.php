<?php

//Business/PostcodeService.php

namespace Business;

use Data\PostcodeDAO;
require_once("Data/PostcodeDAO.php");

class PostcodeService {
    public function getPostcodeOverzicht() {
        $postcodeDAO = new PostcodeDAO();
        $lijst = $postcodeDAO->getAll();
        return $lijst;
    }
    
    public function controleerPostcode(int $postcode) {
        /* controleert of geleverd wordt op de gevraagde postcode */
        $lijst = $this->getPostcodeOverzicht();
        $levering = false;
        foreach ($lijst as $gemeente) {
            if ($gemeente->getPostcode() == $postcode) {
                $levering = true;
            }
        }
        return $levering;
    }
    
    public function getPostcodeTekst() : string {
        /* returns een lijst van het leveringsgebied als string: postcode (gemeente) */
        $array = [];
        $lijst = $this->getPostcodeOverzicht();
        foreach ($lijst as $gemeente) {
            $array[] = $gemeente->getPostcode() . " (" . $gemeente->getGemeente() . ")";
        }
        $leveringsgebied = implode(", ", $array);
        return $leveringsgebied;
    }
}