<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\actor_cast_movie;
class actorCollectionRequete2
{
    /**
     * Cette methode retourne un tableau qui contient les role, les films et la date de sortie de chaques acteurs de la base de données
     * @return \Entity\actor_cast_movie[]
     */
    public function findAll( string $Id)
    {
        $requete =  MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT m.id , title , role , releaseDate
            FROM people p , cast c , movie m 
            WHERE m.id = c.movieId 
                AND c.peopleId = p.id 
                AND p.id = ?
            ORDER BY role
        SQL);

        $requete -> execute([$Id]);
        $requete -> setFetchMode(MyPdo::FETCH_CLASS, \Entity\actor_cast_movie::class);
        return $requete->fetchAll();
    }

}