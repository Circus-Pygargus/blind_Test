<?php 

namespace App\Entity;

use App\Application\Database;


class Playlist extends Database 
{

    /* ############# VARIABLES ############## */

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $songs;




    /* ################ METHODS ################ */

    /**
     * Add a team
     */
    public function add (string $name, string $songs) 
    {
        // :name est un marqueur, il sera associé à la variable $name dans bindParam()
        $sql = "INSERT INTO teams(name, songs)
                VALUES (:name, :songs)";

        $this->prepare($sql);
        $this->bindParam(':name', $name, \PDO::PARAM_STR);
        $this->bindParam(':songs', $songs, \PDO::PARAM_STR);
        return $this->execute();
    }


    /**
     * Get one playlist by name
     * 
     * @param string $name
     * 
     * @return array
     */
    public function getOneByName (string $name)
    {
        $sql = "SELECT * FROM playlist
                WHERE name=:name";
        
        $this->prepare($sql);
        $this->bindParam(':name', $name, \PDO::PARAM_STR);
        $this->execute();

        return $this->fetch();
    }

    /**
     * Get all playlists for this game
     * 
     * @return array
     */
    public function getAll ()
    {
        $sql = "SELECT * FROM playlist";

        $this->prepare($sql);
        $this->execute();

        return $this->fetchAll();
    }

    /**
     * Get all playlists names and ids for this game
     * 
     * @return array
     */
    public function getAllNames ()
    {
        $sql = "SELECT name, id FROM playlist";

        $this->prepare($sql);
        $this->execute();

        return $this->fetchAll();
    }

    /**
     * Get the value of songs with id
     * 
     * @param int $id
     * 
     * @return string
     */
    public function getSongs ($id)
    {
        $sql = "SELECT songs FROM playlist
                WHERE id=:id";
        $this->prepare($sql);
        $this->bindParam(':id', $id, \PDO::PARAM_INT);
        $this->execute();

        return $this->fetch();
    }







}