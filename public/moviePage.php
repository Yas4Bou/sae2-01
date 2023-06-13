<?php
declare(strict_types=1);
require_once '../vendor/autoload.php';
use Database\MyPdo;

use Css\AppWebPage;

$title = "Film" ;
$moviePage = new AppWebPage($title);

if(isset($_GET["nombre"])){
    $Id = $_GET['nombre'];

    $requetes1 = MyPDO::getInstance()->prepare(
        <<<'SQL'
        SELECT id, title, releaseDate, originalTitle, overview , tagline
        FROM movie
        WHERE id = ? ;
    SQL);

    $requetes1 -> execute([$Id]);

    while(($ligne = $requetes1->fetch()) !== false) {
        $title = $moviePage->escapeString($ligne['title']);
        $originTitle = $moviePage->escapeString($ligne['originalTitle']);
        $tagline = $moviePage->escapeString($ligne['tagline']);
        $overview = $moviePage->escapeString($ligne['overview']);
        $moviePage -> setTitle(" Films - $title");
        $moviePage->appendContent("<p> $title     date de sortie : $ligne[releaseDate] <br> Titre d'origine : $originTitle <br> Slogan : $tagline <br> Resumer :  $overview </p>");
    }
    $requetes2 = MyPDO::getInstance()->prepare(
        <<<'SQL'
        SELECT p.id , name , role 
        FROM people p , cast c , movie m 
        WHERE m.id = c.movieId 
          AND c.peopleId = p.id 
            AND m.id = ?
        ORDER BY role
        SQL);

    $requetes2->execute([$Id]);

    while (($ligne = $requetes2->fetch()) !== false) {
        $name = $moviePage->escapeString($ligne['name']);
        $role = $moviePage->escapeString($ligne['role']);
        $moviePage->appendContent("<a href='http://localhost:8000/actorPage.php?nombre=$ligne[id]'>Role : $role <br> vrai nom : $name </a></p>\n");
    }


    $date = $moviePage ->getLastModification();
    $moviePage ->appendContent("<footer>$date</footer>");

}
else{
    header("Location : http://localhost:8000/homePage.php", true, 302);
    exit(1);
}
echo $moviePage->toHtml();
