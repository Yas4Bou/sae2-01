<?php

declare(strict_types=1);
require_once '../vendor/autoload.php';
use Database\MyPdo;
use Css\AppWebPage;
use Entity\actor;
use Entity\actor_cast_movie;

$actorPage = new AppWebPage();

if(isset($_GET["nombre"])) {
    $Id = $_GET['nombre'];
    $actorPage->appendContent('<div class="menu"> <a href="http://localhost:8000/homePage.php">Menu</a> </div>');
    $value1 = actor::findAll($Id);

    $name = $actorPage->escapeString($value1->getName());
    $menu = '<div id="menu"> <a href="http://localhost:8000/homePage.php">Menu</a> </div>';
    $actorPage->appendContent($menu);
    $placeOfBirth = $actorPage->escapeString($value1->getPlaceOfBirth());
    $biography = $actorPage->escapeString($value1->getBiography());
    $birthday = $value1->getBirthday();
    $deathday = $value1->getDeath();
    $avatarId = $value1 ->getAvatarId();
    $actorPage -> setTitle(" Films - $name");
    $actorPage->appendContent("<div class='menu'> 
                                    <img src= 'imageActor.php?imageID=$avatarId' width='100px' height='150px'>
                                    <article class='menu__item'>$name  </article> 
                                    <article class='menu__item'>Lieu de naissance : $placeOfBirth </article>
     
                                      <div class='date'>
                                        <div class='datNias'>Date de naissance : $birthday </div> 
                                        <div class='datMort'>Date de mort : $deathday </div>
                                        </div> 
                                       
                                    <article class='menu__item'>Biographie : $biography </article>
                                    </div>");


    $value = actor_cast_movie::findAll($Id);


    $title = $actorPage->escapeString($value->getTitle());
    $role = $actorPage->escapeString($value->getRole());
    $id = $value->getId();
    $releaseDate = $value->getReleaseDate();
    $posterId = $value->getPosterId();
    $actorPage->appendContent("<div class='conteneur'> 
                                    <img src= 'imageMovie.php?imageID=$posterId' width='100px' height='150px'>
                                    <div class='film'>
                                        <div class='title'><a href='http://localhost:8000/moviePage.php?nombre=$id'> Titre du film : $title </a> </div>
                                        <div class='dateSortie'>Date de sortie : $releaseDate </div>
                                    </div>
                                    <div class='role'>
                                        <div class='role_item'><a href='http://localhost:8000/moviePage.php?nombre=$id'> Role : $role  </a> </div>
                                      </div>
                                    </div>");


    $date = $actorPage ->getLastModification();
    $actorPage ->appendContent("<footer>$date</footer>");
}
else {
    header("Location : http://localhost:8000/homePage.php", true, 302);
    exit(1);
}


$actorPage->appendCssUrl("css/ActorCss.css");


echo $actorPage->TOHTML();
