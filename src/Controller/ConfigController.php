<?php 

namespace App\Controller;

use App\Application\Controller;

use App\Entity\GameConfig;
use App\Entity\Team;
use App\Entity\Player;
use App\Entity\Playlist;


class ConfigController extends Controller {

    // __construc function heritated from super class

    // load configuration page
    public function index () {

        return $this->twig->render('config.html.twig');
    }



    // asking for playlists names
    public function playlists () {

        $objPlaylist = new Playlist();
        $playlists = $objPlaylist->getAllNames();
      //  var_dump($playlists);
        // send list of playlists to config.html.twig
        echo json_encode($playlists);
    }



    // test json received from config page
    public function json () {
                
        // ici c'est une affectation de vairiable sous condition
        // si la partie à gauche du ? est vraie, on affecte le contenu, sinon (:) $contentType=''

                                    // gaffe ici CONTENT_TYPE avec un _ mais avec un - coté php
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        //var_dump($contentType); // doit retourner string(16) "application/json" (dans l'inspecteur : network puis addProject-json.php)


        if ($contentType === "Application/json") {
            $content = trim(file_get_contents("php://input"));
            //var_dump($content); // doit retourner string(35) "{"projet":"syrjh","techno":"srtjh"}" (dans l'inspecteur : network puis addProject-json.php)
            // $json = utf8_encode($json); // not needed this time ;)
            $decoded = json_decode($content, true);
            //var_dump($decoded); // renvoie une array ! array(2) {["projet"]=>string(3) "srg"  ["techno"]=> string(5) "qregh"}
            $this->checkConfig($decoded);
        }
    }


    // check the inputs values and answer to ajax request
    private function checkConfig (array $config)
    {


// $db = new \PDO('mysql:host=localhost;dbname=blind_test', 'root', 'online@2017');

// var_dump($db);

// $sth = $db->prepare("INSERT INTO players(name, color, score, has_team, team_name)
// VALUES ('kujh', 'ohjo', 0, true, 'dsrg')");

// var_dump($sth);

// $sth->execute();

        // NEED TO MAKE TESTS WITH REGEX ON $CONFIG BEFORE SENDING BACK THE OK RESPONSE
        $response = array('reponse' => 'ok', 'message' => 'Lancement du jeu ...');
        //var_dump($response);
        //var_dump(json_encode($response));

        // retour de reponse de la requete ajax de la page config
        echo json_encode($response);
        $this->storeConfig($config);
    }

    // Save Teams, Players and GameConfig in db
    private function storeConfig (array $config)
    {
       // var_dump($config);
      //  echo 'enfin_fini';
        $gameConfig = new GameConfig();

        $teamsNbr = 0;
        $teamsIds = "noTeams";
        $totalPlayersNbr = 0;
        $totalPlayersIds = "noPlayers";
        $playersNbr = 0;
        $playersIds = "noPlayers";

        // first teams and players
        if ($config['hasTeams']) {
            
            $firstTeamFirstPlayerSeen = false;

            $teamsNbr = count($config['teams']);
            for ($i = 0; $i < $teamsNbr; $i++) {

                $team = new Team();

                if ($config['hasTeamsNames']) {
                    $team->setName($config['teams']['team_' . $i]['teamName']);
                }
                else {
                    $team->setName("_default_" . $i);
    
                    $config['teams']['team_' . $i]['teamName'] = "_default_" . $i;
                }
  //var_dump($team->getName());
                $team->setColor($config['teams']['team_' . $i]['teamColor']);
                $team->setScore(0);

                // we have to create it even if no use
            //    $players = "noPlayers";
                $playersNbr = 0;
// echo 'has___Players___points : ';
// var_dump($config['hasPlayersPoints']);
                // we have players too
                if ($config['hasPlayersPoints']) {

                    $playersNbr = count($config['teams']['team_' . $i]['players']);
                    $totalPlayersNbr += $playersNbr;
                    //var_dump($playersNbr);
                    for ($j = 0; $j < $playersNbr; $j++) {

                        $player = new Player();

                    //    $playersNbr++;

                        // add in db
                        $test = $player->add($config['teams']['team_' . $i]['players']['player_' . $j],
                                    $config['teams']['team_' . $i]['teamColor'],
                                    0,
                                    true,
                                    $team->getName() 
                        );
                        if ($test) {
                            // commented because interact with a json response
                            //echo 'ok player enregistré';
                        }
                        else { 
                            echo 'enregistrement player en bdd raté';
                        }

                        $reponse = $player->getDbIdWithName($config['teams']['team_' . $i]['players']['player_' . $j]);
                        $player->setId($reponse['id']);
    
            //     var_dump($player->getId());
                        // in team db, each player id will be separated by an underscore 
                        if ($i === 0 && $j === 0) {
                            $totalPlayersIds = $player->getId();
                            $playersIds = $player->getId();
                        }
                        else if ($j === 0 && $firstTeamFirstPlayerSeen) {
       //                     var_dump($player->getId());
                            $playersIds = $player->getId();
                            $totalPlayersIds .= '_' . $player->getId();
                        }
                        else {
                            $playersIds .= '_' . $player->getId();
                            $totalPlayersIds .= '_' . $player->getId();
                        }
                       // echo $playersIds;
                    //  echo $totalPlayersIds;
                    }
                }


        /*        var_dump($team->getName());
                var_dump($team->getColor());
                var_dump($config['hasPlayersPoints']);
                var_dump($playersNbr);
                var_dump($playersIds);
                var_dump(0);
           */
            

                // Save team in db
            $test =    $team->add( $team->getName(),
                            $team->getColor(),
                            $config['hasPlayersPoints'],
                            $playersNbr,
                            $playersIds,
                            0);
                            
            if ($test) {
                // interacts with a json response
                //echo 'ok team enregistrée';
            }
            else { echo 'enregistrement team en bdd raté';}
  //  var_dump($team->getName());
                // get the db team id
                $teamId = $team->getDbIdWithName($team->getName());
            //    var_dump($team->getName());

                // in game-config db, each team id will be separated by an underscore 
                if ($i === 0) {
                    $firstTeamFirstPlayerSeen = true;
                    $teamsIds = $teamId['id'];
                }
                else {
                    $teamsIds .= '_' . $teamId['id'];
                }
            //    var_dump($teamsIds);
            //    var_dump($i);

                // we need the teamId in Players db's table
                $playersIdsArray = explode('_', $playersIds);
              //  var_dump($playersIdsArray);
                for ($k = 0; $k < count($playersIdsArray); $k++) {
                    $player = new Player();
                    $player->setDbTeamId($teamId['id'] , $playersIdsArray[$k]);
                }
            }
        }
        //no teams
        else {
            // no team but players            
            $config['hasTeamsNames'] = false;
            if ($config['hasPlayersPoints']) {// we have players too

                $totalPlayersNbr = count($config['teams']['team_0']['players']);
//echo 'nbr joueurs no teams : ';
 //var_dump($totalPlayersNbr);

  //var_dump($config['teams']['team_0']['players']);
                for ($i = 0; $i < $totalPlayersNbr; $i++) {
                   // var_dump($i);
                    $player = new Player();

                    // add in db
                    
                   $test = $player->add($config['teams']['team_0']['players']['player_' . $i],
                               $config['teams']['team_0']['teamColor'],
                               0,
                               false,
                               "_default_" );  

                   if ($test) {
                       echo 'ok player enregistré';}
                   else { 
                       echo 'enregistrement player en bdd raté';
                   }
            //       echo $i. " - ".$config['teams']['team_0']['players']['player_' . $i];
                   $reponse = $player->getDbIdWithName($config['teams']['team_0']['players']['player_' . $i]);
             //      echo $i. " - ".$reponse['id'];
                   $player->setId($reponse['id']);

                    // in team db, each player id will be separated by an underscore 
                   if ($i === 0) {
                        $totalPlayersIds = $player->getId();
                    }  
                    else {
                        $totalPlayersIds .= '_' . $player->getId();
                    }
                   // echo 'joueurs no teams details :';
                   // var_dump($totalPlayersIds);
                  
                }

                    
            }
        }
        
        $countDownDuration = 0;
        if ($config['hasCountDown']) { 
            $countDownDuration = $config['countDownDuration'];
        }

        $helpDuration = 0;
        if ($config['hasHelp']) {
            $helpDuration = $config['helpDuration'];
        }    
        
        // if false then we use a playlist
        if ($config['hasRandomSongs']) {
            $config['playlistId'] = 0;
        }
        else {
            $objPlaylist = new Playlist();
            $dbNbrQuestions = $objPlaylist->getSongs($config['playlistId']);
            $arrayNbrQuestions = explode('_', $dbNbrQuestions['songs']);
            $nbrQuestions = count($arrayNbrQuestions);
            $config['nbQuestions'] = $nbrQuestions;
            $config['hasRandomCategory'] = false;
            $config['hasMusic'] = false;
            $config['hasMovies'] = false;
            $config['hasCartoons'] = false;
            $config['hasTvShows'] = false;
        }
    /*    var_dump($config['name'], 
        $config['hasTeams'], 
        $config['hasTeamsNames'], 
        $teamsIds,
        $teamsNbr,
        $config['hasPlayersPoints'],
        $totalPlayersNbr, 
        $totalPlayersIds,
        $config['hasCountDown'],
        $countDownDuration,
        $config['hasHelp'],
        $helpDuration,
        $config['hasRandomSongs'],
        $config['nbQuestions'],
        $config['hasRandomCategory'],
        $config['hasDisplayCategory'],
        $config['hasMusic'],
        $config['hasMovies'], 
        $config['hasCartoons'], 
        $config['hasTvShows']);
        */
      $test =   $gameConfig->add(   $config['name'], 
                            $config['hasTeams'], 
                            $config['hasTeamsNames'], 
                            $teamsIds,
                            $teamsNbr,
                            $config['hasPlayersPoints'],
                            $totalPlayersNbr, 
                            $totalPlayersIds,
                            $config['hasCountDown'],
                            $countDownDuration,
                            $config['hasHelp'],
                            $helpDuration,
                            $config['hasDisplayCategory'],
                            $config['hasRandomSongs'],
                            $config['playlistId'],
                            $config['nbQuestions'],
                            $config['hasRandomCategory'],
                            $config['hasMusic'],
                            $config['hasMovies'], 
                            $config['hasCartoons'], 
                            $config['hasTvShows'] );
        if ($test) {
            // commented because interact with json response
            // echo 'ok player enregistré';

            // the game is launched from controller 
        }
        else { 
            echo 'enregistrement player en bdd raté';
        }
    
        // commented because interact with json response
        // echo 'game configuration saved in db !';  
    
    

 //   var_dump($gameConfig->getByName('next'));  
    /*    $gameConfig->setHasTeams($config['hasTeams']);
        $gameConfig->setHasTeamsNames($config['hasTeamsNames']);
        $gameConfig->setHasPlayers($config['hasPlayersPoints']);    

        $gameConfig->setHasCountDown($config['hasCountDown']);
        if ($gameConfig->getHasCountDown()) { 
            $gameConfig->setCountDownDuration($config['countDownDuration']); 
        }

        $gameConfig->setHasHelp($config['hasHelp']);
        if ($gameConfig->getHasHelp()) { 
            $gameConfig->setHelpDuration($config['helpDuration']);
        }
        $gameConfig->setNbQuestions($config['nbQuestions']);
        $gameConfig->setHasRandomCategory($config['hasRandomCategory']);
        $gameConfig->setHasDisplayCategory($config['hasDisplayCategory']);
        $gameConfig->setHasMusic($config['hasMusic']);
        $gameConfig->setHasMovies($config['hasMovies']);
        $gameConfig->setHasCartoons($config['hasCartoons']);
        $gameConfig->setHasTvShows($config['hasTvShows']);

    //    var_dump($gameConfig);

        // we have teams
        if ($gameConfig->getHasTeams()) {
            // no need to set the teamsNbr of $gameConfig, il will be auto incremented when creating a new team to it
            for ($i = 0; $i < count($config['teams']); $i++) {

                $team = new Team();

                if ($gameConfig->getHasTeamsNames()) {
                    $team->setName($config['teams']['team_' . $i]['teamName']);
                }
                $team->setColor($config['teams']['team_' . $i]['teamColor']);
                $team->setScore(0);

                // we have players too
                if ($gameConfig->getHasPlayers()) {
                    $team->setHasPlayers(true);
                    // no need to set the playersNbr of $team, il will be auto incremented when adding a new player to it
                    for ($j = 0; $j < count($config['teams']['team_' . $i]['players']); $j++) {
                        $player = new Player();
                        $player->setName($config['teams']['team_' . $i]['players']['player_' . $j]);
                        $player->setColor($team->getColor());
                        $player->setScore(0);
                        $player->setHasTeam(true);
                        $player->setTeamName($team->getName());

                        $team->addPlayer($player);
                    }
                }

                $gameConfig->addTeam($team);
            }
            
            //var_dump($gameConfig);
        }
        */
    }

}
// the json decoded : 
/*
    string(16) "Application/json"
array(15) {
    ["teams"]=> array(3) {
        ["team_0"]=> array(3) {
            ["teamColor"]   => string(14) "rgb(255, 0, 0)"
            ["teamName"]    => string(9) "saigneurs"
            ["players"]     => array(1) {
                ["player_0"]    => string(7) "Fostirn"
                ["player_1"]    => string(6) "Furnol"
            }
        }
        ["team_1"]=> array(3) {
            ["teamColor"]   => string(18) "rgb(136, 136, 136)"
            ["teamName"]    => string(7) "Phoques"
            ["players"]     => array(1) {
                ["player_0"]    => string(7) "Prakis"
                ["player_1"]    => string(6) "Furnobi"
                ["player_2"]    => string(6) "Filtep"
            }
        }
        ["team_2"]=> array(3) {
            ["teamColor"]   => string(16) "rgb(0, 153, 255)"
            ["teamName"]    => string(11) "Schtroumpfs"
            ["players"]     => array(1) {
                ["player_0"]    => string(7) "Prakabi"
            }
        }
  }
  ["name"]                  => string(4) "next"
  ["hasTeams"]              => bool(true)
  ["hasTeamsNames]          => bool(true)
  ["hasPlayersPoints"]      => bool(true)
  ["hasCountDown"]          => bool(true)
  ["countDownDuration"]     => string(2) "10"
  ["hasHelp"]               => bool(true)
  ["helpDuration"]          => string(2) "15"
  ["nbQuestions"]           => string(2) "10"
  ["hasRandomCategory"]     => bool(true)
  ["hasDisplayCategory"]    => bool(true)
  ["hasMusic"]              => bool(true)
  ["hasMovies"]             => bool(true)
  ["hasCartoons"]           => bool(false)
  ["hasTvShows"]            => bool(false)
}
*/