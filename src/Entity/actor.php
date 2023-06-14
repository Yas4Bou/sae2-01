<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Excpetion;
class actor
{
    private string|null $death;
    private int|null $avatarId;
    private string|null $birthday;
    private string $name;
    private string $biography;
    private string $placeOfBirth;
    private ?int $id;


    /**
     * @return string|null
     */
    public function getDeath(): ?string
    {
        return $this->death;
    }


    /**
     * @return int|null
     */
    public function getAvatarId(): ?int
    {
        return $this->avatarId;
    }

    /**
     * @return string|null
     */
    public function getBirthday(): ?string
    {
        return $this->birthday;
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * Cette methode retourne un tableau qui contient toutes les information des acteurs de la base de données
     * @return \Entity\actor[]
     */
    public static function findAll(string $Id): actor
    {
        $requete = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name, placeOfBirth, birthday, deathday as death, biography , avatarId
            FROM people
            WHERE id = ? ;
        SQL
        );

        $requete->execute([$Id]);
        $requete->setFetchMode(MyPdo::FETCH_CLASS, actor::class);
        $tab = $requete->fetch();

        if (!$tab) {
            throw new Excpetion\EntityNotFoundException("id : {$Id} Cet acteur n'existe pas ");
        } else {
            return $tab;
        }
    }
}

/* méthodes d'instances et méthode de classe crée mais ne fonctionne pas

private function __construct(?int $id, string $name, string|null $death, int|null $avatarId, string|null $birthday, string $biography, string $placeOfBirth){
    $this->name = $name;
    if (isset($id)){
        $this->id= $id;
    }
    if(isset(
    $this->death= $death;
    $this->avatarId= $avatarId;
    $this->birthday= $birthday;
    $this->biography= $biography;
    $this->placeOfBirth= $placeOfBirth;
}


public function setDeath(?string $death): actor
{
    $this->death = $death;
    return $this;
}

public function setAvatarId(?int $avatarId): actor
{
    $this->avatarId = $avatarId;
    return $this;
}

public function setBirthday(?string $birthday): actor
{
    $this->birthday = $birthday;
    return $this;
}

public function setBiography(string $biography): actor
{
    $this->biography = $biography;
    return $this;
}

 public function setPlaceOfBirth(string $placeOfBirth): actor
{
    $this->placeOfBirth = $placeOfBirth;
    return $this;
}

private function setId(?int $id): actor
{
    $this->id = $id;
    return $this;
}

public function setName(string $name): actor
{
    $this->name = $name;
    return $this;
}


 Cette méthode de classe de classe prend en paramère un nom "name" et un identifiant "id"
 @param string $name
 @param int|null $id
 Cette méthode de classe affecte le nom ("name") avec le 1er paramètre de la méthode
 et l'identifiant ("id") avec le 2nd parametre facultatif de la méthode
 Cette méthode de classe retourne l'instance crée
 @return static

public static function create(string $name, ?int $id, string|null $death, int|null $avatarId, string|null $birthday, string $biography, string $placeOfBirth): actor
{
    $actor = new actor();

    $actor->name = $name;
    $actor->biography = $biography;
    $actor->placeOfBirth= $placeOfBirth;

    if ($id !== null) { $actor->id = $id;}
    if ($death !== null) { $actor->death = $death;}
    if ($avatarId !== null) { $actor->avatarId = $avatarId;}
    if ($birthday !== null) { $actor->birthday = $birthday;}

    return $actor;
}


 cette méthode d'instance déclenche « insert() » ou « update() » selon que la valeur de « id » est respectivement « null » ou non
 @return $this

public function save(): actor{
    if ($this->id === null) {
        return $this->insert();
    } else {
        return $this->update();
    }
}



 cette méthode exécute la requête d'insertion dans la table « pepole »
 et met à jour l'identifiant de l'instance courante avec le dernier identifiant créé par la base de données
 @return $this

public function insert(): actor
{
    $requete = MyPDO::getInstance()->prepare(
        <<<'SQL'
            INSERT INTO people (name, biography, placeOfBirth, birthday, death, avatarId)
            VALUES (?, ?, ?, ?, ?, ?);
            SQL
    );
    $requete->execute([$this->name, $this->biography, $this->placeOfBirth, $this->birthday, $this->death, $this->avatarId]);
    $int = (int)MyPDO::getInstance()->lastInsertId();
    $this->id= $int;

    $requete -> setFetchMode(MyPdo::FETCH_CLASS, actor::class);
    $tab = $requete ->fetch();
    if(!$tab){
        throw new Excpetion\EntityNotFoundException("L'acteur avec l'ID {$this->id} n'existe pas.");
    }

    return $this;
}


 cette méthode save() retourne l'instance courante pour permettre le chaînage des méthodes
 Cette méthode met à jour le "name" de la table "people" pour la ligne dont l'"id" est celui de l'instance courante
 @return $this

public function update(): actor
{
    $requete = MyPDO::getInstance()->prepare(
        <<<'SQL'
            UPDATE pepole
            SET name = ?, biography = ?, placeOfBirth = ?, birthday = ?, death = ?, avatarId =?
            WHERE id = ? ;
            SQL
    );

    $requete->execute([$this->name, $this->biography, $this->placeOfBirth, $this->birthday, $this->death, $this->avatarId, $this->id]);
    $requete -> setFetchMode(MyPdo::FETCH_CLASS, actor::class);
    $tab = $requete ->fetch();
    if(!$tab){
        throw new Excpetion\EntityNotFoundException("Cet acteur n'existe pas pour l'ID : {$this->id}");
    }

    return $this;
}


 cette méthode delete() retourne l'instance courante pour permettre le chaînage des méthodes
 @return $this

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
        throw new Excpetion\EntityNotFoundException("id : Cet acteur n'existe pas ");
    }

    $this->id = null;

    return $this;
}

}

*/
