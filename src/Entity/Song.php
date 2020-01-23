<?php

namespace App\Entity;

use App\Application\Database;

class Song extends Database
{

    /* ################# VARIABLES ################# */

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $file;

    /**
     * @var string
     */
    private $extension;

    /**
     * @var string
     */
    private $singer;

    /**
     * @var string
     */
    private $category;

    /**
     * @var string
     */
    private $genre;

    /**
     * @var int
     */
    private $year;

    /**
     * @var string
     */
    private $picture;

    /**
     * @var int
     */
    private $points;



    /* ################## getters and setters ################ */
    

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Get the value of title
     * 
     * @return string
     */
    public function getTitle () 
    {
        return $this->title;
    }

    /**
     * Set the value of title
     * 
     * @param  string  $title
     *
     * @return  self
     */
    public function setTitle (string $title) 
    {
        $this->title = $title;

        return $this;
    }


    /**
     * Get the value of the path of the song file
     * 
     * @return string
     */
    public function getPath () 
    {
        return $this->path;
    }

    /**
     * Set the value of the path of the song file
     * 
     * @param  string  $path
     *
     * @return  self
     */
    public function setPath (string $path) 
    {
        $this->path = $path;

        return $this;
    }


    /**
     * Get the value of file
     * 
     * @return string
     */
    public function getFile () 
    {
        return $this->file;
    }

    /**
     * Set the value of file
     * 
     * @param  string  $file
     *
     * @return  self
     */
    public function setFile (string $file) 
    {
        $this->file = $file;

        return $this;
    }


    /**
     * Get the value of the extension of the song file
     * 
     * @return string
     */
    public function getExtension () 
    {
        return $this->extension;
    }

    /**
     * Set the value of the extension of the song file
     * 
     * @param  string  $extension
     *
     * @return  self
     */
    public function SetExtension (string $extension) 
    {
        $this->extension = $extension;

        return $this;
    }



    /**
     * Get the value of singer
     * 
     * @return string
     */
    public function getSinger () 
    {
        return $this->singer;
    }

    /**
     * Set the value of singer
     * 
     * @param  string  $singer
     *
     * @return  self
     */
    public function setSinger (string $singer) 
    {
        $this->singer = $singer;

        return $this;
    }



    /**
     * Get the value of category
     * 
     * @return string
     */
    public function getCategory () 
    {
        return $this->category;
    }

    /**
     * Set the value of category
     * 
     * @param  string  $category
     *
     * @return  self
     */
    public function setCategory (string $category) 
    {
        $this->category = $category;

        return $this;
    }



    /**
     * Get the value of genre
     * 
     * @return string
     */
    public function getGenre () 
    {
        return $this->genre;
    }

    /**
     * Set the value of genre
     * 
     * @param  string  $genre
     *
     * @return  self
     */
    public function setGenre (string $genre) 
    {
        $this->genre = $genre;

        return $this;
    }



    /**
     * Get the value of year
     * 
     * @return string
     */
    public function getYear () 
    {
        return $this->year;
    }

    /**
     * Set the value of year
     * 
     * @param  string  $year
     *
     * @return  self
     */
    public function setYear (string $year) 
    {
        $this->year = $year;

        return $this;
    }


    /**
     * Get the value of picture link
     * 
     * @return string
     */
    public function getPicture ()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture link
     * 
     * @return self
     */
    public function setPicture (string $picture)
    {
        $this->picture = $picture;

        return self;
    }


    /**
     * Get the value of points
     * 
     * @return int
     */
    public function getPoints ()
    {
        return $this->points;
    }

    /**
     * Set the value of points
     * 
     * @return self
     */
    public function setPoints (int $points)
    {
        $this->points = $points;

        return self;
    }
    



    /* ######################### SQL ######################### */


    /**
     * Get one song from db with id
     * 
     * @param int $id
     * 
     * @return array
     */
    public function getOneById (int $id):array 
    {      
        $sql = "SELECT * FROM songs
                WHERE id=:id";
        $this->prepare($sql);
        $this->bindParam(':id', $id, \PDO::PARAM_INT);
        $this->execute();
        return $this->fetch();
    }


    /**
     * destroy remaining songs table if exists
     */
    public function destroyRemainingSongsTable ():void 
    {
        $sql = "DROP TABLE IF EXISTS remaining_songs";
        $this->prepare($sql);
        $this->execute();
    }


    /**
     * create and fill a table to store all possible and remaining
     */
    public function createRemainingSongsTable (array $categories):void 
    {
        $sql = "CREATE TABLE IF NOT EXISTS remaining_songs (
                    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                    song_id INT)";
        $this->prepare($sql);
        $this->execute();


        $sql = "INSERT INTO remaining_songs (song_id)
                SELECT id FROM songs";
        for ($i = 0; $i < count($categories); $i++) {
            if ($i === 0) {
                $sql .= " WHERE category = '" . $categories[$i] . "'";
            }
            else {
                $sql .= " OR category = '" . $categories[$i] . "'";
            }
        }      
        $this->prepare($sql);
        $this->execute();
    }


    /**
     * Get the number of remaining songs in db according to choosen categories
     * 
     * @param array categories // not needed any more
     * 
     * @return int
     */
    public function getNextRandomSong ():void 
    {
        session_start();
       // var_dump('env var db : ' . $_SESSION["gameConfig"]); 
         //idée de méthode:
        //compter les lignes
        // créer une colonne et remplir avec les numéros du compteur de lignes : Comment ???
        // nbr aléatoire en php entre 0 et compteur
        // choper avec la colonne créée
        // pas trop lourd comme méthode de faire ça à chaque titre ?
        $sql = "SELECT COUNT(id) FROM remaining_songs";
        $this->prepare($sql);
        $this->execute();
        $songsNb = $this->fetchColumn();

        $next_songId = rand(1, $songsNb);

// utiliser le cursor ? mais comment ? ou utiliser $next_songId ? 
        $sql = "SELECT song_id FROM remaining_songs";
        $this->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
        $this->execute();
        $this->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_ABS);
    }


    /**
     * Remove played song from random remaining songs
     * 
     * @param int $songId
     */
    public function removeLastOneFromRemainingSongs (int $songId):void 
    {
        $sql = "DELETE FROM remaining_songs
                WHERE song_id=:song_id";
        $this->prepare($sql);
        $this->bindParam(':song_id', $songId, \PDO::PARAM_INT);
        $this->execute();  
    }


    public function getAllForRandomPlaylist (array $categories) 
    {
        $sql = "SELECT id FROM songs";
        for ($i = 0; $i < count($categories); $i++) {
            if ($i === 0) {
                $sql .= " WHERE category = '" . $categories[$i] . "'";
            }
            else {
                $sql .= " OR category = '" . $categories[$i] . "'";
            }
        }      
        
       // var_dump($sql);
        $this->prepare($sql);
        $this->execute();
        return $this->fetchAll();
    }
}