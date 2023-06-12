<?php
declare(strict_types=1);
require_once '../vendor/autoload.php';
use Database\MyPdo;
use Html\WebPage;

$actorPage = new WebPage();

if(isset($_GET["nombre"])){
    $Id = $_GET['nombre'];

    $requetes1 = MyPDO::getInstance()->prepare(
        <<<'SQL'
        SELECT id, name, placeOfBirth, birthday, deathday, biography 
        FROM people
        WHERE id = ? ;
    SQL);

    $requetes1 -> execute([$Id]);

    while(($ligne = $requetes1->fetch()) !== false) {
        $name = $actorPage->escapeString($ligne['name']);
        $placeOfBirth = $actorPage->escapeString($ligne['placeOfBirth']);
        $biography = $actorPage->escapeString($ligne['biography']);
        $actorPage -> setTitle(" Films - $name");
        $actorPage->appendContent("<hearder><h1>Films - $name</h1></hearder> <p> $name <br> lieu de naissance : $placeOfBirth <br> date de naissance : $ligne[birthday] <br> date de mort : $ligne[deathday] <br> Biographie : $biography </p>");
    }


    $requetes2 = MyPDO::getInstance()->prepare(
        <<<'SQL'
        SELECT m.id , title , role , releaseDate
        FROM people p , cast c , movie m 
        WHERE m.id = c.movieId 
          AND c.peopleId = p.id 
            AND m.id = ?
        ORDER BY role
        SQL);

    $requetes2->execute([$Id]);

    while (($ligne = $requetes2->fetch()) !== false) {
        $title = $actorPage->escapeString($ligne['title']);
        $role = $actorPage->escapeString($ligne['role']);
        $actorPage->appendContent("<a href='http://localhost:8000/actorPage.php?nombre=$ligne[id]'> Titre du film : $title <br> Role : $role </a></p>\n");
    }

    $date = $actorPage ->getLastModification();
    $actorPage ->appendContent("<footer>$date</footer>");
}
else{
    header("Location : http://localhost:8000/homePage.php", true, 302);
    exit(1);
}
echo $actorPage->TOHTML();
