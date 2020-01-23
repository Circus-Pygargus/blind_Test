<?php 

require_once 'vendor/autoload.php';

$router = new AltoRouter();
/*
    ici les mots /, /produits, /a-propos et /contact sont lus dans l'url en méthode GET
    'c' donne le nom de la classe Controller appelée
    'a' donne le nom de la méthode de la classe ci-dessus
*/
$router->map('GET',  '/',                   array('c' => 'DefaultController',  'a' => 'index'));
$router->map('GET',  '/a-propos',           array('c' => 'DefaultController',  'a' => 'about'));
$router->map('GET',  '/contact',            array('c' => 'DefaultController',  'a' => 'contact'));
$router->map('GET',  '/config',             array('c' => 'ConfigController',   'a' => 'index'));
$router->map('GET',  '/config/playlists',   array('c' => 'ConfigController',   'a' => 'playlists'));
$router->map('POST', '/config/json',        array('c' => 'ConfigController',   'a' => 'json'));
$router->map('GET',  '/admin',              array('c' => 'AdminController',    'a' => 'index'));
$router->map('GET',  '/admin/end_game',     array('c' => 'AdminController',    'a' => 'endGame'));
//$router->map('GET',  '/admin/next-song',              array('c' => 'AdminController',    'a' => 'nextSong'));
$router->map('GET',  '/play',               array('c' => 'PlayController',    'a' => 'index'));
$router->map('GET',  '/page2_admin',        array('c' => 'TestController',    'a' => 'admin'));
$router->map('GET',  '/page1_main',         array('c' => 'TestController',    'a' => 'main'));
//$router->map('GET', '/.')
//$router->map('GET',  '/admin/next_song',    array('c' => 'AdminController',    'a' => 'nextSong'));

// on passe par altorouter::addMatchTypes() pour check la variable d'url avec la regex 
 //$router->addMatchTypes(array('playlist_id' => '[0-9]{1,11}'));
$router->addMatchTypes(array('playlist_id' => '[0-9]{1,11}',
                                'played_songs' => '[0-9]{1,11}')); 
 $router->map('GET', '/admin/next_song/[i:playlist_id]/[i:played_songs]', array('c' => 'AdminController',    'a' => 'nextSong'));


$match = $router->match();

$controller = 'App\\Controller\\' . $match['target']['c'];

$action = $match['target']['a'];

// instancier l'objet d'après l'url
$object = new $controller();
// ['params'] correspond à ce qu'il y a après /admin/next_song/ dans l'url
 if (count($match['params']) === 0) {
    $print = $object->{$action}();
 }
 else {
    $print = $object->{$action}($match['params']);
 }

echo $print;
