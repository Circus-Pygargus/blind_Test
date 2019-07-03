<?php

namespace App\Controller;

use App\Application\Controller;



class PlayController extends Controller 
{
    // __construct function herited from Controller


    public function index() {

        return $this->twig->render('play.html');
    }
}