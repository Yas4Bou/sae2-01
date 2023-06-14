<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\actor;
class actorCollectionRequete1
{
    /**
     * Cette methode retourne un tableau qui contient toutes les information des acteurs de la base de données
     * @return \Entity\actor[]
     */
    public function findAll( string $Id)
    {
        $requete =  MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name, placeOfBirth, birthday, deathday as death, biography , avatarId
            FROM people
            WHERE id = ? ;
        SQL);

        $requete -> execute([$Id]);
        $requete -> setFetchMode(MyPdo::FETCH_CLASS, \Entity\actor::class);
        return $requete->fetchAll();
    }
}