<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Excpetion;
class actor_cast_movie
{
    private int $id ;
    private string $title;
    private string $role;
    private string $releaseDate;

    private int $posterId;

    private int|null $avatarId;

    /**
    * @return int
    */
    public function getId(): int
    {
        return $this->id;
    }
    /**
    * @return string
    */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
    * @return string
    */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
    * @return string
    */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
    * @return int
    */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    /**
     * Cette methode retourne un tableau qui contient les role, les films et la date de sortie de chaques acteurs de la base de données
     * @return \Entity\actor_cast_movie[]
     */
    public static function findAll( string $Id) : actor_cast_movie
    {
        $requete =  MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT m.id , title , role , releaseDate, posterId
            FROM people p , cast c , movie m 
            WHERE m.id = c.movieId 
                AND c.peopleId = p.id 
                AND p.id = ?
            ORDER BY role
        SQL);

        $requete -> execute([$Id]);
        $requete -> setFetchMode(MyPdo::FETCH_CLASS, \Entity\actor_cast_movie::class);
        $tab = $requete ->fetch();

        if(!$tab){
            throw new Excpetion\EntityNotFoundException("id : {$Id} Cette image n'existe pas ");
        }
        else {
            return $tab;
        }
    }
}
