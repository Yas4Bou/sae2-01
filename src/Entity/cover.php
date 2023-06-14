<?php

declare(strict_types=1);

namespace Entity;

use Entity\Excpetion;
use Database\MyPdo;


class cover
{
    private int $id ;
    private string $jpeg;
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
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    /**
     * Cette methode retourne un tableau qui contient toutes les images de la base de données, dans l'ordre alphabetique
     * @return \Entity\cover[]
     */
    public static function findById(string $Id) : cover
    {
        $requete =  MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id , jpeg 
            FROM  image 
            WHERE id = :id ; 
        SQL
        );

        $requete -> execute([":id"=>$Id]);
        $requete -> setFetchMode(MyPdo::FETCH_CLASS, cover::class);
        $tab = $requete ->fetch();

        if(!$tab){
            throw new Excpetion\EntityNotFoundException("id : {$Id} Cette image n'existe pas ");
        }
        else {
            return $tab;
        }
    }
}
