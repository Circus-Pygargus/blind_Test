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
// UTILISER UNE VARIABLE DE SESSION SI PLUSIEURS PLAYLISTS
   // private $dbGameConfig = [];

    // load admin page
    public function index ()
    {
   session_start();

    /*    $teams = array('team_01' => array(  'id'      => 01,
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
        $_SESSION["gameConfig"] = $dbGameConfig;
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

        // // the songs for this game
        // // we have random songs
        // $dbSong = [];
        // if ($dbGameConfig['has_random_songs']) {
        //     // NOT MADE FOR NOW
        // }
        // // we have a playlist
        // else {
        //     $objectPlaylist = new Playlist();
        //     $dbPlaylist = $objectPlaylist->getSongs($dbGameConfig['playlist_id']);
        //     $playlist = explode('_', $dbPlaylist['songs']);
        //    // var_dump($playlist);     
        //     $song = new Song();
        //     // this is the first song of the game
        //     $songId = $playlist[0];

        //     $dbSong =  $song->getOneById($songId);
        // }


      //  var_dump('env var 1 : ' . $_SESSION["gameConfig"]['has_music']);

        if ($dbGameConfig['has_random_songs']) {
            $objSong = new Song();
            $objSong->destroyRemainingSongsTable();
            $categories = [];
            if ($dbGameConfig['has_music']) {
                array_push($categories, 'musique');
            }
            if ($dbGameConfig['has_movies']) {
                array_push($categories, 'film');
            }
            if ($dbGameConfig['has_cartoons']) {
                array_push($categories, 'dessin animé');
            }
            if ($dbGameConfig['has_tv_shows']) {
                array_push($categories, 'émission');
            }
           // var_dump($categories);
            $objSong->createRemainingSongsTable($categories);
          $_SESSION['AllForRamdomPlaylist'] = $objSong->getAllForRandomPlaylist($categories);
          //var_dump('$session : ' . count($_SESSION['AllForRamdomPlaylist']));
        }
 

      //  var_dump($dbSong);
    //    return $this->twig->render('admin.html.twig');
        return $this->twig->render('admin.html.twig', [
           'config'     => $dbGameConfig,
           'teams'      => $dbTeams,
           'players'    => $dbPlayers//,
           //'song'       => $dbSong
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
        session_start(); 
       // $playedSongs = $this->playedSongs;
//$playedSongs = 2;
      //  var_dump('playedSongs');
 //      var_dump($params);
 //var_dump('env var (next_song) : ' . $_SESSION["gameConfig"]);
        $gameConfig = new GameConfig();
        $dbGameConfig = $gameConfig->getByName('next');


        //$dbSong;
//  var_dump($dbGameConfig);
        if ($dbGameConfig['has_random_songs']) {

            $nbrQuestionsMax = $dbGameConfig['nbr_questions'];
        /*    var_dump( $nbrQuestionsMax);
            var_dump( intval($params['played_songs']));

            if (intval($params['played_songs']) === $nbrQuestionsMax) {
                var_dump('Enfin !!!');
                $this->endGame();
            }
        */
          //  $objSong = new Song();
          //  $objSong->getNextRandomSong();
            $remainingNbr = count($_SESSION['AllForRamdomPlaylist']);
            $randomKey = rand( 0, $remainingNbr - 1 );
            $next_songId = $_SESSION['AllForRamdomPlaylist'][$randomKey];
            // for ($i = 0; $i < count($_SESSION['AllForRamdomPlaylist'][$randomKey]); $i++) {
            //     var_dump('next songId : ' . $_SESSION['AllForRamdomPlaylist'][$randomKey][$i]);
            // }
          //  var_dump('count 1 : ' . count($_SESSION['AllForRamdomPlaylist']));
           // var_dump('count 2 : ' . count($_SESSION['AllForRamdomPlaylist'][$randomKey]));
            foreach ($_SESSION['AllForRamdomPlaylist'][$randomKey] as $songId) {
              // var_dump('value :' . $value);
               $objSong = new Song();
            $dbSong = $objSong->getOneById($songId);
            }
          //  $objSong = new Song();
          //  $dbSong = $objSong->getOneById($next_songId);

            unset($_SESSION['AllForRamdomPlaylist'][$randomKey]);
            $_SESSION['AllForRamdomPlaylist'] = array_values($_SESSION['AllForRamdomPlaylist']);
           // var_dump("nouveau count" . count($_SESSION['AllForRamdomPlaylist']));
        }
        // we have a playlist
        else {
            $playlistId = $params['playlist_id'];
            $playedSongs = $params['played_songs'];

            $objectPlaylist = new Playlist();
            $dbPlaylist = $objectPlaylist->getSongs($playlistId);

            $nbrQuestionsMax = count($dbPlaylist);
          //  var_dump('nbrQuestionsMax : ' . $nbrQuestionsMax);

            $playlist = explode('_', $dbPlaylist['songs']);
        // var_dump($playlist);
            $objSong = new Song();
            $id = $playlist[$playedSongs];
    //       var_dump($id);
            $dbSong = $objSong->getOneById($id);
    //var_dump($dbSong);
           // $playedSongs++;
          //  $this->playedSongs = $playedSongs;
        // var_dump($this->playedSongs);
        
        }

        $response = array(  'reponse'=>'ok', 
                            'render'=> '',
                            'song' => $dbSong
        );
        // build view 
        $myTemplate = $this->twig->load('admin.html.twig');
        // return $myTemplate->renderBlock('songBox', 
        //                 ['song' => $dbSong]
        // );
        $response["render"] =  $myTemplate->renderBlock('songBox', 
                        ['song' => $dbSong]
        );
        return json_encode( $response );
      /*  {"reponse":"ok",
            "render":"  <div id=\"song_div\">\n
                            <!-- songs infos -->\n
                            <div id=\"song-row\">\n
                                <div id=\"song-infos_div\">\n
                                    <div id=\"song-infos-titles_div\" class=\"song-information\">\n                            
                                        <div id=\"song-title\">Titre en cours : <\/div>\n                            
                                        <div class=\"song-info-value\" id=\"song-title-value\">Ronde de nuit<\/div>\n                        
                                    <\/div>\n                        
                                    <div id=\"song-infos-singer_div\" class=\"song-information\">\n                            
                                        <div id=\"song-singer\">Interpr\u00e8te : <\/div>\n                            
                                        <div class=\"song-info-value\" id=\"song-singer-value\"> Mano Negra<\/div>\n                        
                                    <\/div>\n                        
                                    <div id=\"song-infos-category_div\" class=\"song-information\">\n                            
                                        <div id=\"song-category\">Cat\u00e9gorie : <\/div>\n                            
                                        <div class=\"song-info-value\" id=\"song-category-value\">music<\/div>\n                        
                                    <\/div>\n                        
                                    <div id=\"song-infos-points_div\" class=\"song-information\">\n                            
                                        <div id=\"song-points\">Nombre de points :<\/div>\n                            
                                        <div class=\"song-info-value\" id=\"song-points-value\">1<\/div>\n                        
                                    <\/div>\n                    
                                <\/div>\n                
                                               
                            <!-- here we'll fill this div with css background-image -->\n                    
                            <div id=\"song-img_div\" style=\"background-image: url(public\/assets\/img\/mano_negra.jpg)\">\n                
                            <\/div>\n                
                        <\/div>\n                
                        <!-- the song player -->\n                
                        <div id=\"music-player_div\">\n\n                    
                        <audio id=\"music-player\" controls\n                        
                            src=\"public\/songs\/music\/mano_negra\/patchanka\/02_Ronde_de_nuit.mp3\">\n                        
                            Ce navigateur ne supporte pas le lecteur audio.\n                    
                        <\/audio>\n                
                    <\/div>\n                
                    <!-- the control for game page -->\n                
                    <div id=\"control-game-page_div\">\n                    
                        <div>\n                        
                            <button id=\"openTab\">OUVRE ONGLET<\/button>\n                    
                        <\/div>\n                    
                        <div>\n                        
                            <button id=\"send\">ENVOIE MESSAGE<\/button>\n                    
                        <\/div>\n                
                    <\/div>\n            
                <\/div>\n            
            "}
            */

    //     $playedSongs = $this->playedSongs;
    //   //  var_dump('playedSongs');
    //   //  var_dump($playedSongs);
    //     $playlistId = $params['playlist_id'];
    //     $objectPlaylist = new Playlist();
    //     $dbPlaylist = $objectPlaylist->getSongs($playlistId);
    //     $playlist = explode('_', $dbPlaylist['songs']);
    //    // var_dump($playlist);
    //     $objSong = new Song();
    //     $id = $playlist[$playedSongs];
    //    // var_dump($id);
    //     $dbSong = $objSong->getOneById($id);        

    //     $playedSongs++;
    //     $this->playedSongs = $playedSongs;
        
    //     //$response = array('reponse'=>'ok');
    //     $response = array('reponse'=>'ok', 'render'=>'');

    //    // echo json_encode($response);
    //     // build view 
    //     $myTemplate = $this->twig->load('admin.html.twig');
    //     // return $myTemplate->renderBlock('songBox', 
    //     //                 ['song' => $dbSong]
    //     // );
    //     $response["render"] =  $myTemplate->renderBlock('songBox', 
    //                     ['song' => $dbSong]
    //     );
    //     return $response;
    }
    
    
    public function endGame () {
        $endGame = 'Fin de la partie';
        $response = array(  'reponse'=>'ok', 
                            'render'=> '',
                            'end_game' => $endGame
        );
        // build view 
        $myTemplate = $this->twig->load('admin.html.twig');
        // return $myTemplate->renderBlock('songBox', 
        //                 ['song' => $dbSong]
        // );
        $response["render"] =  $myTemplate->renderBlock('endGame', 
                        ['end_game' => $endGame]
        );
        return json_encode( $response );
    }
}