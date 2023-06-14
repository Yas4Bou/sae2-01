<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\cover;

class coverCollection
{
    /**
     * Cette methode retourne un tableau qui contient toutes les images de la base de données, dans l'ordre alphabetique
     * @return \Entity\cover[]
     */
    public function findAll(string $Id)
    {
        $requete =  MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id , jpeg 
            FROM  image 
            WHERE id = ?; 
        SQL
        );

        $requete -> execute([$Id]);
        $requete -> setFetchMode(MyPdo::FETCH_CLASS, \Entity\cover::class);
        return $requete->fetchAll();
    }
}
