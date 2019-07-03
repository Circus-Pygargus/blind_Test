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
    public function getOneById (int $id) 
    {      
        $sql = "SELECT * FROM songs
                WHERE id=:id";
        $this->prepare($sql);
        $this->bindParam(':id', $id, \PDO::PARAM_INT);
        $this->execute();
        return $this->fetch();
    }

}