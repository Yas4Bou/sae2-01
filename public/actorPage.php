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
        $actorPage -> setTitle(" Films - $name");
        $actorPage->appendContent("<p> $name <br> lieu de naissance : $placeOfBirth <br> date de naissance : $birthday <br> date de mort : $deathday <br> Biographie : $biography </p>");
    }


    $requetes2 = new actorCollectionRequete2();
    $tableau2 = $requetes2 ->findAll($Id);

    foreach ($tableau2 as $key => $value) {
        $title = $actorPage->escapeString($value->getTitle());
        $role = $actorPage->escapeString($value->getRole());
        $id = $value->getId();
        $releaseDate = $value->getReleaseDate();
        $actorPage->appendContent("<a href='http://localhost:8000/moviePage.php?nombre=$id'> Titre du film : $title  Date de sortie : $releaseDate <br> Role : $role  </a></p>\n");
    }

    $date = $actorPage ->getLastModification();
    $actorPage ->appendContent("<footer>$date</footer>");
}
else{
    header("Location : http://localhost:8000/homePage.php", true, 302);
    exit(1);
}
echo $actorPage->TOHTML();
