<?php
declare(strict_types=1);
require_once '../vendor/autoload.php';
use Database\MyPdo;
use Html\WebPage;

$moviePage = new WebPage();

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
        $moviePage->appendContent("<hearder><h1>Films - $title</h1></hearder> <p> $title     date de sortie : $ligne[releaseDate] <br> Titre d'origine : $originTitle <br> Slogan : $tagline <br> Resumer :  $overview </p>");
    }



    $date = $moviePage ->getLastModification();
    $moviePage ->appendContent("<footer>$date</footer>");

}
else{
    header("Location : http://localhost:8000/homePage.php", true, 302);
    exit(1);
}
echo $moviePage->TOHTML();
