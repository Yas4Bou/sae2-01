<?php
declare(strict_types=1);
require_once '../vendor/autoload.php';
use Database\MyPdo;
use Css\AppWebPage;
use Entity\actorCollectionRequete1;

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


    $requetes2 = MyPDO::getInstance()->prepare(
        <<<'SQL'
        SELECT m.id , title , role , releaseDate
        FROM people p , cast c , movie m 
        WHERE m.id = c.movieId 
          AND c.peopleId = p.id 
            AND p.id = ?
        ORDER BY role
        SQL);

    $requetes2->execute([$Id]);

    while (($ligne = $requetes2->fetch()) !== false) {
        $title = $actorPage->escapeString($ligne['title']);
        $role = $actorPage->escapeString($ligne['role']);
        $actorPage->appendContent("<a href='http://localhost:8000/moviePage.php?nombre=$ligne[id]'> Titre du film : $title <br> Role : $role </a></p>\n");
    }

    $date = $actorPage ->getLastModification();
    $actorPage ->appendContent("<footer>$date</footer>");
}
else{
    header("Location : http://localhost:8000/homePage.php", true, 302);
    exit(1);
}
echo $actorPage->TOHTML();
