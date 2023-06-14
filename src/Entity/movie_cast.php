<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Excpetion;

class movie_cast
{
    private int $id ;
    private string $name ;
    private int|null $avatarId;
    private string $role;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
    * @return string
    */
    public function getRole(): string
    {
        return $this->role;
    }
    /**
    * @return int
    */
    public function getAvatarId(): int
    {
        if (is_null($this->avatarId))
        {
            $this->avatarId = 0;
        }
        return $this->avatarId;
    }

    /**
     * Cette methode retourne un tableau qui contient tous les Acteurs et leurs role de la base de données, dans l'ordre alphabetique
     * @return \Entity\movie_cast[]
     */
    public static function findAll(string $Id) : movie_cast
    {
        $requete =  MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT p.id , name , role , avatarId
            FROM people p , cast c , movie m 
            WHERE m.id = c.movieId 
                AND c.peopleId = p.id 
                AND m.id = ?
            ORDER BY role ;
        SQL);


        $requete -> execute([$Id]);
        $requete -> setFetchMode(MyPdo::FETCH_CLASS, \Entity\movie_cast::class);
        $tab = $requete ->fetch();

        if(!$tab){
            throw new Excpetion\EntityNotFoundException("id : {$Id} Cet acteur n'existe pas ");
        }
        else {
            return $tab;
        }
    }



}
