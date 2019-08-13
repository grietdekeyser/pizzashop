<?php

//Business/ProductService.php

namespace Business;

use Data\ProductDAO;
require_once("Data/ProductDAO.php");

class ProductService {
    public function getProductOverzicht() {
        $productDAO = new ProductDAO();
        $lijst = $productDAO->getAll();
        return $lijst;
    }
    
    public function getBeschikbaarOverzicht() {
        $productDAO = new ProductDAO();
        $lijst = $productDAO->getBeschikbareProducten();
        return $lijst;
    }
    
    public function getProductById(int $id) {
        $productDAO = new ProductDAO();
        $product = $productDAO->getById($id);
        return $product;
    }
}