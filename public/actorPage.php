<?php
declare(strict_types=1);
require_once '../vendor/autoload.php';
use Database\MyPdo;
use Css\AppWebPage;
use Entity\actorCollectionRequete1;
use Entity\actorCollectionRequete2;

$actorPage = new AppWebPage();

if(isset($_GET["nombre"])){
    $Id = $_GET['nombre'];

    $requetes1 = new actorCollectionRequete1();
    $tableau1 = $requetes1 ->findAll($Id);

    foreach ($tableau1  as $key => $value) {
        $name = $actorPage->escapeString($value->getName());
        $placeOfBirth = $actorPage->escapeString($value->getPlaceOfBirth());
        $biography = $actorPage->escapeString($value->getBiography());
        $birthday = $value->getBirthday();
        $deathday = $value->getDeath();
        $avatarId = $value ->getAvatarId(); 
        $actorPage -> setTitle(" Films - $name");
        $actorPage->appendContent("<div class='menu'> 
                                    <img src= 'image.php?imageID=$avatarId' width='100px' height='150px'>
                                    <article class='menu__item'>$name  </article> 
                                    <article class='menu__item'>Lieu de naissance : $placeOfBirth </article>
     
                                      <div class='date'>
                                        <div class='datNias'>Date de naissance : $birthday </div> 
                                        <div class='datMort'>Date de mort : $deathday </div>
                                        </div> 
                                       
                                    <article class='menu__item'>Biographie : $biography </article>
                                    </div>");
    }


    $requetes2 = new actorCollectionRequete2();
    $tableau2 = $requetes2 ->findAll($Id);

    foreach ($tableau2 as $key => $value) {
        $title = $actorPage->escapeString($value->getTitle());
        $role = $actorPage->escapeString($value->getRole());
        $id = $value->getId();
        $releaseDate = $value->getReleaseDate();
        $actorPage->appendContent("<div class='conteneur'> 
                                    <div class='film'>
                                        <div class='title'><a href='http://localhost:8000/moviePage.php?nombre=$id'> Titre du film : $title </a> </div>
                                        <div class='dateSortie'>Date de sortie : $releaseDate </div>
                                    </div>
                                    <div class='role'>
                                        <div class='role_item'><a href='http://localhost:8000/moviePage.php?nombre=$id'> Role : $role  </a> </div>
                                      </div>
                                    </div>");
    }

    $date = $actorPage ->getLastModification();
    $actorPage ->appendContent("<footer>$date</footer>");
}
else{
    header("Location : http://localhost:8000/homePage.php", true, 302);
    exit(1);
}


$actorPage->appendCssUrl("css/ActorCss.css");


echo $actorPage->TOHTML();
