<?php

namespace App\Entity;

use App\Application\Database;


class Team extends Database
{

    /* ############# VARIABLES ############## */

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $color;

    /**
     * @var bool
     */
    private $hasPlayers;

    /**
     * @var int
     */
    private $playersNbr;

    /**
     * @var array
     */
    private $players;

    /**
     * @var int
     */
    private $score;




    /* ################ METHODS ################ */


    /**
     * Get the value of name
     * 
     * @return string
     */
    public function getName ()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     * 
     * @param  string  $name
     *
     * @return  self
     */
    public function setName (string $name)
    {
        $this->name = $name;

        return $this;
    }


    /**
     * Get the value of color
     * 
     * @return string
     */
    public function getColor ()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     * 
     * @param  string  $color
     *
     * @return  self
     */
    public function setColor (string $color)
    {
        $this->color = $color;

        return $this;
    }


    /**
     * Get the value of hasPlayers
     * 
     * @return bool
     */
    public function getHasPlayers ()
    {
        return $this->hasPlayers;
    }

    /**
     * Set the value of hasPlayers
     * 
     * @param bool
     * 
     * @return self
     */
    public function setHasPlayers (bool $hasPlayers)
    {
        $this->hasPlayers = $hasPlayers;

        return self;
    }




    /**
     * Get the value of playersNbr
     * 
     * @return int
     */
    public function getPlayersNbr ()
    {
        return $this->playersNbr;
    }


    /**
     * Get the value of players
     * 
     * @return array
     */
    public function getPlayers ()
    {
        return $this->players;
    }


    /**
     * Add a player
     * 
     * @param  player  $player
     *
     * @return  self
     */
    public function addPlayer (player $player)
    {
        $this->players[$this->playersNbr] = $player;

        $this->playersNbr += 1;

        return $this;
    }


    /**
     * Get the value of score
     * 
     * @return int
     */
    public function getScore ()
    {
        return $this->score;
    }
    
    
    /**
     * Set the value of score
     * 
     * @return array
     */
    public function setScore ()
    {
        return $this->score;
    }



    /* ##################### SQL ##################### */


    /**
     * Add a team
     */
    public function add (string $name, string $color, bool $hasPlayers, int $playersNbr, string $playersIds, int $score) 
    {
        // :name est un marqueur, il sera associé à la variable $name dans bindParam()
        $sql = "INSERT INTO teams(name, color, has_players, players_nbr, players_ids, score)
                VALUES (:name, :color, :has_players, :players_nbr, :players_ids, :score)";

        $this->prepare($sql);
        $this->bindParam(':name', $name, \PDO::PARAM_STR);
        $this->bindParam(':color', $color, \PDO::PARAM_STR);
        $this->bindParam(':has_players', $hasPlayers, \PDO::PARAM_INT);
        $this->bindParam(':players_nbr', $playersNbr, \PDO::PARAM_INT);
        $this->bindParam(':players_ids', $playersIds, \PDO::PARAM_STR);
        $this->bindParam(':score', $score, \PDO::PARAM_INT);
        return $this->execute();
    }

    /**
     * Get team id with name
     * 
     * @param string $name
     * 
     * @return int 
     */
    public function getDbIdWithName (string $name) 
    {
        $sql = "SELECT id FROM teams
                WHERE name=:name";
        $this->prepare($sql);
        $this->bindParam(':name', $name, \PDO::PARAM_STR);
        $this->execute();
        return $this->fetch();
    }


    /**
     * Edit score for this team
     * 
     * @param int $id
     * @param int $score
     */
    public function editScore (int $id, int $score)
    {
        $sql = "UPDATE teams
                SET score=:score
                WHERE id=:id";

        $this->prepare($sql);
        $this->bindParam(':id', $id, \PDO::PARAM_INT);
        $this->bindParam(':score', $score, \PDO::PARAM_INT);
        $this->execute();
    }


    /**
     * Get one team by id
     * 
     * @param int $id
     * 
     * @return array
     */
    public function getById (int $id)
    {
        $sql = "SELECT * FROM teams
                WHERE id=:id";
        
        $this->prepare($sql);
        $this->bindParam(':id', $id, \PDO::PARAM_INT);
        $this->execute();

        return $this->fetch();
    }


    /**
     * Get one team by name
     * 
     * @param string $name
     * 
     * @return array
     */
    public function getByName (string $name)
    {
        $sql = "SELECT * FROM teams
                WHERE name=:name";
        
        $this->prepare($sql);
        $this->bindParam(':name', $name, \PDO::PARAM_STR);
        $this->execute();

        return $this->fetch();
    }

    /**
     * Get all teams for this game
     * 
     * @return array
     */
    public function getAll ()
    {
        $sql = "SELECT * FROM teams";

        $this->prepare($sql);
        $this->execute();

        return $this->fetchAll();
    }


    /**
     * Delete a team
     * 
     * @param int $id 
     */
    public function deleteOne (int $id)
    {
        $sql = "DELETE FROM teams
                WHERE id=:id";
        $this->prepare($sql);
        $this->bindParam(':id', $id, \PDO::PARAM_INT);
        $this->execute();
    }

    /**
     * Delete all teams from the last game
     */
    public function deleteAll ()
    {
        $sql = "DELETE * FROM teams";
        $this->prepare($sql);
        $this ->execute();
    }

    
}