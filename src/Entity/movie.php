<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Excpetion;

class movie
{
    private int $posterId;
    private string $originalLanguage;
    private string $overview;
    private string $releaseDate;
    private int $runtime;
    private string $tagline;
    private string $title;
    private int $id;
    private string $originalTitle;

    /**
    * @return int
    */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    /**
    * @return string
    */
    public function getOriginalLanguage(): string
    {
        return $this->originalLanguage;
    }

    /**
     * @return int
     */
    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    /**
    * @return string
    */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
    *  @return string
    */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
    * @return int
    */
    public function getRuntime(): int
    {
        return $this->runtime;
    }

    /**
    * @return string
    */
    public function getTagline(): string
    {
        return $this->tagline;
    }

    /**
    * @return string
    */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
    * @return int
    */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * Cette methode retourne un tableau qui contient toutes les information d'un films de la base de données
     * @return \Entity\movie[]
     */
    public static function findAll( string $Id) : movie
    {
        $requete =  MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT posterId , originalLanguage, originalTitle, overview, releaseDate, runtime, tagline, title, id
            FROM movie
            WHERE id = ? ;
        SQL);


        $requete -> execute([$Id]);
        $requete -> setFetchMode(MyPdo::FETCH_CLASS, \Entity\movie::class);
        $tab = $requete ->fetch();

        if(!$tab){
            throw new Excpetion\EntityNotFoundException("id : {$Id} Ce film n'existe pas ");
        }
        else {
            return $tab;
        }
    }








}
