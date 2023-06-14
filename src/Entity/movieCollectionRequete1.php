<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\movie;

class movieCollectionRequete1
{
    /**
     * Cette methode retourne un tableau qui contient toutes les information d'un films de la base de données
     * @return \Entity\movie[]
     */
    public function findAll( string $Id)
    {
        $requete =  MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT posterId , originalLanguage, originalTitle, overview, releaseDate, runtime, tagline, title, id
            FROM movie
            WHERE id = ? ;
        SQL);


        $requete -> execute([$Id]);
        $requete -> setFetchMode(MyPdo::FETCH_CLASS, \Entity\movie::class);
        return $requete->fetchAll();
    }
}
