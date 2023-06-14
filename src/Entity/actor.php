<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Excpetion;
class actor
{
    private string|null $death;
    private int|null $avatarId ;
    private string|null $birthday;
    private string $name;
    private string $biography;
    private string $placeOfBirth;
    private int $id;


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
    * @return string
    */
    public function getBirthday(): string
    {
        if (is_null($this->birthday))
        {
            $this->birthday = " inconue";
        }
        return $this->birthday;
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
    public function getBiography(): string
    {
        return $this->biography;
    }

    /**
    * @return string
    */
    public function getPlaceOfBirth(): string
    {
        return $this->placeOfBirth;
    }

    /**
    * @return int
    */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * getter de la date de mort
     * @return string|null
     */
    public function getDeath(): string
    {
        if (is_null($this->death)){
            $this->death = "encore vivant";
        }
        return $this->death;
    }

    /**
     * Cette methode retourne un tableau qui contient toutes les information des acteurs de la base de données
     * @return \Entity\actor[]
     */
    public static function findAll( string $Id) : actor
    {
        $requete =  MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name, placeOfBirth, birthday, deathday as death, biography , avatarId
            FROM people
            WHERE id = ? ;
        SQL);

        $requete -> execute([$Id]);
        $requete -> setFetchMode(MyPdo::FETCH_CLASS, actor::class);
        $tab = $requete ->fetch();

        if(!$tab){
            throw new Excpetion\EntityNotFoundException("id : {$Id} Cet acteur n'existe pas ");
        }
        else {
            return $tab;
        }
    }


}
