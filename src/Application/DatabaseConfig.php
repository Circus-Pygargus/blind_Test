<?php

namespace App\Application;

use Dotenv\Dotenv;

class DatabaseConfig {

    /**
     * @var PDO
     */
    public $db;


    private function config () {
        // chargement de phpdotenv
        $dotenv = \Dotenv\Dotenv::create($_SERVER["DOCUMENT_ROOT"] . "/src");
        $dotenv->load();
        

        try {
            // un \ devant PDO car PDO() n'appartient pas à mon espace de nom
            $this->db = new \PDO('mysql:host=' . getenv('HOSTNAME') . ';dbname=' . getenv('DBNAME'), getenv('USER'), getenv('PASSWORD'), [\PDO::ATTR_EMULATE_PREPARES=>false]);
            
        } 
        catch (exception $e) {
            die('erreur : ' . $e->get->message());
        }
    }


    public function connect () {

        $this->config();
    }
}