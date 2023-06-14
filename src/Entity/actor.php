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
     * @param int|null $id
     * @param string $name
     */
    private function __construct(?int $id, string $name ){
        $this->name = $name;
        $this->id= $id;
    }

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

    /**
     * Cette méthode de classe de classe prend en paramère un nom "name" et un identifiant "id"
     * @param string $name
     * @param int|null $id
     * Cette méthode de classe affecte le nom ("name") avec le 1er paramètre de la méthode
     * et l'identifiant ("id") avec le 2nd parametre facultatif de la méthode
     * Cette méthode de classe retourne l'instance crée
     * @return static
     */
    public static function create(string $name, ?int $id = null): actor
    {
        $actor = new actor();

        $actor->name = $name;

        if ($id !== null) {
            $actor->id = $id;
        }

        return $actor;
    }



    /**
     * cette méthode save() retourne l'instance courante pour permettre le chaînage des méthodes
     * Cette méthode met à jour le "name" de la table "people" pour la ligne dont l'"id" est celui de l'instance courante
     * @return $this
     */
    public function save(): actor
    {
        if ($this->id !== null) {
            $requete = MyPDO::getInstance()->prepare(
                <<<'SQL'
                UPDATE pepole
                SET name = ?
                WHERE id = ? ;
                SQL
            );
            $requete->execute([$this->name, $this->id]);
        }

        return $this;
    }

    /**
     * cette méthode delete() retourne l'instance courante pour permettre le chaînage des méthodes
     * @return $this
     */
    public function delete(): actor
    {
        $requete = MyPDO::getInstance()->prepare(
            <<<'SQL'
        DELETE FROM people
        WHERE id = ? ;
    SQL);
        $requete->execute([$this->id]);
        $requete -> setFetchMode(MyPdo::FETCH_CLASS, actor::class);
        $tab = $requete ->fetch();
        if(!$tab){
            throw new Excpetion\EntityNotFoundException("id : {$Id} Cet acteur n'existe pas ");
        }

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
