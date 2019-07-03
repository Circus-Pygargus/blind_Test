<?php

namespace App\Controller;

use App\Application\Controller;


class ProduitsController extends Controller {

    // la fonction __construct est directement héritée de la classe mère


    function index () {
        
        return $this->twig->render('produits/produits.html.twig');
    }
}