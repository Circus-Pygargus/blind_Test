<?php

namespace App\Entity;

use App\Application\Database;

class Player extends Database
{

    /* ################### VARIABLES ################# */


    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $color;

    /**
     * @var int
     */
    private $score;


    /**
     * @var bool
     */
    private $hasTeam;

    /**
     * @var int
     */
    private $teamId;

    /**
     * @var string
     */
    private $teamName;



    /* ################## getters and setters ################ */



    /**
     * Get the value of id
     * 
     * @return int
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * Set the vaue of id
     * 
     * @param  int  $id
     *
     * @return  self
     */
    public function setId (int $id)
    {
        $this->id = $id;

        return $this;
    }


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
     * Set tyhe value of color
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
     * Get the value of score
     * 
     * @return int
     */
    public function getScore ()
    {
        return $this->score;
    }

    /**
     * Set the vaue of color
     * 
     * @param  int  $score
     *
     * @return  self
     */
    public function setScore (int $score)
    {
        $this->color = $score;
    }


    /**
     * Get the value of hasTeam
     * 
     * @return bool
     */
    public function getHasTeam ()
    {
        return $this->hasTeam;
    }

    /**
     * Set the value of hasTeam
     * 
     * @param  bool  $hasTeams
     *
     * @return  self
     */
    public function setHasTeam (bool $hasTeam)
    {
        $this->hasTeam = $hasTeam;

        return $this;
    }


    /**
     * Get the value of teamId
     * 
     * @return int
     */
    public function getTeamId ()
    {
        return $this->score;
    }

    /**
     * Set the vaue of color
     * 
     * @param  int  $teamId
     *
     * @return  self
     */
    public function setTeamId (int $teamId)
    {
        $this->color = $teamId;
    }



    /**
     * Get the value of teamName
     * 
     * @return string
     */
    public function getTeamName ()
    {
        return $this->teamName;
    }

    /**
     * Set the value of teamName
     * 
     * @param  string  $designation
     *
     * @return  self
     */
    public function setTeamName (string $teamName)
    {
        $this->teamName = $teamName;

        return $this;
    }



    /* #################### SQL ##################### */


    /**
     * Add a player
     */
    public function add (string $name, string $color, int $score, bool $hasTeam, string $teamName)
    {
        echo 'player has team : ';
        var_dump($hasTeam);
      
        $sql = "INSERT INTO players(name, color, score, team_name, has_team  )
                VALUES (:name, :color, :score, :team_name, :has_team )";
        $this->prepare($sql);
        $this->bindParam(':name', $name, \PDO::PARAM_STR);
        $this->bindParam(':color', $color, \PDO::PARAM_STR);
        $this->bindParam(':score', $score, \PDO::PARAM_INT);
        $this->bindParam(':has_team', $hasTeam, \PDO::PARAM_INT);
        $this->bindParam(':team_name', $teamName, \PDO::PARAM_STR);
        return $this->execute();
    }

    /**
     * Get player id with name
     * 
     * @param string $name
     * 
     * @return int 
     */
    public function getDbIdWithName (string $name) 
    {
        
    
        $sql = "SELECT id FROM players WHERE name=:name";
         $this->prepare($sql);
         $this->bindParam(':name', $name, \PDO::PARAM_STR);
         $this->execute();
         return $this->fetch();
    }


    /**
     * Edit score for this player
     * 
     * @param int $id
     * @param int $score
     */
    public function editScore (int $id, int $score)
    {
        $sql = "UPDATE players
            SET score=:score
            WHERE id=:id";

        $this->prepare($sql);
        $this->bindParam(':id', $id, \PDO::PARAM_INT);
        $this->bindParam(':score', $score, \PDO::PARAM_INT);
        $this->execute();
    }


    /**
     * Get one player
     * 
     * @param int $id
     * 
     * @return array
     */
    public function getOne (int $id)
    {
        $sql = "SELECT * FROM players
                WHERE id=:id";
        
        $this->prepare($sql);
        $this->bindParam(':id', $id, \PDO::PARAM_INT);
        $this->execute();

        return $this->fetch();
    }


    /**
     * Get all players for this game
     * 
     * @return array
     */
    public function getAll ()
    {
        $sql = "SELECT * FROM players";

        $this->prepare($sql);
        $this->execute();
        
        return $this->fetchAll();
    }


    /**
     * Delete all players from the last game
     */
    public function deleteAll ()
    {
        $sql = "DELETE * from players";

        $this->prepare($sql);
        $this->execute();
    }

    // /**
    //  * Get the player team id in db
    //  * 
    //  * @param int $Id
    //  * 
    //  * @return int
    //  */
    // public function getDbTeamId ($id)
    // {
    //     $sql = "SELECT team_id from players
    //             WHERE id=:id";
        
    //     $this->prepare($sql);
    //     $this->bindParam(':id', $id, \PDO::PARAM_INT);
    //     $this->execute();

    //     return $this->fetch();
    // }

    /**
     * Set the player team id in db
     * 
     * @param int $teamId
     * @param int $playerId
     */
    public function setDbTeamId ($teamId, $playerId)
    {
        $sql = "UPDATE players 
                SET team_id = :team_id

                WHERE id = :player_id";
        
        $this->prepare($sql);
        $this->bindParam(':player_id', $playerId, \PDO::PARAM_INT);
        $this->bindParam(':team_id', $teamId, \PDO::PARAM_INT);
        $this->execute();

        //return $this->fetch();
    }
}