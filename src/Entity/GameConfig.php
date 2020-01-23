<?php

namespace App\Entity;

use App\Application\Database;

class GameConfig extends Database
{

    /* ##################### VARIABLES #################### */

    /**
     * @var int 
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */   
    private $hasTeams;

    /**
     * @var bool
     */
    private $hasTeamsNames;

    /**
     * @var array
     */
    private $teams;

    /**
     * @var int
     */
    private $teamsNbr;

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
     * @var bool
     */
    private $hasCountDown;

    /**
     * @var int
     */
    private $countDownDuration;

    /**
     * @var bool
     */
    private $hasHelp;

    /**
     * @var int
     */
    private $helpDuration;

    /**
     * @var bool
     */
    private $hasDisplayCategory;

    /**
     * @var bool
     */
    private $hasRandomSongs;

    /**
     * @var int 
     */
    private $PlaylistId;

    /**
     * @var int 
     */
    private $nbQuestions;

    /**
     * @var bool
     */
    private $hasRandomCategory;

    /**
     * @var bool
     */
    private $hasMusic;

    /**
     * @var bool
     */
    private $hasMovies;

    /**
     * @var bool
     */
    private $hasCartoons;

    /**
     * @var bool
     */
    private $hasTvShows;



    /* ##################### FUNCTIONS #################### */

    /**
     * 
     */
    // public function __construct ()
    // {
               
    // }

    /**
     * Get the value of game config name
     * 
     * @return string
     */
    public function getName ()
    {
        return $this->name;
    }

    /**
     * Set the value of game config name
     * 
     * @param  string  $name
     *
     * @return  self
     */
    public function setname (string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of hasTeams
     * 
     * @return bool
     */
    public function getHasTeams ()
    {
        return $this->hasTeams;
    }

    /**
     * Set the value of hasTeams
     * 
     * @param  bool  $hasTeams
     *
     * @return  self
     */
    public function setHasTeams (bool $hasTeams)
    {
        $this->hasTeams = $hasTeams;

        return $this;
    }

    /**
     * Get the value of hasTeamsNames
     * 
     * @return bool
     */
    public function getHasTeamsNames ()
    {
        return $this->hasTeamsNames;
    }

    /**
     * Set the value of hasTeamsNames
     * 
     * @param  bool  $hasTeamsNames
     *
     * @return  self
     */
    public function setHasTeamsNames (bool $hasTeamsNames)
    {
        $this->hasTeamsNames = $hasTeamsNames; 
        return $this;
    }

    
    /**
     * Get the value of teamsNbr
     * 
     * @return bool
     */
    public function getTeamsNbr ()
    {
        return $this->teamsNbr;
    }

    
    /**
     * Get the value of teams
     * 
     * @return array
     */
    public function getTeams ()
    {
        return $this->teams;
    }
    
    /**
     * Add a team
     * 
     * @param  team  $team
     *
     * @return  self
     */
    public function addTeam (team $team)
    {
        $this->teams[$this->teamsNbr] = $team;

        $this->teamsNbr += 1;

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
     * @param  bool  $hasPlayers
     *
     * @return  self
     */
    public function setHasPlayers (bool $hasPlayers)
    {
        $this->hasPlayers = $hasPlayers;

        return $this;
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
     * Get the value of hasCountDown
     * 
     * @return bool
     */
    public function getHasCountDown ()
    {
        return $this->hasCountDown;
    }

    /**
     * Set the value of hasCountDown
     * 
     * @param  bool  $hasCountDown
     *
     * @return  self
     */
    public function setHasCountDown (bool $hasCountDown)
    {
        $this->hasCountDown = $hasCountDown;

        return $this;
    }

    
    /**
     * Get the value of countDownDuration
     * 
     * @return int
     */
    public function getCountDownDuration ()
    {
        return $this->countDownDuration;
    }

    /**
     * Set the value of countDownDuration
     * 
     * @param  bool  $countDownDuration
     *
     * @return  self
     */
    public function setCountDownDuration (bool $countDownDuration)
    {
        $this->countDownDuration = $countDownDuration;

        return $this;
    }

    
    /**
     * Get the value of hasHelp
     * 
     * @return bool
     */
    public function getHasHelp ()
    {
        return $this->hasHelp;
    }

    /**
     * Set the value of hasHelp
     * 
     * @param  bool  $hasHelp
     *
     * @return  self
     */
    public function setHasHelp (bool $hasHelp)
    {
        $this->hasHelp = $hasHelp;

        return $this;
    }

    
    /**
     * Get the value of helpDuration
     * 
     * @return int
     */
    public function getHelpDuration ()
    {
        return $this->helpDuration;
    }

    /**
     * Set the value of helpDuration
     * 
     * @param  bool  $helpDuration
     *
     * @return  self
     */
    public function setHelpDuration (bool $helpDuration)
    {
        $this->helpDuration = $helpDuration;

        return $this;
    }

    
    /**
     * Get the value of nbQuestions
     * 
     * @return int
     */
    public function getNbQuestions ()
    {
        return $this->nbQuestions;
    }

    /**
     * Set the value of nbQuestions
     * 
     * @param  bool  $nbQuestions
     *
     * @return  self
     */
    public function setNbQuestions (bool $nbQuestions)
    {
        $this->nbQuestions = $nbQuestions;

        return $this;
    }

    
    /**
     * Get the value of hasRandomSongs
     * 
     * @return int
     */
    public function getHasRandomSongs ()
    {
        return $this->hasRandomSongs;
    }

    /**
     * Set the value of hasRandomSongs
     * 
     * @param  bool  $hasRandomSongs
     *
     * @return  self
     */
    public function setHasRandomSongs (bool $hasRandomSongs)
    {
        $this->hasRandomSongs = $hasRandomSongs;

        return $this;
    }

    
    /**
     * Get the value of hasRandomCategory
     * 
     * @return int
     */
    public function getHasRandomCategory ()
    {
        return $this->hasRandomCategory;
    }

    /**
     * Set the value of hasRandomCategory
     * 
     * @param  bool  $hasRandomCategory
     *
     * @return  self
     */
    public function setHasRandomCategory (bool $hasRandomCategory)
    {
        $this->hasRandomCategory = $hasRandomCategory;

        return $this;
    }

    
    /**
     * Get the value of hasDisplayCategory
     * 
     * @return int
     */
    public function getHasDisplayCategory ()
    {
        return $this->hasDisplayCategory;
    }

    /**
     * Set the value of hasDisplayCategory
     * 
     * @param  bool  $hasDisplayCategory
     *
     * @return  self
     */
    public function setHasDisplayCategory (bool $hasDisplayCategory)
    {
        $this->hasDisplayCategory = $hasDisplayCategory;

        return $this;
    }

    
    /**
     * Get the value of hasMovies
     * 
     * @return int
     */
    public function getHasMusic ()
    {
        return $this->hasMusic;
    }

    /**
     * Set the value of hasMusic
     * 
     * @param  bool  $hasMusic
     *
     * @return  self
     */
    public function setHasMusic (bool $hasMusic)
    {
        $this->hasMusic = $hasMusic;

        return $this;
    }

    
    /**
     * Get the value of hasMusic
     * 
     * @return int
     */
    public function getHasMovies ()
    {
        return $this->hasMovies;
    }

    /**
     * Set the value of hasMovies
     * 
     * @param  bool  $hasMovies
     *
     * @return  self
     */
    public function setHasMovies (bool $hasMovies)
    {
        $this->hasMovies = $hasMovies;

        return $this;
    }

    
    /**
     * Get the value of hasCartoons
     * 
     * @return int
     */
    public function getHasCartoons ()
    {
        return $this->hasCartoons;
    }

    /**
     * Set the value of hasCartoons
     * 
     * @param  bool  $hasCartoons
     *
     * @return  self
     */
    public function setHasCartoons (bool $hasCartoons)
    {
        $this->hasCartoons = $hasCartoons;

        return $this;
    }

    
    /**
     * Get the value of hasTvShows
     * 
     * @return int
     */
    public function getHasTvShows ()
    {
        return $this->hasTvShows;
    }

    /**
     * Set the value of hasTvShows
     * 
     * @param  bool  $hasTvShows
     *
     * @return  self
     */
    public function setHasTvShows (bool $hasTvShows)
    {
        $this->hasTvShows = $hasTvShows;

        return $this;
    }



    /* ######################## SQL REQUESTS ######################## */


    /**
     * Add a game_config
     */
    public function add (string $name, bool $hasTeams, bool $hasTeamsNames, string $teamsIds, int $teamsNbr, bool $hasPlayers, int $playersNbr, string $playersIds, 
                        bool $hasCountDown, int $countDownDuration, bool $hasHelp, int $helpDuration, bool $hasDisplayCategory,
                        bool $hasRandomSongs, int $playlistId,int $nbQuestions, bool $hasRandomCategory, 
                        bool $hasMusic, bool $hasMovies, bool $hasCartoons, bool $hasTvShows) 
    { 
        // :name est un marqueur, il sera associé à la variable $name dans bindParam()
        $sql = "INSERT INTO game_config(name, has_teams, has_teams_names, teams, teams_nbr, has_players, players_nbr, players,
                    has_count_down, count_down_duration, has_help, help_duration, nbr_questions, has_random_songs, has_random_category,
                    playlist_id, has_display_category, has_music, has_movies, has_cartoons, has_tv_shows)
                VALUES (:name, :has_teams, :has_teams_names, :teams, :teams_nbr, :has_players, :players_nbr, :players,
                    :has_count_down, :count_down_duration, :has_help, :help_duration, :nb_questions, :has_random_songs, :has_random_category,
                    :playlist_id, :has_display_category, :has_music, :has_movies, :has_cartoons, :has_Tv_shows)";
   
    //  echo 'config has teams : ';
    //    var_dump($hasTeams);
     /*   $sql = "INSERT INTO game_config(name, has_teams)
                     VALUES (:name, :has_teams)";
        */
        $this->prepare($sql);
        $this->bindParam(':name', $name, \PDO::PARAM_STR);
        $this->bindParam(':has_teams', $hasTeams, \PDO::PARAM_INT);
        $this->bindParam(':has_teams_names', $hasTeamsNames, \PDO::PARAM_INT);
        $this->bindParam(':teams', $teamsIds, \PDO::PARAM_STR);
        $this->bindParam(':teams_nbr', $teamsNbr, \PDO::PARAM_INT);
        $this->bindParam(':has_players', $hasPlayers, \PDO::PARAM_INT);
        $this->bindParam(':players_nbr', $playersNbr, \PDO::PARAM_INT);
        $this->bindParam(':players', $playersIds, \PDO::PARAM_STR);
        $this->bindParam(':has_count_down', $hasCountDown, \PDO::PARAM_INT);
        $this->bindParam(':count_down_duration', $countDownDuration, \PDO::PARAM_INT);
        $this->bindParam(':has_help', $hasHelp, \PDO::PARAM_INT);
        $this->bindParam(':help_duration', $helpDuration, \PDO::PARAM_INT);
        $this->bindParam(':nb_questions', $nbQuestions, \PDO::PARAM_INT);
        $this->bindParam(':has_random_songs', $hasRandomSongs, \PDO::PARAM_INT);
        $this->bindParam(':playlist_id', $playlistId, \PDO::PARAM_INT);
        $this->bindParam(':has_random_category', $hasRandomCategory, \PDO::PARAM_INT);
        $this->bindParam(':has_display_category', $hasDisplayCategory, \PDO::PARAM_INT);
        $this->bindParam(':has_music', $hasMusic, \PDO::PARAM_INT);
        $this->bindParam(':has_movies', $hasMovies, \PDO::PARAM_INT);
        $this->bindParam(':has_cartoons', $hasCartoons, \PDO::PARAM_INT);
        $this->bindParam(':has_Tv_shows', $hasTvShows, \PDO::PARAM_INT);

       return $this->execute();
    }


    /**
     * Get one game config by name
     * 
     * @param string $name
     * 
     * @return array
     */
    public function getByName (string $name)
    {
        $sql = "SELECT * FROM game_config
                WHERE name=:name";

        $this->prepare($sql);
        $this->bindParam(':name', $name, \PDO::PARAM_INT);
        $this->execute();

        return $this->fetch();
    }

    /**
     * Get all game configs 
     * 
     * @return array
     */
    public function getAll ()
    {
        $sql = "SELECT * FROM game_config";

        $this->prepare($sql);
        $this->execute();

        return $this->fetchAll();
    }


    /**
     * Delete a game config
     * 
     * @param int $id 
     */
    public function deleteOne (int $id)
    {
        $sql = "DELETE FROM game_config
                WHERE id=:id";
        $this->prepare($sql);
        $this->bindParam(':id', $id, \PDO::PARAM_INT);
        $this->execute();
    }


    /*
    hasTeams
    hasTeamsNames
    teams
    teamsNbr
    hasPlayers
    playersNbr
    players
    hasCountDown
    countDownDuration
    hasHelp
    helpDuration
    nbQuestions
    hasRandomCategory
    hasDisplayCategory
    hasMusic
    hasMovies
    hasCartoons
    hasTvShows
    */

}