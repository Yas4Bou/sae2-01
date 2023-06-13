<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\movie;

class movieCollectionRequete1
{
    /**
     * Cette methode retourne un tableau qui contient tous les artists de la base de données, dans l'ordre alphabetique
     * @return \Entity\movie[]
     */
    public function findAll(int $Id)
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
