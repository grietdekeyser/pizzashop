<?php

//Business/GastenboekService.php

namespace Business;

use Data\GastenboekDAO;
require_once("Data/GastenboekDAO.php");

class GastenboekService {
    public function getAll() {
        $gastenboekDAO = new GastenboekDAO();
        $lijst = $gastenboekDAO->getAll();
        return $lijst;
    }
    
    public function getVijftigBerichten() {
        $gastenboekDAO = new GastenboekDAO();
        $lijst = $gastenboekDAO->getVijftig();
        return $lijst;
    }
    
    public function getTienBerichten() {
        $gastenboekDAO = new GastenboekDAO();
        $lijst = $gastenboekDAO->getTien();
        return $lijst;
    }
    
    public function createBericht(int $klantid, string $naam, string $bericht) {
        $gastenboekDAO = new GastenboekDAO;
        $gastenboekDAO->create($klantid, $naam, $bericht);
    }
    
    public function valideerBericht(string $bericht) {
        $errors = [];
        if (empty($bericht)) {
            $errors[] = "emptybericht";
        } elseif (strlen($bericht) > 150) {
            $errors[] = "telang";
        }
        return $errors;
    }
}