<?php

namespace App\Controller;

use App\Application\Controller;



class TestController extends Controller 
{
    // __construct function herited from Controller


    public function admin() {

        return $this->twig->render('page2_admin.html');
    }

    public function main() {

        return $this->twig->render('page1_main.html');
    }
}