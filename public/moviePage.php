<?php
declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;

use Css\AppWebPage;

use Entity\movieCollectionRequete1;

$moviePage = new AppWebPage();

if(isset($_GET["nombre"])){
    $Id = $_GET['nombre'];

   $requetes1 = new movieCollectionRequete1();
   $tableau1 = $requetes1 ->findAll($Id);


   foreach ($tableau1  as $key => $value) {
        $title = $moviePage->escapeString($value->getTitle());
        $originTitle = $moviePage->escapeString($value->getOriginaltitle());
        $tagline = $moviePage->escapeString($value->getTagline());
        $overview = $moviePage->escapeString($value->getOverview());
        $moviePage -> setTitle(" Films - $title");
        $releaseDate = $value->getReleaseDate();
        $moviePage->appendContent("<p> $title     date de sortie : $releaseDate <br> Titre d'origine : $originTitle <br> Slogan : $tagline <br> Resumer :  $overview </p>");
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
