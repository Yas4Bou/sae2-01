<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\movie;
class homeCollection
{
    /**
     * Cette methode retourne un tableau qui contient tous les artists de la base de données, dans l'ordre alphabetique
     * @return \Entity\movie[]
     */
    public function findAll()
    {
        $requete =  MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT posterId , originalLanguage, originalTitle, overview, releaseDate, runtime, tagline, title, id
            FROM movie
            ORDER BY title; 
        SQL);


        $requete -> execute();
        $requete -> setFetchMode(MyPdo::FETCH_CLASS, \Entity\movie::class);
        return $requete->fetchAll();
    }
}

