<?php

namespace App\Controller;

use App\Application\Controller;

use App\Entity\GameConfig;
use App\Entity\Team;
use App\Entity\Player;
use App\Entity\Song;
use App\Entity\Playlist;


class AdminController extends Controller 
{
    // __construct function herited from Controller


    
    // need some variables
    private $playlist;
    private $playedSongs = 0;


    // load admin page
    public function index ()
    {
    /*    $gameConfig = array('hasTeams'  => true,
                            'hasPlayers' => true
        );
        $teams = array('team_01' => array(  'id'      => 01,
                                            'name'    => 'La team 01',
                                            'score'   => 0
                                            ),
                       'team_02' => array(  'id'      => 02,
                                            'name'    => 'La team 02',
                                            'score'   => 0,
                                            'players' => array('player_01' => array('name' => 'joueurs 01',
                                                                                    'score' => 0),
                                                                'player_02' => array('name' => 'joueur 02',
                                                                                    'score' => 0)
                                                                )  
                                            ) 
        );
   */
        /*    $players = array('player_01' => array(  'id'    => '1',
                                                'name'  => 'joueurs 01',
                                                'score' => 0,
                                                'teamid'=> '1'),
                         'player_02' => array(  'id'    => '2',
                                                'name'  => 'joueur 02',
                                                'score' => 0,
                                                'teamid'=> '2'),

                         'player_03' => array(  'id'    => '3',
                                                'name'  => 'joueur 03',
                                                'score' => 0,
                                                'teamid'=> '2'),
                          'player_04' => array(  'id'    => '4',
                                                 'name'  => 'joueur 04',
                                                 'score' => 0,
                                                 'teamid'=> '1')
        );
    
  /*  gameConfig : array(20) { ["id"]=> int(38) 
                            ["name"]=> string(4) "next" 
                            ["has_teams"]=> int(1) 
                            ["has_teams_names"]=> int(1) 
                            ["teams"]=> string(9) "98_99_100" 
                            ["teams_nbr"]=> int(3) 
                            ["has_players"]=> int(1) 
                            ["players_nbr"]=> int(6) 
                            ["players"]=> string(23) "247_248_249_250_251_252" 
                            ["has_count_down"]=> int(0) 
                            ["count_down_duration"]=> int(0) 
                            ["has_help"]=> int(0) 
                            ["help_duration"]=> int(0) 
                            ["nbr_questions"]=> int(6) 
                            ["has_random_songs"]=> int(0) 
                            ["has_random_category"]=> int(0) 
                            ["has_display_category"]=> int(0) 
                            ["has_music"]=> int(0) 
                            ["has_movies"]=> int(0) 
                            ["has_cartoons"]=> int(1) 
                            ["has_tv_shows"]=> int(0) }
*/


        global $playlist;

        // the config for this game
        $gameConfig = new GameConfig();
        $dbGameConfig = $gameConfig->getByName('next');
    //    echo 'gameConfig : ';
    
        // the teams for this game
        $dbTeams = [];
        if ($dbGameConfig["has_teams"]) {
            $objectTeam = new Team();
            $teams = explode('_', $dbGameConfig["teams"]);
            //  var_dump($playersIdsArray);
            for ($i = 0; $i < count($teams); $i++) {
                $newTeam = $objectTeam->getById($teams[$i]);
                array_push($dbTeams , $newTeam);
            }
        }

        // the players for this game
        $dbPlayers = [];
        if ($dbGameConfig["has_players"]) {
            $objectPlayer = new Player();
            $players = explode('_', $dbGameConfig["players"]);
            for ($i = 0; $i < count($players); $i++) {
                $newPlayer = $objectPlayer->getOne($players[$i]);
                array_push($dbPlayers, $newPlayer);
            }
        }

        // the songs for this game
        // we have random songs
        $dbSong = [];
        if ($dbGameConfig['has_random_songs']) {
            // NOT MADE FOR NOW
        }
        // we have a playlist
        else {
            $objectPlaylist = new Playlist();
            $dbPlaylist = $objectPlaylist->getSongs($dbGameConfig['playlist_id']);
            $playlist = explode('_', $dbPlaylist['songs']);
           // var_dump($playlist);     
            $song = new Song();
            // this is the first song of the game
            $songId = $playlist[0];
            
            $dbSong =  $song->getOneById($songId);       
        }



        

      //  var_dump($dbSong);
    //    return $this->twig->render('admin.html.twig');
        return $this->twig->render('admin.html.twig', [
           'config'     => $dbGameConfig,
           'teams'      => $dbTeams,
           'players'    => $dbPlayers,
           'song'       => $dbSong
       ]);
    
    }


    // public function delete ( $params = [] ) {
    //     $id = $params['idProduit'];
    //     $produit  = new Produit();
    //     $produit->delete($id);
    //     header('Location: /produits');
    // }
    
    // asking for playlists names
    public function nextSong ( $params = []) {
        $playedSongs = $this->playedSongs;
      //  var_dump('playedSongs');
      //  var_dump($playedSongs);
        $playlistId = $params['playlist_id'];
        $objectPlaylist = new Playlist();
        $dbPlaylist = $objectPlaylist->getSongs($playlistId);
        $playlist = explode('_', $dbPlaylist['songs']);
       // var_dump($playlist);
        $objSong = new Song();
        $id = $playlist[$playedSongs];
       // var_dump($id);
        $dbSong = $objSong->getOneById($id);        

        $playedSongs++;
        $this->playedSongs = $playedSongs;
        
        $response = array('reponse'=>'ok');
        echo json_encode($response);
        // build view 
        $myTemplate = $this->twig->load('admin.html.twig');
        // return $myTemplate->renderBlock('songBox', 
        //                 ['song' => $dbSong]
        // );
        $response["render"] =  $myTemplate->renderBlock('songBox', 
                        ['song' => $dbSong]
        );
        echo $response;
    }
}