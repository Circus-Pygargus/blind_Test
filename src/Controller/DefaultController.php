<?php 

namespace App\Controller;

use App\Application\Controller;
use App\Application\DatabaseConfig;

/* on pourrait écrire :
    use App\Application\Controller as lol;
    puis class DefaultController extends lol 
*/


class DefaultController extends Controller {

    // la fonction __construct est directement héritée de la classe mère


    function index () {
        return $this->twig->render('index.html.twig');
    }

    function about () {
        return $this->twig->render('about.html.twig');
    }

    function contact () {
        return $this->twig->render('contact.html.twig');
    }
}