<?php

declare(strict_types=1);

use Entity\ActorForm;
use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;

try {
    ///////////////////////
    // À vous de jouer ! //
    ///////////////////////
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}

if(!isset($_GET['artistId'])) {
    $Id = null;

} else {
    if(is_int($_GET['artistId'])){
        $Id = $_GET["artistId"];
        $requete =  MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM people 
            WHERE id = ?
            ORDER BY role
        SQL);

        $requete -> execute([$Id]);
        $requete -> setFetchMode(MyPdo::FETCH_CLASS, \Entity\actor_cast_movie::class);
        $tab = $requete ->fetch();

        if(!$tab){
            throw new Excpetion\EntityNotFoundException("id : {$Id} Ce film n'existe pas ") ;
        }
        else {
            tab = new ActorForm();
        }
    }
    else {
        $Id = $_GET["artistId"];
        throw new \Entity\Excpetion\ParameterException("id : $Id n'est pas du bon type");
    }
    header("Content-Type : imageActor/jpeg");
    echo file_get_contents("Image\actor.png");

}