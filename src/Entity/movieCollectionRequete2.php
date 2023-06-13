<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\movie_cast;
class movieCollectionRequete2
{
    /**
     * Cette methode retourne un tableau qui contient tous les Acteurs et leurs role de la base de données, dans l'ordre alphabetique
     * @return \Entity\movie_cast[]
     */
    public function findAll(string $Id)
    {
        $requete =  MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT p.id , name , role 
            FROM people p , cast c , movie m 
            WHERE m.id = c.movieId 
                AND c.peopleId = p.id 
                AND m.id = ?
            ORDER BY role ;
        SQL);


        $requete -> execute([$Id]);
        $requete -> setFetchMode(MyPdo::FETCH_CLASS, \Entity\movie_cast::class);
        return $requete->fetchAll();
    }
}
