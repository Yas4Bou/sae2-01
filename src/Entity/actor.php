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
    private ?int $id;


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return actor
     */
    public function setName(string $name): actor
    {
        $this->name = $name;
        return $this;
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return actor
     */
    private function setId(?int $id): actor
    {
        $this->id = $id;
        return $this;
    }

    public function delete(): self
    {
        if ($this->id !== null) {
            $requete = MyPDO::getInstance()->prepare(
                <<<'SQL'
                DELETE FROM people
                WHERE id = ? ;
            SQL
            );
        }
        $requete->execute([$this->id]);

        $this->id = null;

        return $this;
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
